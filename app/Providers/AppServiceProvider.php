<?php

namespace App\Providers;

use App\Models\Genres;
use App\Models\Post;
use App\Models\Report;
use App\Models\Settings;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\View;

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
    try {
      View::share('genres', Genres::all());
      # To improve performance, this could be only done for the admin dashboard and not the entire site
      View::share('queueCount', count(Post::approved(false)->get()));
      View::share('postsCount', count(Post::approved()->approved(true)->get()));
      View::share('usersCount', count(User::all()));
      View::share('reportsCount', count(Report::all()));
      View::share('post_types', Settings::$options);
      $role = config('site_settings.admin_role');
      if (Role::where('name', '=', $role)->exists() === false) {
        Role::create(['name' => 'Admin']);
      }
      Role::findByName($role)->givePermissionTo(Permission::all());


    } catch (Exception $e) {
      Log::error("Error in AppServiceProvider: $e");
    }
  }
}
