<?php

namespace App\Listeners;

use App\Events\FuturesTickUpdated;
use App\Services\CandleAggregator;

class UpdateFuturesCandle
{
    public function __construct(private CandleAggregator $aggregator)
    {
    }

    public function handle(FuturesTickUpdated $event)
    {
        $this->aggregator->aggregate($event->symbol, '1m', $event->price, $event->timestamp);
    }
}
