<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\Contract;
use App\Models\Instrument;
use App\Models\User;
use App\Events\OrderUpdated;
use Illuminate\Support\Facades\DB;

class RunTradeManager extends Command
{
    protected $signature = 'market:run-trade-manager {--dry : Simulate without updating DB}';
    protected $description = 'Monitor open orders for Stop Loss and Target hits';

    // Sleep time between loops in microseconds (1 sec = 1_000_000)
    private int $sleepTime = 1_000_000;

    public function handle()
    {
        $dryRun = $this->option('dry');
        $this->info('✅ Trade Manager STARTED' . ($dryRun ? ' [DRY RUN]' : ''));

        while (true) {

            // Fetch all open orders with SL or Target
            $orders = Order::where('status', Order::STATUS_OPEN)
                ->where(function ($q) {
                    $q->whereNotNull('stop_loss')
                      ->orWhereNotNull('target');
                })
                ->get();

            foreach ($orders as $order) {

                $currentPrice = $this->getCurrentPrice($order->stock_symbol);

                $this->line("Order {$order->id} | {$order->stock_symbol} | Price: {$currentPrice}");

                if ($currentPrice <= 0) {
                    continue; // skip invalid price
                }

                $triggered = false;
                $reason = null;
                $pnl = 0;

                // BUY logic
                if ($order->order_side === Order::SIDE_BUY) {
                    if ($order->stop_loss !== null && $currentPrice <= $order->stop_loss) {
                        $triggered = true;
                        $reason = 'SL_HIT';
                        $pnl = ($currentPrice - $order->price) * $order->quantity;
                    } elseif ($order->target !== null && $currentPrice >= $order->target) {
                        $triggered = true;
                        $reason = 'TARGET_HIT';
                        $pnl = ($currentPrice - $order->price) * $order->quantity;
                    }
                }

                // SELL logic
                if ($order->order_side === Order::SIDE_SELL) {
                    if ($order->stop_loss !== null && $currentPrice >= $order->stop_loss) {
                        $triggered = true;
                        $reason = 'SL_HIT';
                        $pnl = ($order->price - $currentPrice) * $order->quantity;
                    } elseif ($order->target !== null && $currentPrice <= $order->target) {
                        $triggered = true;
                        $reason = 'TARGET_HIT';
                        $pnl = ($order->price - $currentPrice) * $order->quantity;
                    }
                }

                if ($triggered) {
                    if ($dryRun) {
                        $this->info("💡 [DRY] Order {$order->id} would close | Reason: {$reason} | PNL: {$pnl}");
                    } else {
                        $this->closeOrder($order, $currentPrice, $reason, $pnl);
                    }
                }
            }

            usleep($this->sleepTime);
        }
    }

    /**
     * Get live price for a symbol
     */
    private function getCurrentPrice(string $symbol): float
    {
        // FUTURES → ends with -F
        if (str_ends_with($symbol, '-F')) {
            $contract = Contract::where('contract_symbol', $symbol)
                ->with('futuresState')
                ->first();
            return (float) ($contract?->futuresState?->last_price ?? 0);
        }

        // OPTIONS → contains -C- or -P-
        if (str_contains($symbol, '-C-') || str_contains($symbol, '-P-')) {
            $contract = Contract::where('contract_symbol', $symbol)
                ->with('optionsState')
                ->first();
            return (float) ($contract?->optionsState?->last_price ?? 0);
        }

        // UNDERLYING
        $instrument = Instrument::where('symbol', $symbol)
            ->with('underlyingState')
            ->first();
        return (float) ($instrument?->underlyingState?->last_price ?? 0);
    }

    /**
     * Close order and update user balance
     */
    private function closeOrder(Order $order, float $exitPrice, string $reason, float $pnl): void
    {
        DB::transaction(function () use ($order, $exitPrice, $reason, $pnl) {

            // Update order
            $order->update([
                'status'       => Order::STATUS_COMPLETED,
                'exit_price'   => $exitPrice,
                'close_reason' => $reason,
                'pnl'          => $pnl,
                'closed_at'    => now(),
            ]);

            // Update user balance
            $user = User::where('id', $order->user_id)->lockForUpdate()->first();
            if ($user) {
                $user->account_balance += $pnl;
                $user->save();
            }

            $this->info("✅ Order {$order->id} CLOSED | {$reason} | PNL: {$pnl}");

            // Broadcast event
            event(new OrderUpdated($order));
        });
    }
}
