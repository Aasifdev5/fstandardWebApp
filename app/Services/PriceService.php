<?php

namespace App\Services;

use Carbon\Carbon;
use MathPHP\Probability\Distribution\Continuous\Normal;
use App\Models\MarketSetting;

class PriceService
{
    /**
     * Cached normal distribution (performance)
     */
    protected static ?Normal $normal = null;

    /**
     * Calculate next price using Geometric Brownian Motion (GBM)
     *
     * @param float $currentPrice
     * @param float $drift              Annualized drift
     * @param float $volatility         Annualized volatility
     * @param float $timeStepSeconds    Engine tick interval
     */
    public function calculateGbmPrice(
        float $currentPrice,
        float $drift,
        float $volatility,
        float $timeStepSeconds = 0.8
    ): float {
        // Safety floors
        $currentPrice = max(0.01, $currentPrice);
        $volatility   = max(0.0001, $volatility);

        /**
         * Convert seconds → years
         */
        $dt = $timeStepSeconds / (365 * 24 * 60 * 60);

        if (self::$normal === null) {
            self::$normal = new Normal(0, 1);
        }

        $z = self::$normal->rand();

        /**
         * Proper GBM:
         * dS/S = (μ − ½σ²)dt + σ√dt·Z
         */
        $change =
            ($drift - 0.5 * ($volatility ** 2)) * $dt
            + $volatility * sqrt($dt) * $z;

        return max(0.01, $currentPrice * exp($change));
    }

    /**
     * Get volatility multiplier based on time of day
     * Uses MarketSetting as the single source of truth
     */
    public function getTimeMultiplier(
        Carbon $time,
        object $instrument,
        ?array $overrideConfig = null
    ): float {
        /**
         * Pull config snapshot once
         */
        $marketConfig = MarketSetting::getSimulationConfig();

        $config = $overrideConfig
            ?? ($marketConfig['time_of_day_multipliers'] ?? []);

        $hour   = $time->hour;
        $minute = $time->minute;

        /**
         * Commodity evening session
         */
        if (
            isset($instrument->category)
            && $instrument->category === 'commodity'
            && $hour >= 18
        ) {
            return max(0.1, $config['evening_commod'] ?? 1.3);
        }

        /**
         * 09:15 – 09:45 Opening
         */
        if ($hour === 9 && $minute >= 15 && $minute < 45) {
            return max(0.1, $config['morning_open'] ?? 1.6);
        }

        /**
         * 09:45 – 11:30 Late Morning
         */
        if (
            ($hour === 9 && $minute >= 45)
            || ($hour === 10)
            || ($hour === 11 && $minute < 30)
        ) {
            return max(0.1, $config['late_morning'] ?? 1.2);
        }

        /**
         * 11:30 – 13:30 Mid-day
         */
        if (
            ($hour === 11 && $minute >= 30)
            || ($hour === 12)
            || ($hour === 13 && $minute < 30)
        ) {
            return max(0.1, $config['mid_day'] ?? 0.8);
        }

        /**
         * 13:30 – 14:45 Afternoon
         */
        if (
            ($hour === 13 && $minute >= 30)
            || ($hour === 14 && $minute < 45)
        ) {
            return max(0.1, $config['afternoon'] ?? 1.0);
        }

        /**
         * 14:45 – Close
         */
        if (($hour === 14 && $minute >= 45) || $hour >= 15) {
            return max(0.1, $config['closing_hour'] ?? 1.5);
        }

        return 1.0;
    }

    /**
     * Futures pricing (Cost of Carry)
     */
    public function calculateFuturesPrice(
        float $spot,
        float $timeToExpiryYears,
        float $riskFreeRate = 0.0
    ): float {
        return max(0.01, $spot * exp($riskFreeRate * $timeToExpiryYears));
    }

    /**
     * Black–76 option pricing
     */
    public function calculateBlackOptionPrice(
        float $futuresPrice,
        float $strike,
        float $timeToExpiryYears,
        float $volatility,
        string $type
    ): float {
        if ($timeToExpiryYears <= 0 || $volatility <= 0) {
            return max(
                0,
                $type === 'CALL'
                    ? $futuresPrice - $strike
                    : $strike - $futuresPrice
            );
        }

        $sigmaSqrtT = $volatility * sqrt($timeToExpiryYears);

        $d1 = (
            log($futuresPrice / $strike)
            + 0.5 * ($volatility ** 2) * $timeToExpiryYears
        ) / $sigmaSqrtT;

        $d2 = $d1 - $sigmaSqrtT;

        if (self::$normal === null) {
            self::$normal = new Normal(0, 1);
        }

        if ($type === 'CALL') {
            return max(
                0,
                $futuresPrice * self::$normal->cdf($d1)
                - $strike * self::$normal->cdf($d2)
            );
        }

        return max(
            0,
            $strike * self::$normal->cdf(-$d2)
            - $futuresPrice * self::$normal->cdf(-$d1)
        );
    }

    /**
     * Volatility smile adjustment
     */
    public function adjustImpliedVolForSmile(
        float $strike,
        float $futuresPrice,
        float $baseVol,
        float $smileStrength = 0.10
    ): float {
        $baseVol = max(0.0001, $baseVol);
        $moneyness = log($strike / max(0.01, $futuresPrice));

        return max(
            0.0001,
            $baseVol + $smileStrength * ($moneyness ** 2)
        );
    }
}
