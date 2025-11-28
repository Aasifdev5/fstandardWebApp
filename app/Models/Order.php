<?php

// 2. app/Models/Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'stock_symbol',
        'order_side',
        'order_type', // 1=Limit, 2=Market
        'price',
        'quantity',
        'filled_quantity',
        'filled_percentage',
        'average_price',
        'total_amount',
        'brokerage',
        'status',
        'trx'
    ];

    protected $casts = [
        'price'           => 'decimal:2',
        'quantity'        => 'decimal:4',
        'filled_quantity' => 'decimal:4',
        'average_price'   => 'decimal:2',
        'total_amount'    => 'decimal:2',
        'brokerage'       => 'decimal:2',
    ];

    const STATUS_OPEN           = 0;
    const STATUS_COMPLETED      = 1;
    const STATUS_PARTIAL        = 2;
    const STATUS_CANCELLED      = 9;

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trades()
    {
        return $this->hasMany(Trade::class);
    }

    // Scopes
    public function scopeOpen($query)
    {
        return $query->where('status', 0);
    }

    public function scopeBuy($query)
    {
        return $query->where('order_side', 1);
    }

    public function scopeSell($query)
    {
        return $query->where('order_side', 2);
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            0 => '<span class="badge bg-warning">Open</span>',
            1 => '<span class="badge bg-success">Completed</span>',
            2 => '<span class="badge bg-info">Partial</span>',
            9 => '<span class="badge bg-danger">Cancelled</span>',
        };
    }

    public function getSideTextAttribute()
    {
        return $this->order_side == 1 ? 'BUY' : 'SELL';
    }
}
