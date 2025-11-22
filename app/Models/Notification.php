<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $fillable = ['uuid', 'sender_id', 'user_id', 'text', 'target_url', 'is_seen', 'user_type', 'created_at', 'updated_at'];

    public $timestamps = true; // Use timestamps if you're tracking created_at and updated_at

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->uuid =  Str::uuid()->toString();
            if (auth()->check())
            {
                $model->sender_id =  auth()->id();
            }

        });
    }
}
