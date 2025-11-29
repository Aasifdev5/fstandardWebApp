<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CelebrityEndorsement extends Model
{
    protected $table = 'celebrity_endorsements';

    protected $fillable = [
        'name', 'role', 'quote', 'image', 'youtube_id', 'is_active', 'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getYoutubeUrlAttribute()
    {
        return "https://www.youtube.com/embed/" . $this->youtube_id;
    }
}
