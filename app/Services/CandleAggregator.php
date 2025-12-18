<?php

namespace App\Services;

use App\Models\Candle;
use Carbon\Carbon;

class CandleAggregator
{
    public function onTick(string $symbol, string $timeframe, float $price, Carbon $timestamp)
    {
        $candleStart = $timestamp->copy()->startOfMinute(); // For '1m'

        $candle = Candle::firstOrNew([
            'symbol' => $symbol,
            'timeframe' => $timeframe,
            'timestamp' => $candleStart,
        ]);

        if (!$candle->exists) {
            $candle->open = $price;
            $candle->high = $price;
            $candle->low = $price;
            $candle->close = $price;
            $candle->volume = 0; // Fake volume
        } else {
            $candle->high = max($candle->high, $price);
            $candle->low = min($candle->low, $price);
            $candle->close = $price;
            $candle->volume += rand(100, 1000); // Fake
        }

        $candle->save();
    }
}
