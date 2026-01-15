<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatternDefinition extends Model
{
    protected $fillable = [
        'pattern_id',
        'name',
        'category',
        'direction',        // bullish / bearish / neutral
        'volatility_bias',  // low / medium / high
        'behavioral_bias',  // fear / greed / breakout / trap
        'definition_json',
        'is_active',
    ];

    protected $casts = [
        'definition_json' => 'array',
        'is_active'       => 'boolean',
    ];
}
