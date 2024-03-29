<?php

namespace App\Providers;

use App\Models\Genres;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      try{
        View::share('genres', Genres::all());
        View::share('queueCount', count(Post::approved(false)->get()));
        View::share('postsCount', count(Post::approved()->approved(true)->get()));
        View::share('usersCount', count(User::all()));
        $role = config('site_settings.admin_role');
        if (Role::where('name', '=', $role)->exists() === false){
            Role::create(['name' => 'Admin']);
        }
        Role::findByName($role)->givePermissionTo(Permission::all());



    } catch (Exception) {
      // do nothing
      }
    }
}
