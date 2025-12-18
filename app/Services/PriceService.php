<?php

namespace App\Services;

use Carbon\Carbon;
use MathPHP\Probability\Distribution\Continuous\Normal;

class PriceService
{
    public function calculateGbmPrice(float $currentPrice, float $drift, float $volatility, float $timeStep = 1/365/24/60): float
    {
        $dt = $timeStep; // 1 second in years
        $norm = new Normal(0, 1);
        $random = $norm->rand(); // proper normal random
        $change = $drift * $dt + $volatility * sqrt($dt) * $random;
        return $currentPrice * exp($change);
    }

    public function getTimeMultiplier(Carbon $time, object $instrument): float
    {
        $hour = $time->hour;
        $minute = $time->minute;
        $config = config('market.time_of_day_multipliers');

        if (isset($instrument->category) && $instrument->category === 'commodity') {
            if ($hour >= 18) return $config['evening_commod'] ?? 1.3;
        }

        if ($hour == 9 && $minute <= 45) return $config['morning_open'] ?? 1.6;
        if ($hour < 11 || ($hour == 11 && $minute <= 30)) return $config['late_morning'] ?? 1.2;
        if ($hour < 13 || ($hour == 13 && $minute <= 30)) return $config['mid_day'] ?? 0.8;
        if ($hour < 14 || ($hour == 14 && $minute <= 45)) return $config['afternoon'] ?? 1.0;
        return $config['closing_hour'] ?? 1.5;
    }

    public function calculateFuturesPrice(float $spot, float $timeToExpiry, float $riskFreeRate = 0.0): float
    {
        return $spot * exp($riskFreeRate * $timeToExpiry);
    }

    public function calculateBlackOptionPrice(float $futuresPrice, float $strike, float $timeToExpiry, float $volatility, string $type): float
    {
        if ($timeToExpiry <= 0) return max(0, $type === 'CALL' ? $futuresPrice - $strike : $strike - $futuresPrice);

        $d1 = (log($futuresPrice / $strike) + ($volatility ** 2 / 2) * $timeToExpiry) / ($volatility * sqrt($timeToExpiry));
        $d2 = $d1 - $volatility * sqrt($timeToExpiry);

        $norm = new Normal(0, 1);

        return $type === 'CALL'
            ? $futuresPrice * $norm->cdf($d1) - $strike * $norm->cdf($d2)
            : $strike * $norm->cdf(-$d2) - $futuresPrice * $norm->cdf(-$d1);
    }

    public function adjustImpliedVolForSmile(float $strike, float $futuresPrice, float $baseVol, float $smileStrength = 0.10): float
    {
        $moneyness = log($strike / $futuresPrice);
        return $baseVol + $smileStrength * ($moneyness ** 2);
    }
}
