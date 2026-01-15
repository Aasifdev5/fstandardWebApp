<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Trade;
use App\Models\PsychometricState;
use App\Models\PsychometricSnapshot;
use App\Models\MarketSetting;

class RunPsychometrics extends Command
{
    protected $signature = 'psychometrics:run';
    protected $description = 'Run psychometric behavior engine';

    public function handle()
    {
        $this->info('🧠 Psychometric Engine RUNNING');

        $config = MarketSetting::getSimulationConfig();

        $users = User::where('is_active', 1)->get();

        foreach ($users as $user) {

            $recentTrades = Trade::where('user_id', $user->id)
                ->latest()
                ->limit(10)
                ->get();

            if ($recentTrades->isEmpty()) {
                continue;
            }

            // ───── RULE-BASED METRICS ─────
            $wins   = $recentTrades->where('pnl', '>', 0)->count();
            $losses = $recentTrades->where('pnl', '<', 0)->count();
            $total  = max(1, $recentTrades->count());

            $impulse = min(100, $total * 10);
            $discipline = max(0, 100 - ($losses * 12));
            $emotionalStability = max(0, 100 - ($losses * 15));
            $riskConsistency = max(0, 100 - abs($wins - $losses) * 10);
            $recovery = $wins >= $losses ? 70 : 40;
            $confidenceGap = abs($wins - $losses) * 5;

            // ───── SNAPSHOT (IMMUTABLE HISTORY) ─────
            PsychometricSnapshot::create([
                'user_id'             => $user->id,
                'impulse_score'       => $impulse,
                'discipline_score'    => $discipline,
                'emotional_stability' => $emotionalStability,
                'risk_consistency'    => $riskConsistency,
                'recovery_behavior'   => $recovery,
                'confidence_gap'      => $confidenceGap,
            ]);

            // ───── ROLLING STATE (NORMALIZED 0–1) ─────
            PsychometricState::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'confidence' => round(min(1, $wins / $total), 2),
                    'fear'       => round(min(1, $losses / $total), 2),
                    'discipline' => round($discipline / 100, 2),
                    'aggression' => round($impulse / 100, 2),
                ]
            );
        }

        $this->info('✅ Psychometric Engine FINISHED');
    }
}
