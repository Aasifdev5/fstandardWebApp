<?php

namespace App\Listeners;

use App\Events\OptionsTickUpdated;
use App\Services\CandleAggregator;
use Illuminate\Support\Facades\Log;

class UpdateOptionsCandle
{
    public function __construct(
        private CandleAggregator $aggregator
    ) {}

    public function handle(OptionsTickUpdated $event): void
    {
        if ($event->price === null) {
            Log::warning('Options tick skipped (null price)', [
                'symbol' => $event->symbol,
                'timestamp' => $event->timestamp,
            ]);
            return;
        }

        $this->aggregator->onTick(
            $event->symbol,
            '1m',
            (float) $event->price,
            $event->timestamp
        );
    }
}
