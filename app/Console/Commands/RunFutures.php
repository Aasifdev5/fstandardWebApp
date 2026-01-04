<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contract;
use App\Models\FuturesState;
use App\Events\FuturesTickUpdated;
use App\Services\PriceService;
use App\Models\MarketSetting;
use Carbon\Carbon;

class RunFutures extends Command
{
    protected $signature = 'market:run-futures';
    protected $description = 'Run the futures price simulation engine';

    public function handle(PriceService $priceService)
    {
        $this->info('Starting futures price engine...');

        while (true) {
            $now = Carbon::now('Asia/Kolkata');

            /** 🔥 Load MarketSetting ONCE per tick */
            $marketConfig = MarketSetting::getSimulationConfig();
            $riskFreeRate = (float) ($marketConfig['risk_free_rate'] ?? 0.06);
            $instrumentMultipliers = $marketConfig['instrument_multipliers'] ?? [];

            $contracts = Contract::where('contract_type', 'FUTURE')
                ->where('is_active', true)
                ->with('instrument.underlyingState')
                ->get();

            foreach ($contracts as $contract) {
                $instrument = $contract->instrument;
                if (!$instrument || !$instrument->underlyingState) continue;

                $sessionStart = Carbon::today()->setTimeFromTimeString($instrument->session_start);
                $sessionEnd   = Carbon::today()->setTimeFromTimeString($instrument->session_end);

                if (!$now->between($sessionStart, $sessionEnd)) continue;

                $state = FuturesState::firstOrCreate(
                    ['contract_id' => $contract->id],
                    ['last_price' => $instrument->underlyingState->last_price]
                );

                $timeToExpiry = max(
                    0.00001,
                    $contract->expiry_date->diffInSeconds($now) / (365 * 24 * 60 * 60)
                );

                /** 🔥 Instrument multiplier */
                $symbolKey = "{$instrument->symbol}-F";
                $multiplier = (float) ($instrumentMultipliers[$symbolKey] ?? 1.0);

                $basePrice = $instrument->underlyingState->last_price * $multiplier;

                $newPrice = $priceService->calculateFuturesPrice(
                    $basePrice,
                    $timeToExpiry,
                    $riskFreeRate
                );

                $newPrice = round($newPrice / $instrument->tick_size) * $instrument->tick_size;

                $state->update(['last_price' => $newPrice]);

                event(new FuturesTickUpdated(
                    $contract->contract_symbol,
                    $newPrice,
                    $now
                ));
            }

            sleep(1);
        }
    }
}
