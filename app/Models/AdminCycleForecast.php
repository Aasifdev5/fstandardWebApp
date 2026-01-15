<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCycleForecast extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_id',
        'cycle_type',
        'expected_pass_rate',
        'expected_payout_pressure',
        'risk_band',
        'inputs',
        'notes',
        'generated_at',
    ];

    protected $casts = [
        'inputs' => 'array',
        'notes'  => 'array',
    ];
}
