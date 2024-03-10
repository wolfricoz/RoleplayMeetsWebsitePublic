<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tags extends Model
{
  public $timestamps = false;
  public $fillable = ['post_id', 'genre_id', 'name'];

  public function post(): HasOne
  {
    return $this->hasOne(Post::class);
  }

  public function genre(): BelongsTo
  {
    return $this->belongsTo(Genres::class);
  }

  public static function get_genres(Post $post)
  {
     return self::where('post_id', $post->id)->get();
  }

}

