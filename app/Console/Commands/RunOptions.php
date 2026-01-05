<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contract;
use App\Models\OptionsState;
use App\Events\OptionsTickUpdated;
use App\Services\PriceService;
use App\Models\MarketSetting;
use Carbon\Carbon;

class RunOptions extends Command
{
    protected $signature = 'market:run-options';
    protected $description = 'Run the options price simulation engine';

    public function handle(PriceService $priceService)
    {
        $this->info('Starting options price engine...');

        while (true) {
            $now = Carbon::now('Asia/Kolkata');

            // 1. Fetch Config
            $marketConfig = MarketSetting::getSimulationConfig();

            // 2. Read Real-time Control Values
            $tickSpeed = (int) ($marketConfig['update_speed_ms'] ?? 1000);
            $stressMult = (float) ($marketConfig['global_stress_multiplier'] ?? 1.0);

            $volClasses   = $marketConfig['volatility_by_class'] ?? [];

            // Increase Smile Strength (Curvature) during high stress
            $smileStrength = (float) ($marketConfig['option_smile_strength'] ?? 0.10) * $stressMult;

            $contracts = Contract::where('contract_type', 'OPTION')
                ->where('is_active', true)
                ->with('instrument.underlyingState')
                ->get();

            foreach ($contracts as $contract) {
                $instrument = $contract->instrument;
                if (!$instrument || !$instrument->underlyingState) continue;

                $sessionStart = Carbon::today()->setTimeFromTimeString($instrument->session_start);
                $sessionEnd   = Carbon::today()->setTimeFromTimeString($instrument->session_end);

                if (!$now->between($sessionStart, $sessionEnd)) continue;

                $volClass = $instrument->volatility_class ?? 'medium';
                $baseVol  = (float) ($volClasses[$volClass] ?? 0.20);

                // 3. SCALE VOLATILITY BY STRESS MULTIPLIER
                $effectiveVol = $baseVol * $stressMult;

                $state = OptionsState::firstOrCreate(
                    ['contract_id' => $contract->id],
                    [
                        'last_price' => 0,
                        'implied_volatility' => $effectiveVol,
                    ]
                );

                $futuresPrice = $instrument->underlyingState->last_price;

                $timeToExpiry = max(
                    0.00001,
                    $contract->expiry_date->diffInSeconds($now) / (365 * 24 * 60 * 60)
                );

                // Use the SCALED volatility for smile adjustment
                $adjustedVol = $priceService->adjustImpliedVolForSmile(
                    $contract->strike_price,
                    $futuresPrice,
                    $effectiveVol,
                    $smileStrength
                );

                $newPrice = $priceService->calculateBlackOptionPrice(
                    $futuresPrice,
                    $contract->strike_price,
                    $timeToExpiry,
                    $adjustedVol,
                    $contract->option_type
                );

                $newPrice = round($newPrice / $instrument->tick_size) * $instrument->tick_size;

                $state->update([
                    'last_price' => $newPrice,
                    'implied_volatility' => $adjustedVol,
                ]);

                event(new OptionsTickUpdated(
                    $contract->contract_symbol,
                    $newPrice,
                    $now
                ));
            }

            // 4. DYNAMIC SLEEP
            usleep($tickSpeed * 1000);
        }
    }
}
