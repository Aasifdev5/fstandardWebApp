<?php

namespace App\Listeners;

use App\Events\UnderlyingTickUpdated; // And similar for futures/options
use App\Services\CandleAggregator;

class UpdateCandle
{
    public function handle(UnderlyingTickUpdated $event)
    {
        $aggregator = app(CandleAggregator::class);
        $aggregator->onTick($event->symbol, '1m', $event->lastPrice, $event->timestamp);
    }
}
