<?php

namespace App\Providers;

use App\Models\genres;
use App\Models\groups;
use App\Models\Post;
use App\Models\User;
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
        View::share('genres', genres::all());
        View::share('queueCount', count(Post::approved(false)->get()));
        View::share('postsCount', count(Post::approved()->approved(true)->get()));
        View::share('usersCount', count(User::all()));
        if (Role::where('name', '=', 'Admin')->exists() === false){
            Role::create(['name' => 'Admin']);
        }
        Role::findByName('Admin')->givePermissionTo(Permission::all());

    }
}
