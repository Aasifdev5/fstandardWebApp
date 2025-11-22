<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    // Add 'name' and 'path' to the fillable property
    protected $fillable = ['name', 'path'];

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
