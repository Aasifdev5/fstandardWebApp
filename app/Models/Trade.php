<?php

// app/Models/Trade.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $table = 'trades';

    protected $fillable = [
        'challenge_id',
        'symbol',
        'side',
        'qty',
        'entry_price',
        'exit_price',
        'pnl',
        'sl_used',
        'tp_used',
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
    ];

    // Relationships
    public function challenge()
    {
        return $this->belongsTo(Challenge::class); // Adjust if needed
    }

    // Optional: If linked to order
    // public function order()
    // {
    //     return $this->belongsTo(Order::class);
    // }
}
