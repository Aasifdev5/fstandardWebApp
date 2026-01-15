<?php

namespace App\Analytics;

use App\Models\AdminCycleForecast;
use App\Models\PsychometricState;
use App\Models\PatternState;
use App\Models\Trade;
use Carbon\Carbon;

class AdminAnalyticsEngine
{
    public function run(string $cycleType = 'DAILY'): AdminCycleForecast
    {
        $cycleId = $this->resolveCycleId($cycleType);

        $metrics = [
            'avg_psychometric_confidence' => $this->avgConfidence(),
            'discipline_variance'         => $this->disciplineVariance(),
            'active_patterns'             => $this->activePatterns(),
            'risk_exposure_ratio'         => $this->riskExposureRatio(),
        ];

        $passRate = $this->estimatePassRate($metrics);
        $pressure = $this->estimatePayoutPressure($metrics);
        $riskBand = $this->classifyRisk($passRate, $pressure);

        return AdminCycleForecast::updateOrCreate(
            ['cycle_id' => $cycleId, 'cycle_type' => strtoupper($cycleType)],
            [
                'expected_pass_rate'       => $passRate,
                'expected_payout_pressure' => $pressure,
                'risk_band'                => $riskBand,
                'inputs'                   => $metrics,
                'generated_at'             => now(),
            ]
        );
    }

    protected function resolveCycleId(string $cycleType): string
    {
        $now = Carbon::now();
        return match (strtoupper($cycleType)) {
            'DAILY'   => $now->format('Ymd'),
            'WEEKLY'  => $now->format('YW'),
            'MONTHLY' => $now->format('Ym'),
            default   => $now->format('Ymd'),
        };
    }

    protected function avgConfidence(): float
    {
        return round((PsychometricState::avg('confidence') ?? 0.0), 4);
    }

    /**
     * Calculate sample variance using raw SQL (VAR_SAMP)
     * Works on MySQL 5.7+ / MariaDB 10.2+ (most common)
     * Returns 0.0 if no data or only one value
     */
    protected function disciplineVariance(): float
    {
        $variance = PsychometricState::query()
            ->selectRaw("VAR_SAMP(discipline) as variance")
            ->value('variance');

        return round($variance ?? 0.0, 4);
    }

    protected function activePatterns(): int
    {
        return PatternState::where('detected_at', '>=', now()->subHours(24))->count();
    }

    protected function riskExposureRatio(): float
    {
        $openRisk = Trade::where('status', 'OPEN')->sum('risk_amount') ?? 0;
        $totalTrades = Trade::count() ?: 1;
        return round($openRisk / $totalTrades, 4);
    }

    protected function estimatePassRate(array $metrics): float
    {
        $base = 50.0;
        $confidenceFactor = ($metrics['avg_psychometric_confidence'] ?? 0) * 30;
        $variancePenalty  = ($metrics['discipline_variance'] ?? 0) * 10;
        $exposurePenalty  = ($metrics['risk_exposure_ratio'] ?? 0) * 5;
        $patternsBoost    = min(($metrics['active_patterns'] ?? 0) * 2, 20);

        $rate = $base + $confidenceFactor - $variancePenalty - $exposurePenalty + $patternsBoost;
        return round(max(0.0, min(100.0, $rate)), 2);
    }

    protected function estimatePayoutPressure(array $metrics): float
    {
        $exposureFactor   = ($metrics['risk_exposure_ratio'] ?? 0) * 50;
        $varianceFactor   = ($metrics['discipline_variance'] ?? 0) * 20;
        $patternsFactor   = ($metrics['active_patterns'] ?? 0) * 5;
        $confidenceRelief = ($metrics['avg_psychometric_confidence'] ?? 0) * 10;

        $pressure = $exposureFactor + $varianceFactor + $patternsFactor - $confidenceRelief;
        return round(max(0.0, min(100.0, $pressure)), 2);
    }

    protected function classifyRisk(float $passRate, float $pressure): string
    {
        if ($pressure > 80 || $passRate > 65) return 'CRITICAL';
        if ($pressure > 60 || $passRate > 55) return 'HIGH';
        if ($pressure > 40) return 'MODERATE';
        return 'LOW';
    }
}
