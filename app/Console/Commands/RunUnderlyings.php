<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Instrument;
use App\Models\UnderlyingState;
use App\Models\InstrumentNewsState;
use App\Models\MarketSetting;
use App\Events\UnderlyingTickUpdated;
use App\Services\PriceService;
use Carbon\Carbon;

class RunUnderlyings extends Command
{
    protected $signature = 'market:run-underlyings';
    protected $description = 'Run underlying price engine with real-time dynamic configuration';

    public function handle(PriceService $priceService)
    {
        $this->info('✅ Underlying Price Engine STARTED');

        while (true) {

            $now = Carbon::now();

            /**
             * 1️⃣ FETCH DYNAMIC CONFIG SNAPSHOT
             */
            $marketConfig = MarketSetting::getSimulationConfig();

            // 🔥 NEW: Real-Time Controls
            $tickSpeed  = (int) ($marketConfig['update_speed_ms'] ?? 800); // Default 800ms
            $stressMult = (float) ($marketConfig['global_stress_multiplier'] ?? 1.0);

            $volMap       = $marketConfig['volatility_by_class'] ?? [];
            $regimes      = $marketConfig['regimes'] ?? [];
            $newsConfig   = $marketConfig['news'] ?? [];
            $timeOfDayCfg = $marketConfig['time_of_day_multipliers'] ?? [];

            /**
             * 2️⃣ FETCH ACTIVE INSTRUMENTS
             */
            $instruments = Instrument::where('is_active', true)
                ->with('underlyingState')
                ->get();

            foreach ($instruments as $instrument) {

                /**
                 * 3️⃣ SESSION CHECK
                 */
                $sessionStart = Carbon::parse($now->toDateString() . ' ' . $instrument->session_start);
                $sessionEnd   = Carbon::parse($now->toDateString() . ' ' . $instrument->session_end);

                if (!$now->between($sessionStart, $sessionEnd)) {
                    continue;
                }

                /**
                 * 4️⃣ INIT OR LOAD STATE
                 */
                $state = $instrument->underlyingState
                    ?? UnderlyingState::firstOrCreate(
                        ['instrument_id' => $instrument->id],
                        [
                            'last_price' => max(1, $instrument->base_price),
                            'regime'     => 'normal',
                            'drift'      => 0,
                            'volatility' => 0,
                        ]
                    );

                /**
                 * 5️⃣ BASE VOLATILITY
                 */
                $baseVol = max(
                    0.0001,
                    $volMap[$instrument->volatility_class] ?? 0.16
                );

                /**
                 * 6️⃣ TIME MULTIPLIER
                 */
                $timeMult = max(
                    0.1,
                    $priceService->getTimeMultiplier($now, $instrument, $timeOfDayCfg)
                );

                /**
                 * 7️⃣ REGIME CONFIG
                 */
                $regimeCfg = $regimes[$state->regime]
                    ?? ['drift' => 0, 'volatility_multiplier' => 1];

                $drift = (float) ($regimeCfg['drift'] ?? 0);
                $vol   = $baseVol * $timeMult * max(0.1, $regimeCfg['volatility_multiplier'] ?? 1);

                // 🔥 APPLY STRESS MULTIPLIER (Make market wilder)
                $vol *= $stressMult;

                // 🔥 APPLY PANIC DRIFT (If stress > 2.0, market tends to slide down)
                if ($stressMult > 2.0) {
                    $drift -= 0.1 * ($stressMult - 1);
                }

                /**
                 * 8️⃣ NEWS IMPACT
                 */
                $news = InstrumentNewsState::where('instrument_id', $instrument->id)->first();

                if ($news && $news->active) {
                    $impact = $newsConfig['impact_by_sensitivity'][$instrument->news_sensitivity]
                        ?? ['vol_multiplier' => 1, 'drift_boost' => 0];

                    $vol   *= max(0.1, $impact['vol_multiplier']);
                    $drift += ($news->direction === 'up' ? 1 : -1)
                              * ($impact['drift_boost'] ?? 0);
                }

                /**
                 * 9️⃣ PRICE CALCULATION (GBM)
                 */
                $newPrice = $priceService->calculateGbmPrice(
                    max(1, $state->last_price),
                    $drift,
                    $vol,
                    $tickSpeed / 1000 // Convert ms to seconds for the math
                );

                /**
                 * 🔟 TICK ROUNDING
                 */
                $tick = max(0.01, $instrument->tick_size);
                $newPrice = round($newPrice / $tick) * $tick;
                $newPrice = max($tick, $newPrice);

                /**
                 * 1️⃣1️⃣ UPDATE STATE
                 */
                $state->update([
                    'last_price' => $newPrice,
                    'drift'      => $drift,
                    'volatility' => $vol,
                ]);

                /**
                 * 1️⃣2️⃣ BROADCAST TICK
                 */
                event(new UnderlyingTickUpdated(
                    $instrument->symbol,
                    $newPrice,
                    $now
                ));
            }

            /**
             * 1️⃣3️⃣ DYNAMIC ENGINE TICK RATE
             * Use the value from config (e.g. 200ms vs 1000ms)
             */
            usleep($tickSpeed * 1000);
        }
    }
}
