<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychometricExplanation extends Model
{
    protected $fillable = [
        'user_id',
        'explanation',
        'generated_by',
    ];
}
