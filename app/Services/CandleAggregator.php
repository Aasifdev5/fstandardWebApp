<?php

namespace App\Services;

use App\Models\Candle;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CandleAggregator
{
    // All supported timeframes and their duration in minutes
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

    /**
     * Process a new tick and update all timeframes in a single high-performance operation.
     */
    public function onTick(
        string $symbol,
        float $price,
        Carbon $timestamp
    ): void {
        $upserts = [];
        $now = now();

        foreach ($this->timeframes as $tfName => $minutes) {
            // 1. Calculate the 'Bucket' start time for this timeframe
            $seconds = $minutes * 60;
            $bucketStartUnix = floor($timestamp->timestamp / $seconds) * $seconds;
            $bucketStart = Carbon::createFromTimestamp($bucketStartUnix);

            // 2. Prepare data for bulk upsert
            $upserts[] = [
                'symbol'     => $symbol,
                'timeframe'  => $tfName,
                'timestamp'  => $bucketStart,
                'open'       => $price,
                'high'       => $price,
                'low'        => $price,
                'close'      => $price,
                'volume'     => rand(5, 50), // Synthetic initial volume
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        /**
         * 3. 🔥 ATOMIC UPSERT
         * This logic tells the database:
         * - If the (symbol, timeframe, timestamp) combination doesn't exist: INSERT.
         * - If it exists: UPDATE only high, low, close, and volume using math logic.
         */

        Candle::upsert($upserts,
            ['symbol', 'timeframe', 'timestamp'], // Unique key constraint
            [
                'close'      => DB::raw("VALUES(close)"),
                'high'       => DB::raw("GREATEST(high, VALUES(high))"),
                'low'        => DB::raw("LEAST(low, VALUES(low))"),
                'volume'     => DB::raw("volume + VALUES(volume)"),
                'updated_at' => DB::raw("VALUES(updated_at)")
            ]
        );
    }
}
