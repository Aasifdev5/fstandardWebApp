<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemTradeConfig extends Model
{
    protected $table = 'system_trade_configs';

    protected $fillable = [
        'max_buy_order',
        'min_decrease',
        'max_decrease',
        'buy_order_amount_range',
        'buy_order_matching_chance',
        'buy_order_matching_price_increase_up_to',
        'buy_matching_with_system_trade',
        'buy_order_remains_minutes',

        'max_sell_order',
        'min_increase',
        'max_increase',
        'sell_order_amount_range',
        'sell_order_matching_chance',
        'sell_order_matching_price_decrease_up_to',
        'sell_matching_with_system_trade',
        'sell_order_remains_minutes',
    ];

    protected $casts = [
        'buy_order_matching_chance' => 'integer',
        'sell_order_matching_chance' => 'integer',
    ];
}
