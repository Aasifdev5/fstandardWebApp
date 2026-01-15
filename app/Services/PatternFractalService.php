<?php

namespace App\Services;

use App\Models\PatternExecution;
use App\Models\PatternDefinition;

class PatternFractalService
{
    public function generateFractals(PatternExecution $parent)
    {
        $timeframes = ['5m' => 'sub', '30m' => 'higher', '1h' => 'higher'];

        foreach ($timeframes as $tf => $type) {
            $strengthAdjust = $type === 'sub' ? rand(10, 20)/100 : rand(-20, -10)/100;

            PatternExecution::create([
                'instrument_id'         => $parent->instrument_id,
                'pattern_definition_id' => $parent->pattern_definition_id,
                'timeframe'             => $tf,
                'strength'              => max(0.4, min(0.95, $parent->strength + $strengthAdjust)),
                'starts_at'             => $parent->starts_at,
                'ends_at'               => $parent->ends_at,
                'generated_by'          => 'FRACTAL',
            ]);
        }
    }
}
