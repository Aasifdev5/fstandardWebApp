<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Instrument;
use App\Models\UnderlyingState;
use App\Models\InstrumentNewsState;
use App\Events\UnderlyingTickUpdated;
use App\Services\PriceService;
use Carbon\Carbon;

class RunUnderlyings extends Command
{
    protected $signature = 'market:run-underlyings';
    protected $description = 'Run underlying price engine with real-time broadcasting';

    public function handle(PriceService $priceService)
    {
        $this->info('Underlying Price Engine Started...');

        while (true) {
            $now = Carbon::now();
            // Fetch only active instruments to save memory
            $instruments = Instrument::where('is_active', true)->with('underlyingState')->get();

            foreach ($instruments as $instrument) {
                // Session Check
                $start = Carbon::parse($instrument->session_start);
                $end = Carbon::parse($instrument->session_end);
                if (!$now->between($start, $end)) continue;

                $state = $instrument->underlyingState ?? UnderlyingState::firstOrCreate(
                    ['instrument_id' => $instrument->id],
                    [
                        'last_price' => $instrument->base_price,
                        'regime' => 'normal',
                        'drift' => 0,
                        'volatility' => 0,
                    ]
                );

                // Simulation Logic
                $baseVol = config('market.volatility_by_class.' . $instrument->volatility_class, 0.2);
                $timeMult = $priceService->getTimeMultiplier($now, $instrument);
                $regimeConfig = config('market.regimes.' . $state->regime, ['drift' => 0, 'volatility_multiplier' => 1]);

                $drift = $regimeConfig['drift'];
                $vol = $baseVol * $timeMult * $regimeConfig['volatility_multiplier'];

                // News Impact
                $news = InstrumentNewsState::where('instrument_id', $instrument->id)->first();
                if ($news && $news->active) {
                    $impact = config('market.news.impact_by_sensitivity.' . $instrument->news_sensitivity, ['vol_multiplier' => 1, 'drift_boost' => 0]);
                    $vol *= $impact['vol_multiplier'];
                    $drift += ($news->direction === 'up' ? 1 : -1) * $impact['drift_boost'];
                }

                // Geometric Brownian Motion Calculation
                $newPrice = $priceService->calculateGbmPrice($state->last_price, $drift, $vol);
                $newPrice = round($newPrice / $instrument->tick_size) * $instrument->tick_size;

                // Update Database
                $state->update([
                    'last_price' => $newPrice,
                    'drift' => $drift,
                    'volatility' => $vol
                ]);

                // Dispatch Broadcast Event
                event(new UnderlyingTickUpdated($instrument->symbol, $newPrice, $now));
            }

            // High-frequency sleep (800ms) makes the UI feel more responsive than a full second
            usleep(800000);
        }
    }
}
