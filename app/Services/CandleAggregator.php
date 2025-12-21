<?php

namespace App\Services;

use App\Models\Candle;
use Carbon\Carbon;

class CandleAggregator
{
    public function onTick(
        string $symbol,
        string $timeframe,
        float $price,
        Carbon $timestamp
    ): void {
        // Normalize timestamp to candle open time
        $candleStart = match ($timeframe) {
            '1m' => $timestamp->copy()->startOfMinute(),
            '5m' => $timestamp->copy()->startOfMinute()->subMinutes($timestamp->minute % 5),
            default => $timestamp->copy()->startOfMinute(),
        };

        $candle = Candle::firstOrNew([
            'symbol'    => $symbol,
            'timeframe' => $timeframe,
            'timestamp' => $candleStart,
        ]);

        if (!$candle->exists) {
            // New candle
            $candle->open   = $price;
            $candle->high   = $price;
            $candle->low    = $price;
            $candle->close  = $price;
            $candle->volume = rand(100, 500); // synthetic
        } else {
            // Update candle
            $candle->high   = max($candle->high, $price);
            $candle->low    = min($candle->low, $price);
            $candle->close  = $price;
            $candle->volume += rand(10, 100);
        }

        $candle->save();
    }
}
