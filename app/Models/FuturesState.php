<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuturesState extends Model
{
    public $timestamps = false;

    protected $table = 'futures_state';

    protected $fillable = [
        'contract_id',
        'last_price',
    ];

    protected $casts = [
        'last_price' => 'decimal:2',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
