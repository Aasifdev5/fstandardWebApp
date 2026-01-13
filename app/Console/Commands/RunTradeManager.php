<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trade;
use App\Models\Order;
use App\Models\Contract;
use App\Models\Instrument;
use App\Models\User;
use App\Models\Challenge;
use App\Models\TradeLog;
use App\Models\SimulationConfig; // ✅ Added SimulationConfig
use App\Services\TradePricingService;
use Illuminate\Support\Facades\DB;

class RunTradeManager extends Command
{
    protected $signature = 'market:run-trade-manager {--dry : Simulate without updating DB}';
    protected $description = 'Monitor active trades for Stop Loss, Target hits, and Forced Outcomes';

    private int $sleepTime = 1_000_000; // 1 second
    private array $dryClosedTrades = [];

    protected $pricingService;

    public function __construct(TradePricingService $pricingService)
    {
        parent::__construct();
        $this->pricingService = $pricingService;
    }

    public function handle()
    {
        $dryRun = $this->option('dry');
        $this->info('✅ Trade Manager STARTED' . ($dryRun ? ' [DRY RUN]' : ''));

        while (true) {
            // 1. Fetch Active Trades with SL or Target
            // Note: We also fetch trades without SL/Target if a forced outcome might apply,
            // but usually forced outcomes rely on the existence of those values.
            $trades = Trade::where('status', 'OPEN')->get();

            foreach ($trades as $trade) {

                // 2. Check for FORCED OUTCOME (Simulation Override) first
                $forcedOutcome = SimulationConfig::getForcedOutcome($trade->user_id);

                $triggered = false;
                $reason = null;
                $exitPrice = 0;

                // --- LOGIC A: FORCED SIMULATION ---
                if ($forcedOutcome === 'TARGET_HIT' && $trade->target > 0) {
                    $triggered = true;
                    $reason = 'TARGET_HIT (FORCED)';
                    $exitPrice = $trade->target;
                }
                elseif ($forcedOutcome === 'SL_HIT' && $trade->stop_loss > 0) {
                    $triggered = true;
                    $reason = 'SL_HIT (FORCED)';
                    $exitPrice = $trade->stop_loss;
                }

                // --- LOGIC B: REAL MARKET PRICE ---
                // Only run real price checks if not already forced
                if (!$triggered) {
                    // Skip if trade has no protections set
                    if ($trade->stop_loss == null && $trade->target == null) {
                        continue;
                    }

                    $currentPrice = $this->getCurrentPrice($trade->symbol);
                    if ($currentPrice <= 0) continue;

                    $exitPrice = $currentPrice; // Default exit is current price

                    if ($trade->side === 'BUY') {
                        // BUY: SL is below, Target is above
                        if ($trade->stop_loss > 0 && $currentPrice <= $trade->stop_loss) {
                            $triggered = true;
                            $reason = 'SL_HIT';
                            $exitPrice = $trade->stop_loss; // Assume filled exactly at SL
                        } elseif ($trade->target > 0 && $currentPrice >= $trade->target) {
                            $triggered = true;
                            $reason = 'TARGET_HIT';
                            $exitPrice = $trade->target;
                        }
                    } elseif ($trade->side === 'SELL') {
                        // SELL: SL is above, Target is below
                        if ($trade->stop_loss > 0 && $currentPrice >= $trade->stop_loss) {
                            $triggered = true;
                            $reason = 'SL_HIT';
                            $exitPrice = $trade->stop_loss;
                        } elseif ($trade->target > 0 && $currentPrice <= $trade->target) {
                            $triggered = true;
                            $reason = 'TARGET_HIT';
                            $exitPrice = $trade->target;
                        }
                    }
                }

                // 3. Execute Close if Triggered
                if ($triggered) {
                    // Calculate PnL Points
                    $points = ($trade->side === 'BUY')
                        ? $exitPrice - $trade->entry_price
                        : $trade->entry_price - $exitPrice;

                    // Calculate Real PnL Value
                    $rupeesPerPoint = $this->pricingService->rupeesPerPoint(
                        0,
                        $trade->lot_type,
                        $trade->symbol,
                        $trade->entry_price
                    );

                    $pnl = round($points * $rupeesPerPoint, 2);

                    if ($dryRun) {
                        if (!in_array($trade->id, $this->dryClosedTrades)) {
                            $this->info("💡 [DRY] Trade #{$trade->id} ({$trade->symbol}) triggered | Reason: {$reason} | Exit: {$exitPrice} | PnL: {$pnl}");
                            $this->dryClosedTrades[] = $trade->id;
                        }
                    } else {
                        try {
                            $this->closeTrade($trade, $exitPrice, $reason, $pnl);
                        } catch (\Exception $e) {
                            $this->error("❌ Failed to close Trade {$trade->id}: " . $e->getMessage());
                        }
                    }
                }
            }

            usleep($this->sleepTime);
        }
    }

    private function getCurrentPrice(string $symbol): float
    {
        if (str_ends_with($symbol, '-F')) {
            $contract = Contract::where('contract_symbol', $symbol)->with('futuresState')->first();
            return (float) ($contract?->futuresState?->last_price ?? 0);
        }
        if (str_contains($symbol, '-C-') || str_contains($symbol, '-P-')) {
            $contract = Contract::where('contract_symbol', $symbol)->with('optionsState')->first();
            return (float) ($contract?->optionsState?->last_price ?? 0);
        }
        $instrument = Instrument::where('symbol', $symbol)->with('underlyingState')->first();
        return (float) ($instrument?->underlyingState?->last_price ?? 0);
    }

    private function closeTrade(Trade $trade, float $exitPrice, string $reason, float $pnl): void
    {
        DB::transaction(function () use ($trade, $exitPrice, $reason, $pnl) {

            // 1. Update Trade Table
            $trade->update([
                'status'       => 'CLOSED',
                'exit_price'   => $exitPrice,
                'exit_time'    => now(),
                'pnl'          => $pnl,
                'close_reason' => $reason,
            ]);

            // 2. Sync Order
            if ($trade->order_id) {
                Order::where('id', $trade->order_id)->update([
                    'status'       => Order::STATUS_COMPLETED,
                    'exit_price'   => $exitPrice,
                    'pnl'          => $pnl,
                    'closed_at'    => now(),
                    'close_reason' => $reason,
                ]);
            }

            // 3. Create Trade Log
            $invested = $trade->entry_price * $trade->qty;
            $pnlPercent = ($invested > 0) ? ($pnl / $invested) * 100 : 0;

            TradeLog::create([
                'user_id'             => $trade->user_id,
                'challenge_id'        => $trade->challenge_id,
                'symbol'              => $trade->symbol,
                'direction'           => strtolower($trade->side) === 'buy' ? 'long' : 'short',
                'entry_price'         => $trade->entry_price,
                'exit_price'          => $exitPrice,
                'entry_time'          => $trade->created_at,
                'exit_time'           => now(),
                'quantity'            => $trade->qty,
                'profit_loss'         => $pnl,
                'profit_loss_percent' => $pnlPercent,
                'trade_type'          => 'intraday',
                'exchange'            => 'NSE',
                'segment'             => str_starts_with($trade->symbol, 'FSI-') ? 'FUT' : 'EQ',
                'order_ids'           => $trade->order_id ? [(string)$trade->order_id] : [],
                'closed_at'           => now(),
                'is_paper'            => true,
                'meta'                => ['trigger' => $reason]
            ]);

            // 4. Update User Balance
            $user = User::lockForUpdate()->find($trade->user_id);
            if ($user) {
                $user->account_balance += $pnl;

                if ($pnl > 0 && !$user->can_trade_mega) {
                     $wins = Trade::where('user_id', $user->id)->where('pnl', '>', 0)->count();
                     if ($wins >= 3) $user->can_trade_mega = true;
                }

                $user->save();
            }

            // 5. Update Challenge Stats
            if ($trade->challenge_id) {
                $challenge = Challenge::lockForUpdate()->find($trade->challenge_id);
                if ($challenge) {
                    $challenge->current_balance += $pnl;
                    if ($challenge->current_balance > $challenge->peak_balance) {
                        $challenge->peak_balance = $challenge->current_balance;
                    }
                    if ($pnl > 0) {
                        $challenge->total_profit += $pnl;
                    } else {
                        $challenge->total_loss += abs($pnl);
                    }
                    $challenge->save();
                }
            }

            $this->info("✅ Trade #{$trade->id} CLOSED | {$reason} | PnL: {$pnl}");
        });
    }
}
