<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candle extends Model
{
    use HasFactory;

    protected $fillable = [
        'symbol',
        'timeframe',
        'timestamp',
        'open',
        'high',
        'low',
        'close',
        'volume',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'open'  => 'decimal:2',
        'high'  => 'decimal:2',
        'low'   => 'decimal:2',
        'close' => 'decimal:2',
    ];
}
