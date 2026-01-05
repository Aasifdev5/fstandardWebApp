<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contract;
use App\Models\FuturesState;
use App\Events\FuturesTickUpdated;
use App\Services\PriceService;
use App\Models\MarketSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class RunFutures extends Command
{
    protected $signature = 'market:run-futures';
    protected $description = 'Run the futures price simulation engine';

    public function handle(PriceService $priceService)
    {
        $this->info('Starting futures price engine...');

        while (true) {
            $now = Carbon::now('Asia/Kolkata');

            // 1. Fetch Config (Consider adding Cache::remember inside MarketSetting::getSimulationConfig for 2 seconds)
            $marketConfig = MarketSetting::getSimulationConfig();

            // 2. Read Real-time Control Values
            $tickSpeed = (int) ($marketConfig['update_speed_ms'] ?? 1000); // Default 1 second
            $stressMult = (float) ($marketConfig['global_stress_multiplier'] ?? 1.0); // 1.0 = normal

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

                $symbolKey = "{$instrument->symbol}-F";
                $multiplier = (float) ($instrumentMultipliers[$symbolKey] ?? 1.0);

                // 3. APPLY STRESS/NOISE
                // If Stress Multiplier > 1.2, add random noise to underlying price
                $jitter = 0;
                if ($stressMult > 1.2) {
                    // Random fluctuation +/- 0.05% scaled by stress
                    $randomFactor = (rand(-50, 50) / 100000);
                    $jitter = $randomFactor * $stressMult * $instrument->underlyingState->last_price;
                }

                // Base Price calculation with Jitter
                $basePrice = ($instrument->underlyingState->last_price + $jitter) * $multiplier;

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

            // 4. DYNAMIC SLEEP
            // Convert milliseconds to microseconds
            usleep($tickSpeed * 1000);
        }
    }
}
