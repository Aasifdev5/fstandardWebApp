<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionsState extends Model
{
    public $timestamps = false;

    protected $table = 'options_states';

    protected $fillable = [
        'contract_id',
        'last_price',
        'implied_volatility',
    ];

    protected $casts = [
        'last_price'          => 'decimal:2',
        'implied_volatility'  => 'decimal:4',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
