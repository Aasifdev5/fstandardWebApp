<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationAccount extends Model
{
protected $fillable = ['user_id','start_balance','current_balance','peak_balance','total_profit','max_allowed_loss','rules','status'];
protected $casts = ['rules' => 'array'];


public function user() { return $this->belongsTo(User::class); }
public function tradeLogs() { return $this->hasMany(TradeLog::class); }
}
