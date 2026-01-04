<?php

namespace App\Services;

use App\Models\Candle;
use Carbon\Carbon;

class CandleAggregator
{
    // Define all supported timeframes and their duration in minutes
    protected $timeframes = [
        '1m'  => 1,
        '3m'  => 3,
        '5m'  => 5,
        '15m' => 15,
        '30m' => 30,
        '1h'  => 60,
        '4h'  => 240,
        '1D'  => 1440,
    ];

    public function onTick(
        string $symbol,
        string $sourceTimeframe, // We ignore this now as we calculate ALL frames
        float $price,
        Carbon $timestamp
    ): void {

        // Loop through ALL timeframes and update/create candles for each
        foreach ($this->timeframes as $tfName => $minutes) {

            // 1. Calculate the 'Bucket' start time for this timeframe
            // Logic: Floor the timestamp to the nearest interval
            // e.g. For 5m, 10:04:30 becomes 10:00:00
            $seconds = $minutes * 60;
            $timestampUnix = $timestamp->timestamp;
            $bucketStartUnix = floor($timestampUnix / $seconds) * $seconds;
            $candleStart = Carbon::createFromTimestamp($bucketStartUnix);

            // 2. Find existing candle or initialize new one
            $candle = Candle::firstOrNew([
                'symbol'    => $symbol,
                'timeframe' => $tfName,
                'timestamp' => $candleStart,
            ]);

            if (!$candle->exists) {
                // New Candle Logic
                $candle->open   = $price;
                $candle->high   = $price;
                $candle->low    = $price;
                $candle->close  = $price;
                $candle->volume = rand(10, 50); // Synthetic initial volume
            } else {
                // Update Existing Candle Logic
                $candle->high   = max($candle->high, $price);
                $candle->low    = min($candle->low, $price);
                $candle->close  = $price;
                $candle->volume += rand(1, 10); // Add synthetic volume on tick
            }

            $candle->save();
        }
    }
}
