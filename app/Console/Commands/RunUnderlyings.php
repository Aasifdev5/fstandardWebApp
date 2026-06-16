<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Instrument;
use App\Models\UnderlyingState;
use App\Models\InstrumentNewsState;
use App\Models\MarketSetting;
use App\Events\UnderlyingTickUpdated;
use App\Services\PriceService;
use App\Services\CandleAggregator;
use Carbon\Carbon;

class RunUnderlyings extends Command
{
    protected $signature = 'market:run-underlyings';
    protected $description = 'Run underlying price engine';

    public function handle(
        PriceService $priceService,
        CandleAggregator $aggregator
    ) {
        $this->info('✅ Underlying Price Engine STARTED');

        while (true) {

            $now = Carbon::now();

            $marketConfig = MarketSetting::getSimulationConfig();

            $tickSpeed = (int)($marketConfig['update_speed_ms'] ?? 800);

            $instruments = Instrument::where('is_active', true)
                ->with('underlyingState')
                ->get();

            foreach ($instruments as $instrument) {

                $state = $instrument->underlyingState
                    ?? UnderlyingState::firstOrCreate(
                        ['instrument_id' => $instrument->id],
                        [
                            'last_price' => max(1, $instrument->base_price),
                            'regime' => 'normal',
                            'drift' => 0,
                            'volatility' => 0,
                        ]
                    );

                $newPrice = $priceService->calculateGbmPrice(
                    $state->last_price,
                    0,
                    0.15,
                    $tickSpeed / 1000
                );

                // Save candle ONCE
                $aggregator->onTick(
                    $instrument->symbol,
                    $newPrice,
                    $now
                );

                $state->update([
                    'last_price' => $newPrice,
                ]);

                // Broadcast only
                event(new UnderlyingTickUpdated(
                    $instrument->symbol,
                    $newPrice,
                    $now
                ));
            }

            usleep($tickSpeed * 1000);
        }
    }
}
