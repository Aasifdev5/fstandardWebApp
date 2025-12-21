<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instrument extends Model
{
    use HasFactory;

    protected $fillable = [
        'symbol',
        'category',
        'sector',
        'base_price',
        'volatility_class',
        'tick_size',
        'lot_size',
        'session_start',
        'session_end',
        'news_sensitivity',
        'is_active',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'tick_size'  => 'decimal:4',
        'is_active'  => 'boolean',
    ];

    // Add this scope
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function underlyingState()
    {
        return $this->hasOne(UnderlyingState::class);
    }

    public function newsState()
    {
        return $this->hasOne(InstrumentNewsState::class);
    }
}
