<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Analytics\AdminAnalyticsEngine;

class RunAdminAnalytics extends Command
{
    protected $signature = 'app:run-admin-analytics {cycleType=DAILY}';
    protected $description = 'Run admin analytics forecast for the specified cycle type';

    public function handle(AdminAnalyticsEngine $engine)
    {
        $cycleType = strtoupper($this->argument('cycleType'));

        $this->newLine();
        $this->info("Starting admin analytics forecast for {$cycleType} cycle...");

        $forecast = $engine->run($cycleType);

        $this->newLine(2);

        $this->table(
            ['Metric', 'Value'],
            [
                ['Cycle ID', $forecast->cycle_id ?? 'N/A'],
                ['Expected Pass Rate', number_format($forecast->expected_pass_rate ?? 0, 2) . '%'],
                ['Expected Payout Pressure', number_format($forecast->expected_payout_pressure ?? 0, 2)],
                [
                    'Risk Band',
                    $this->coloredRiskBand($forecast->risk_band)
                ],
                ['Generated At', $forecast->generated_at?->format('Y-m-d H:i:s') ?? 'N/A'],
            ]
        );

        $this->newLine();
        $this->info("Forecast generated successfully for cycle " . ($forecast->cycle_id ?? 'N/A'));
    }

    /**
     * Return colored ANSI string for risk band
     */
    private function coloredRiskBand(?string $band): string
    {
        $band = strtoupper($band ?? 'UNKNOWN');

        $color = match ($band) {
            'CRITICAL' => 'red',
            'HIGH'     => 'yellow',
            'MODERATE' => 'orange',
            'LOW'      => 'green',
            default    => 'white',
        };

        return "<fg={$color}>{$band}</>";
    }
}
