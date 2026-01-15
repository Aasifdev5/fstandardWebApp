<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatternState extends Model
{
    protected $table = 'pattern_states';

    protected $fillable = [
        'pattern_definition_id',
        'instrument_id',
        'timeframe',
        'strength',
        'confidence',
        'source',
        'is_active',
        'starts_at',
        'ends_at',
        'parent_pattern_id',
    ];

    protected $casts = [
        'strength'    => 'float',
        'confidence'  => 'float',
        'is_active'   => 'boolean',
        'starts_at'   => 'datetime',
        'ends_at'     => 'datetime',
    ];

    /* ───────────────────────────────
     | Relationships
     |───────────────────────────────*/

    public function instrument()
    {
        return $this->belongsTo(Instrument::class);
    }

   public function patternDefinition()
{
    return $this->belongsTo(PatternDefinition::class, 'pattern_definition_id');
}

    public function parent()
    {
        return $this->belongsTo(PatternState::class, 'parent_pattern_id');
    }

    public function children()
    {
        return $this->hasMany(PatternState::class, 'parent_pattern_id');
    }
}
