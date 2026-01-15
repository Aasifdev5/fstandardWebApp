<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradeAssistanceLog extends Model
{
    protected $fillable = [
        'trade_id',
        'exposure_profile',
        'suggested_hedge_type',
        'explanation',
        'user_action',
    ];

    protected $casts = [
        'exposure_profile' => 'array',
    ];
}
