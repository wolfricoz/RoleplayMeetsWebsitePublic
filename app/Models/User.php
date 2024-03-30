<?php

namespace App\Models;


use Cog\Laravel\Ban\Models\Ban;
use Cog\Laravel\Ban\Traits\Bannable;
use Cog\Contracts\Ban\Bannable as BannableInterface;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jakyeru\Larascord\Traits\InteractsWithDiscord;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements BannableInterface
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithDiscord, SoftDeletes, HasRoles, Prunable, Bannable, CascadeSoftDeletes;

  /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'username',
        'global_name',
        'discriminator',
        'email',
        'avatar',
        'verified',
        'banner',
        'banner_color',
        'accent_color',
        'locale',
        'mfa_enabled',
        'premium_type',
        'public_flags',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'username' => 'string',
        'global_name' => 'string',
        'discriminator' => 'string',
        'email' => 'string',
        'avatar' => 'string',
        'verified' => 'boolean',
        'banner' => 'string',
        'banner_color' => 'string',
        'accent_color' => 'string',
        'locale' => 'string',
        'mfa_enabled' => 'boolean',
        'premium_type' => 'integer',
        'public_flags' => 'integer',
    ];

  public function get_highest_role()
  {
    $roles = $this->roles()->get();
    $highest_role = null;
    foreach ($roles as $role) {
      if ($highest_role === null) {
        $highest_role = $role;
        continue;
      }
      if (count($role->permissions) > count($highest_role->permissions)) {
        $highest_role = $role;
        continue;
      }
      if ((count($role->permissions) === count($highest_role->permissions)) && $role->id < $highest_role->id) {
        $highest_role = $role;
      }
    }
    return $highest_role;
  }


  public function posts (): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function profile (): HasOne
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function settings (): HasOne
    {
        return $this->hasOne(Settings::class);
    }

    public function getBans(): HasMany
    {
        return $this->hasMany(Ban::class, 'bannable_id', 'id');
    }

    public function prunable()
    {
        return static::where('deleted_at', '<=', now()->subDays(30));
    }

}
