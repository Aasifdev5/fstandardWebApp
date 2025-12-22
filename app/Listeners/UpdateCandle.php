<?php

namespace App\Listeners;

use App\Events\UnderlyingTickUpdated;
use App\Services\CandleAggregator;
use Carbon\Carbon;

class UpdateCandle
{
    public function __construct(
        private CandleAggregator $aggregator
    ) {}

    public function handle(UnderlyingTickUpdated $event): void
    {
        $this->aggregator->onTick(
            $event->symbol,
            '1m',
            $event->price,
            Carbon::parse($event->timestamp) // ✅ FIX
        );
    }
}
