<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
      $query->where('genre_id', $genre);
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

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
