<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnderlyingState extends Model
{
    public $timestamps = false;

    protected $table = 'underlying_state';

    protected $fillable = [
        'instrument_id',
        'last_price',
        'regime',
        'drift',
        'volatility',
    ];

    protected $casts = [
        'last_price' => 'decimal:2',
        'drift'      => 'decimal:4',
        'volatility' => 'decimal:4',
    ];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class);
    }
}
