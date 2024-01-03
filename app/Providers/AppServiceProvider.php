<?php

namespace App\Providers;

use App\Models\genres;
use App\Models\groups;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
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
        View::share('genresCount', count(genres::all()));
        View::share('queueCount', count(Post::approved(false)->get()));
        View::share('postsCount', count(Post::approved()->get()));
        View::share('usersCount', count(User::all()));

    }
}
