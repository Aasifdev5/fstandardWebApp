<?php

namespace App\Jobs;

use App\Models\Trade;
use App\Models\SimulationConfig;
use App\Services\TradePricingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AutoCloseSimulatedTrades implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(TradePricingService $pricingService)
    {
        // Get only OPEN trades that have SL or Target set
        $trades = Trade::where('status', 'OPEN')
            ->where(function ($q) {
                $q->whereNotNull('stop_loss')
                  ->orWhereNotNull('target');
            })
            ->get();

        foreach ($trades as $trade) {
            $forced = SimulationConfig::getForcedOutcome($trade->user_id);

            if (!$forced) {
                continue; // skip normal trades
            }

            $closePrice = null;
            $reason = null;

            if ($forced === 'TARGET_HIT' && $trade->target) {
                $closePrice = $trade->target;
                $reason = 'TARGET_HIT';
            } elseif ($forced === 'SL_HIT' && $trade->stop_loss) {
                $closePrice = $trade->stop_loss;
                $reason = 'SL_HIT';
            }

            if (!$closePrice) {
                continue;
            }

            // Calculate P/L (same logic as in controller)
            $points = ($trade->side === 'BUY')
                ? $closePrice - $trade->entry_price
                : $trade->entry_price - $closePrice;

            $rupeesPerPoint = $pricingService->rupeesPerPoint(
                $trade->user->account_balance,
                $trade->lot_type,
                $trade->symbol,
                $trade->entry_price
            );

            $pnl = round($points * $rupeesPerPoint, 2);

            // Close trade
            $trade->update([
                'exit_price'   => $closePrice,
                'pnl'          => $pnl,
                'status'       => 'CLOSED',
                'exit_time'    => now(),
                'close_reason' => $reason . ' (AUTO-SIMULATION)',
            ]);

            // Update balance
            $trade->user->account_balance += $pnl;
            $trade->user->save();

            Log::info("Auto-closed simulated trade", [
                'trade_id' => $trade->id,
                'user_id' => $trade->user_id,
                'reason' => $reason,
                'pnl' => $pnl
            ]);
        }
    }
}
