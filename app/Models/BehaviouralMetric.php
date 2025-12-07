<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BehaviouralMetric extends Model
{
protected $fillable = ['user_id','for_date','scores','stability_index','discipline_score','emotional_stability','impulse_score','meta'];
protected $casts = ['scores' => 'array','for_date' => 'date','meta' => 'array'];


public function user() { return $this->belongsTo(User::class); }
}
