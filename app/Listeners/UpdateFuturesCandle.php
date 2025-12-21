<?php

namespace App\Listeners;

use App\Events\FuturesTickUpdated;
use App\Services\CandleAggregator;
use Illuminate\Support\Facades\Log;

class UpdateFuturesCandle
{
    public function __construct(
        private CandleAggregator $aggregator
    ) {}

    public function handle(FuturesTickUpdated $event): void
    {
        // 🔒 Guard: skip invalid ticks
        if ($event->price === null) {
            Log::warning('Futures tick skipped (null price)', [
                'symbol' => $event->symbol,
                'timestamp' => $event->timestamp,
            ]);
            return;
        }

        $this->aggregator->onTick(
            $event->symbol,
            '1m',
            (float) $event->price,   // ✅ force float
            $event->timestamp
        );
    }
}
