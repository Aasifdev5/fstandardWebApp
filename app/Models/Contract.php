<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'instrument_id',
        'contract_symbol',
        'contract_type',
        'option_type',
        'strike_price',
        'expiry_date',
        'multiplier',
        'is_active',
    ];

    protected $casts = [
        'strike_price' => 'decimal:2',
        'expiry_date'  => 'date',
        'is_active'    => 'boolean',
    ];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class);
    }

    public function futuresState()
    {
        return $this->hasOne(FuturesState::class);
    }

    public function optionsState()
    {
        return $this->hasOne(OptionsState::class);
    }
}
