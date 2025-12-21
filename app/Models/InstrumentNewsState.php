<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstrumentNewsState extends Model
{
    use HasFactory;

    protected $table = 'instrument_news_states';

    protected $fillable = [
        'instrument_id',
        'active',
        'direction',
        'ends_at',
    ];

    protected $casts = [
        'active'  => 'boolean',
        'ends_at' => 'datetime',
    ];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class);
    }
}
