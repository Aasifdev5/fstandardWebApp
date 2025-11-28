<?php

// 1. app/Models/Trade.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $table = 'trades';

    protected $fillable = [
        'order_id',
        'user_id',
        'stock_symbol',
        'trade_side', // 1=Buy, 2=Sell
        'price',
        'quantity',
        'total_amount',
        'brokerage',
        'net_amount',
        'executed_at'
    ];

    protected $casts = [
        'price'         => 'decimal:2',
        'quantity'      => 'decimal:4',
        'total_amount'  => 'decimal:2',
        'brokerage'     => 'decimal:2',
        'net_amount'    => 'decimal:2',
        'executed_at'   => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Accessors
    public function getSideTextAttribute()
    {
        return $this->trade_side == 1 ? 'BUY' : 'SELL';
    }

    public function getSideColorAttribute()
    {
        return $this->trade_side == 1 ? 'success' : 'danger';
    }
}
