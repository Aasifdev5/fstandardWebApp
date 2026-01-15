<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatternExecution extends Model
{
    protected $fillable = [
        'pattern_state_id',
        'instrument_id',
        'pattern_definition_id',
        'timeframe',
        'strength',
        'execution_score',
        'starts_at',
        'ends_at',
        'generated_by',
    ];

    protected $casts = [
        'starts_at'       => 'datetime',
        'ends_at'         => 'datetime',
        'strength'        => 'float',
        'execution_score' => 'float',
    ];
}
