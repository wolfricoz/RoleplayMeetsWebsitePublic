<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\overrides\larascord;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name("home");

Route::get('/rules', [RulesController::class, 'index'])->name("rules");
Route::get('/support', [SiteController::class, 'support'])->name("support");


Route::group(['prefix' => 'posts'], static function () {
  Route::get('view/{post}', [PostController::class, 'show'])->name("posts.show");
  Route::get('create', [PostController::class, 'create'])->middleware('auth')->name("posts.create");
  Route::put('create', [PostController::class, 'store'])->middleware('auth')->name("posts.store");
  Route::get('edit/{post}', [PostController::class, 'edit'])->middleware('auth')->name("posts.edit");
  Route::patch('edit/{post}', [PostController::class, 'update'])->middleware('auth')->name("posts.update");
  Route::post('nsfw/{post}', [AdminController::class, 'nsfwtoggle'])->middleware('auth')->name("admin.nsfw");
  Route::patch('bump/{post}', [PostController::class, 'update'])->middleware('auth')->name("posts.bump");
});
Route::group(['prefix' => 'users'], static function () {
  Route::get('dashboard', [UserController::class, 'index'])->middleware('auth')->name("dashboard");
  Route::get('view/{id}', [UserController::class, 'show'])->name("users.show");
  Route::get('settings', [SettingsController::class, 'index'])->middleware('auth')->name("users.settings");
  Route::get('settings/finalize', [SettingsController::class, 'dob'])->middleware('auth')->name("users.dob");
  Route::post('settings/update', [SettingsController::class, 'update'])->middleware('auth')->name("users.settings.update");
  Route::delete('delete/{user}', [UserController::class, 'destroy'])->middleware('auth')->name("users.delete");
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'permission:access_dashboard']], static function () {
  Route::get('/', [AdminController::class, 'index'])->name("admin.dashboard");
  Route::group(['prefix' => 'posts', 'middleware' => ['permission:manage_posts']], static function () {
    Route::get('/', [PostController::class, 'admin'])->name("admin.posts");
    Route::get('queue', [AdminController::class, 'queue'])->name("admin.queue");
    Route::post('approve/{post}', [AdminController::class, 'approvetoggle'])->name("admin.approve");
    Route::post('reject/{post}', [AdminController::class, 'reject'])->name("admin.reject");
    Route::delete('delete/{post}', [AdminController::class, 'destroy'])->name("admin.delete");
  });
  Route::group(['prefix' => 'groups', 'middleware' => ['permission:manage_groups']], static function () {
    Route::get('/', [RoleController::class, 'index'])->name("admin.groups");
    Route::post('create', [RoleController::class, 'store'])->name("admin.groups.store");
    Route::post('update/{role}', [RoleController::class, 'update'])->name("admin.groups.update");
    Route::post('delete/{role}', [RoleController::class, 'destroy'])->name("admin.groups.delete");
  });
  Route::group(['prefix' => 'users', 'middleware' => ['permission:manage_users']], static function () {
    Route::get('/', [AdminUserController::class, 'index'])->name("admin.users");
    Route::get('manage/{user}', [AdminUserController::class, 'show'])->name("admin.users.show");
    Route::post('update/{user}', [AdminUserController::class, 'update'])->name("admin.users.update");
//        Route::post('/delete/{user}', [AdminUserController::class, 'destroy'])->name("admin.users.delete");
    Route::post('ban/{user}', [AdminUserController::class, 'ban'])->middleware('permission:ban_users')->name("admin.users.ban");
    Route::get('bans/', [AdminUserController::class, 'index_bans'])->middleware('permission:ban_users')->name("admin.bans.view");
    Route::post('unban/{user}', [AdminUserController::class, 'unban'])->middleware('permission:ban_users')->name("admin.users.unban");
  });
  Route::group(['prefix' => 'rules', 'middleware' => ['permission:manage_rules']], static function () {
    Route::get('/', [RulesController::class, 'admin'])->name("admin.rules");
    Route::put('create', [RulesController::class, 'store'])->name("admin.rules.create");
    Route::patch('edit/{rule}', [RulesController::class, 'update'])->name("admin.rules.update");
    Route::delete('delete/{rule}', [RulesController::class, 'destroy'])->name("admin.rules.delete");
  });
  Route::group(['prefix' => 'genres', 'middleware' => ['permission:manage_genres']], static function () {
    Route::get('/', [GenresController::class, 'index'])->name("admin.genres");
    Route::put('create', [GenresController::class, 'store'])->name("admin.genres.store");
    Route::patch('edit/{genre}', [GenresController::class, 'update'])->name("admin.genres.update");
    Route::delete('delete/{genre}', [GenresController::class, 'destroy'])->name("admin.genres.delete");
  });
  Route::group(['prefix' => 'settings', 'middleware' => ['permission:manage_settings']], static function () {
    Route::get('/', [SiteController::class, 'index'])->name("admin.settings");
    Route::patch('update', [SiteController::class, 'update'])->name("admin.settings.update");
  });
});

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});


// Discord Auth
Route::get('/larascord/callback', [larascord::class, 'handle'])->name('larascord.login');
