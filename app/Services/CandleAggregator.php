<?php

namespace App\Services;

use App\Models\Candle;
use Carbon\Carbon;

class CandleAggregator
{
    protected array $timeframes = [
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
        float $price,
        Carbon $timestamp
    ): void {

        foreach ($this->timeframes as $tfName => $minutes) {

            $seconds = $minutes * 60;

            // Floor to the exact bucket start in Unix seconds (always UTC)
            $bucketUnix = floor($timestamp->timestamp / $seconds) * $seconds;

            // Build bucket in IST explicitly
            $bucket = Carbon::createFromTimestampUTC($bucketUnix)
                ->setTimezone('Asia/Kolkata');

            // Zero out seconds for clean minute boundaries
            $bucket->setTime($bucket->hour, $bucket->minute, 0);

            // Format with explicit :00 seconds
            $bucketFormatted = $bucket->format('Y-m-d H:i:00');

            $candle = Candle::firstOrCreate(
                [
                    'symbol'    => $symbol,
                    'timeframe' => $tfName,
                    'timestamp' => $bucketFormatted,
                ],
                [
                    'open'   => $price,
                    'high'   => $price,
                    'low'    => $price,
                    'close'  => $price,
                    'volume' => rand(5, 50),
                ]
            );

            $candle->high = max((float)$candle->high, $price);
            $candle->low = min((float)$candle->low, $price);
            $candle->close = $price;
            $candle->volume += rand(5, 50);

            $candle->save();
        }
    }
}
