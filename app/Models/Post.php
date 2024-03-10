<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
  use HasFactory, SoftDeletes, CascadeSoftDeletes;

  protected $table = 'posts';
  protected $guarded = [];

  public function genre(): BelongsTo
  {
    return $this->belongsTo(Genres::class);
  }

  public function scopeFilter($query, array $filters): void
  {
    $query->when($filters['search'] ?? null, function ($query, $search) {
      $query->where(fn($query) => $query->where('title', 'like', '%' . $search . '%')
        ->orWhere('content', 'like', '%' . $search . '%')
        ->orWhereHas('user', fn($query) => $query->where('global_name', 'like', '%' . $search . '%'))
        ->orWhereHas('user', fn($query) => $query->where('username', 'like', '%' . $search . '%'))
      );
    });
    $query->when($filters['genre'] ?? null, function ($query, $genre) {
      $query->whereHas('tags', fn($query) => $query->where('name', explode(",", $genre)));
    });
  }

  public function scopeApproved($query, bool $approved = null)
  {
    if ($approved === null) {
      return $query;
    }
    return $query->where('approved', $approved);
  }

  public function scopeBanned($query, bool $override = false)
  {
    if ($override) {
      return $query;
    }
    $bannedUsers = User::whereBannedAt(null)->get()->pluck('id');
    return $query->whereIn('user_id', $bannedUsers);

  }

  public function scopeNSFW($query, bool $override = false)
  {
    if (auth()->user() && auth()->user()->settings->NSFW) {
      return $query;
    }
    if ($override) {
      return $query;
    }
    return $query->where('nsfw', false);
  }


  public function updateTags(array $genre_names): Post
  {
    $tags = Tags::where('post_id', $this->id)->get()->toArray();
    $names = array_column($tags, 'name');


    foreach ($genre_names as $genre_name) {
      $index = array_search($genre_name, $names);
      if ($index !== false) {
        echo $index;
        unset($tags[$index]);
        continue;
      }
      $this->addTags($genre_name);

    }
    foreach ($tags as $tag) {

      $this->removeTags($tag['name']);
    }
    return $this;
  }

  public function addTags(string $genre_name): void
  {
    $genre = Genres::where('name', $genre_name)->first();
    if (!$genre) {
      return;
    }
    Tags::create([
      'post_id' => $this->id,
      'genre_id' => $genre->id,
      'name' => $genre_name
    ]);
  }

  public function removeTags(string $genre_names): void
  {
    $tag = Tags::where('post_id', $this->id)->where('name', $genre_names);
    $tag->delete();
  }

  // get tags
  public function getGenreNames(): string
  {
    $genre_names = [];
    foreach ($this->tags()->get() as $genre) {
      $genre_names[] = $genre->name;
    }
    return implode(", ",$genre_names);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function tags(): HasMany
  {
    return $this->hasMany(Tags::class);
  }
}
