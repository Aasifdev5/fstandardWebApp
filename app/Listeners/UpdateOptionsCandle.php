<?php

namespace App\Listeners;

use App\Events\OptionsTickUpdated;
use App\Services\CandleAggregator;

class UpdateOptionsCandle
{
    public function __construct(private CandleAggregator $aggregator)
    {
    }

    public function handle(OptionsTickUpdated $event)
    {
        $this->aggregator->aggregate($event->symbol, '1m', $event->price, $event->timestamp);
    }
}
