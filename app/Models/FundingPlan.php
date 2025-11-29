<?php
// app/Models/FundingPlan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundingPlan extends Model
{
    protected $fillable = [
        'title', 'capital', 'fee', 'profit_target', 'max_loss',
        'drawdown_type', 'payout_cycle', 'news_trading',
        'weekend_holding', 'is_active', 'sort_order'
    ];

    protected $casts = [
        'news_trading' => 'boolean',
        'weekend_holding' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getCapitalFormattedAttribute()
    {
        return '₹' . number_format($this->capital);
    }

    public function getFeeFormattedAttribute()
    {
        return '₹' . number_format($this->fee);
    }
}
