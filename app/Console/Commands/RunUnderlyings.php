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
    protected $description = 'Run underlying price engine';

    public function handle(PriceService $priceService)
    {
        while (true) {
            $now = Carbon::now();

            $instruments = Instrument::where('is_active', true)->get();

            foreach ($instruments as $instrument) {
                $start = Carbon::parse($instrument->session_start);
                $end = Carbon::parse($instrument->session_end);
                if (!$now->between($start, $end)) continue;

                $state = $instrument->underlyingState ?? UnderlyingState::create([
                    'instrument_id' => $instrument->id,
                    'last_price' => $instrument->base_price,
                    'regime' => 'normal',
                    'drift' => 0,
                    'volatility' => 0,
                ]);

                $baseVol = config('market.volatility_by_class.' . $instrument->volatility_class, 0.2);
                $timeMult = $priceService->getTimeMultiplier($now, $instrument);
                $regimeConfig = config('market.regimes.' . $state->regime, ['drift' => 0, 'volatility_multiplier' => 1]);

                $drift = $regimeConfig['drift'];
                $vol = $baseVol * $timeMult * $regimeConfig['volatility_multiplier'];

                $news = InstrumentNewsState::firstOrCreate(['instrument_id' => $instrument->id]);
                if ($news->active) {
                    $impact = config('market.news.impact_by_sensitivity.' . $instrument->news_sensitivity, ['vol_multiplier' => 1, 'drift_boost' => 0]);
                    $vol *= $impact['vol_multiplier'];
                    $drift += ($news->direction === 'up' ? 1 : -1) * $impact['drift_boost'];
                }

                $newPrice = $priceService->calculateGbmPrice($state->last_price, $drift, $vol);
                $newPrice = round($newPrice / $instrument->tick_size) * $instrument->tick_size;

                $state->update(['last_price' => $newPrice, 'drift' => $drift, 'volatility' => $vol]);

                event(new UnderlyingTickUpdated($instrument->symbol, $newPrice, $now));
            }

            sleep(1); // runs every 1 second
        }
    }
}
