<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genres extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Posts(): HasMany
    {
        return $this->hasMany(Post::class, 'genre_id', 'id');
    }
}
