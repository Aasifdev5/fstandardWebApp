<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $table = 'trades';

    protected $fillable = [
        'user_id',          // <--- REQUIRED: To link to the User for Mega Unlock
        'challenge_id',
        'order_id',
        'symbol',
        'side',             // Matches your DB (BUY/SELL)
        'lot_type',         // <--- REQUIRED: F-Standard (micro, mini, standard...)
        'qty',              // Matches your DB
        'entry_price',
        'exit_price',
        'pnl',
        'sl_used',
        'tp_used',
        'status',           // <--- REQUIRED: OPEN/CLOSED
        'entry_time',
        'exit_time',
        'holding_time_seconds',
        'gap_seconds',
        'news_flag',
    ];

    protected $casts = [
        'qty' => 'decimal:4',
        'entry_price' => 'decimal:2',
        'exit_price' => 'decimal:2',
        'pnl' => 'decimal:2',
        'sl_used' => 'boolean',
        'tp_used' => 'boolean',
        'news_flag' => 'boolean',
        'entry_time' => 'datetime',
        'exit_time' => 'datetime',
        'user_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
