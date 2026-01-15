<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeframeActivity extends Model
{
    protected $fillable = [
        'timeframe',
        'active_viewers',
        'idle_viewers',
        'last_updated_at',
    ];

    public $timestamps = false;

    protected $casts = [
        'last_updated_at' => 'datetime',
    ];
}
