<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trade;
use App\Models\TradeAssistanceLog;
use App\Models\MarketSetting;

class RunTradeAssist extends Command
{
    protected $signature = 'market:run-trade-assist';
    protected $description = 'Run trade risk assistance engine';

    public function handle()
    {
        $this->info('🛡️ Trade Assistance Engine RUNNING');

        $config = MarketSetting::getSimulationConfig();

        $trades = Trade::where('status', 'OPEN')->get();

        foreach ($trades as $trade) {

            // Prevent duplicate assistance per trade
            if (
                TradeAssistanceLog::where('trade_id', $trade->id)
                    ->whereNull('user_action')
                    ->exists()
            ) {
                continue;
            }

            $exposure = [
                'lot_size'      => $trade->qty,
                'direction'     => $trade->side,
                'capital_used'  => $trade->entry_price * $trade->qty,
            ];

            $hedgeType = match (true) {
                $trade->qty >= 5             => 'CAPITAL_PROTECTION',
                $trade->side === 'BUY'       => 'DIRECTIONAL_HEDGE',
                default                      => 'VOLATILITY_HEDGE',
            };

            TradeAssistanceLog::create([
                'trade_id'             => $trade->id,
                'exposure_profile'     => $exposure,
                'suggested_hedge_type' => $hedgeType,
                'explanation'          => $this->buildExplanation($trade, $hedgeType),
                'user_action'          => null, // WAITING
            ]);
        }

        $this->info('✅ Trade Assistance Engine FINISHED');
    }

    /**
     * Generate contextual explanation
     */
    protected function buildExplanation(Trade $trade, string $hedgeType): string
    {
        return match ($hedgeType) {
            'CAPITAL_PROTECTION' =>
                'Position size is large. Consider reducing exposure or adding a protective hedge.',
            'DIRECTIONAL_HEDGE' =>
                'Market direction risk detected. A counter-position may reduce drawdown.',
            default =>
                'Volatility risk detected. Hedging can stabilize P&L swings.',
        };
    }
}
