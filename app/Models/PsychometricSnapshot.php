<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychometricSnapshot extends Model
{
    protected $fillable = [
        'user_id',
        'impulse_score',
        'discipline_score',
        'emotional_stability',
        'risk_consistency',
        'recovery_behavior',
        'confidence_gap',
    ];
}
