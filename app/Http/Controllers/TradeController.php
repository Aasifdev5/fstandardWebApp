<?php

namespace App\Http\Controllers;

use App\Models\SimulationConfig;
use App\Models\Trade;
use App\Models\Order;
use App\Models\User;
use App\Models\Challenge;
use App\Models\TradeLog; // ✅ Imported TradeLog Model
use App\Services\TradePricingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TradeController extends Controller
{
    protected $pricingService;

    // Fallback constants
    const DEFAULT_STARTING_BALANCE = 1000000;
    const DEFAULT_TARGET_PERCENT   = 0.10;
    const DEFAULT_MAX_DRAWDOWN     = 0.10;

    // User/Challenge Status Constants
    const STATUS_FAILED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_PASSED = 2;

    public function __construct(TradePricingService $pricingService)
    {
        $this->pricingService = $pricingService;
    }

    public function close(Request $request, $id)
    {
        $request->validate([
            'exit_price' => 'required|numeric',
        ]);

        // 🔥 AUTH CHECK
        $userId = Session::get('LoggedIn');
        if (!$userId) return response()->json(['message' => 'Unauthorized'], 401);

        $user = User::find($userId);
        if (!$user) return response()->json(['message' => 'User not found'], 401);

        return DB::transaction(function () use ($request, $user, $id) {

            // 🔍 STEP 1: Find Trade (Check Trade ID OR Order ID)
            $trade = Trade::where('user_id', $user->id)
                ->where(function($query) use ($id) {
                    $query->where('id', $id)
                          ->orWhere('order_id', $id);
                })
                ->lockForUpdate()
                ->first();

            // Handle "Already Closed" gracefully
            if (!$trade) {
                // Check if it exists in closed logs or closed status
                $closedTrade = Trade::where('user_id', $user->id)
                    ->where(function($query) use ($id) {
                        $query->where('id', $id)->orWhere('order_id', $id);
                    })->first();

                if ($closedTrade && $closedTrade->status === 'CLOSED') {
                    return response()->json(['success' => true, 'message' => 'Trade already closed.']);
                }
                return response()->json(['message' => "Active trade not found for ID #{$id}"], 404);
            }

            // 🚨 Double check status inside transaction
            if ($trade->status === 'CLOSED') {
                 return response()->json(['success' => true, 'message' => 'Trade already closed.']);
            }

            $requestedExitPrice = (float) $request->input('exit_price');

            // ── Simulation Logic ──
            $forcedOutcome = SimulationConfig::getForcedOutcome($user->id);
            $exitPrice = $requestedExitPrice;
            $closeReason = 'MANUAL_EXIT';

            if ($forcedOutcome === 'TARGET_HIT' && $trade->target) {
                $exitPrice = (float) $trade->target;
                $closeReason = 'TARGET_HIT';
            } elseif ($forcedOutcome === 'SL_HIT' && $trade->stop_loss) {
                $exitPrice = (float) $trade->stop_loss;
                $closeReason = 'SL_HIT';
            }

            // ── P/L Calculation ──
            $points = ($trade->side === 'BUY')
                ? $exitPrice - $trade->entry_price
                : $trade->entry_price - $exitPrice;

            $rupeesPerPoint = $this->pricingService->rupeesPerPoint(
                $user->account_balance,
                $trade->lot_type,
                $trade->symbol,
                $trade->entry_price
            );

            $pnl = round($points * $rupeesPerPoint, 2);

            // Calculate % Return
            $invested = $trade->entry_price * $trade->qty;
            $pnlPercent = ($invested > 0) ? ($pnl / $invested) * 100 : 0;

            // ── 1. Update Trade Table ──
            $trade->update([
                'exit_price'   => $exitPrice,
                'pnl'          => $pnl,
                'status'       => 'CLOSED', // This removes it from Active Positions
                'exit_time'    => now(),
                'close_reason' => $closeReason,
            ]);

            // ── 2. Sync Order Status ──
            if ($trade->order_id) {
                Order::where('id', $trade->order_id)->update([
                    'status'       => 1, // 1 = COMPLETED
                    'exit_price'   => $exitPrice,
                    'pnl'          => $pnl,
                    'closed_at'    => now(),
                    'close_reason' => $closeReason
                ]);
            }

            // ── 3. Create Trade Log Entry (🔥 NEW: This populates your History Tab) ──
            TradeLog::create([
                'user_id'             => $user->id,
                'challenge_id'        => $trade->challenge_id,
                'symbol'              => $trade->symbol,
                'direction'           => strtolower($trade->side) === 'buy' ? 'long' : 'short',
                'entry_price'         => $trade->entry_price,
                'exit_price'          => $exitPrice,
                'entry_time'          => $trade->created_at, // Mapping created_at to entry_time
                'exit_time'           => now(),
                'quantity'            => $trade->qty,
                'profit_loss'         => $pnl,
                'profit_loss_percent' => $pnlPercent,
                'trade_type'          => 'intraday',
                'exchange'            => 'NSE', // Defaulting for simulation
                'segment'             => str_starts_with($trade->symbol, 'FSI-') ? 'FUT' : 'EQ',
                'order_ids'           => $trade->order_id ? [(string)$trade->order_id] : [],
                'closed_at'           => now(),
                'is_paper'            => true,
            ]);

            // ── 4. Update User Balance ──
            $user->account_balance += $pnl;
            $user->save();

            // ── 5. Update Challenge Balance ──
            if ($trade->challenge_id) {
                $challenge = Challenge::lockForUpdate()->find($trade->challenge_id);
                if ($challenge) {
                    // Update raw balance first
                    $challenge->current_balance += $pnl;

                    // Update High Water Mark (Peak Balance)
                    if ($challenge->current_balance > $challenge->peak_balance) {
                        $challenge->peak_balance = $challenge->current_balance;
                    }

                    // Update Cumulative Stats
                    if ($pnl > 0) {
                        $challenge->total_profit += $pnl;
                    } else {
                        $challenge->total_loss += abs($pnl);
                    }

                    $challenge->save();
                }
            }

            // ── 6. Unlocks & Status Checks ──
            if ($pnl > 0) $this->checkMegaLotUnlock($user);
            $accountStatus = $this->evaluateAccountStatus($user);

            return response()->json([
                'success'          => true,
                'message'          => 'Trade closed successfully',
                'trade_id'         => $trade->id,
                'exit_price'       => $exitPrice,
                'pnl'              => $pnl,
                'new_balance'      => $user->account_balance,
                'account_status'   => $accountStatus,
            ]);
        });
    }

    // Helper functions
    private function checkMegaLotUnlock(User $user): void
    {
        $profitableTrades = Trade::where('user_id', $user->id)->where('pnl', '>', 0)->count();
        if ($profitableTrades >= 3 && !$user->can_trade_mega) {
            $user->can_trade_mega = true;
            $user->save();
        }
    }

    private function evaluateAccountStatus(User $user): string
    {
        $plan = DB::table('plan_purchases')
            ->join('funding_plans', 'plan_purchases.funding_plan_id', '=', 'funding_plans.id')
            ->where('plan_purchases.user_id', $user->id)
            ->where('plan_purchases.status', 'approved')
            ->orderBy('plan_purchases.created_at', 'desc')
            ->select('funding_plans.capital', 'funding_plans.profit_target', 'funding_plans.max_loss')
            ->first();

        $startingBalance = $plan ? (float) $plan->capital : self::DEFAULT_STARTING_BALANCE;
        $targetPercent   = $plan ? ((float) $plan->profit_target / 100) : self::DEFAULT_TARGET_PERCENT;
        $maxLossPercent  = $plan ? ((float) $plan->max_loss / 100) : self::DEFAULT_MAX_DRAWDOWN;

        $netPnl = $user->account_balance - $startingBalance;

        // CHECK FAILURE
        if ($netPnl <= -($startingBalance * $maxLossPercent)) {
            if ($user->status !== self::STATUS_FAILED) {
                $user->status = self::STATUS_FAILED;
                $user->save();
            }
            return 'failed';
        }

        // CHECK SUCCESS
        if ($netPnl >= ($startingBalance * $targetPercent)) {
            if ($user->status !== self::STATUS_PASSED) {
                $user->status = self::STATUS_PASSED;
                $user->save();
            }
            return 'passed';
        }

        return 'active';
    }
}
