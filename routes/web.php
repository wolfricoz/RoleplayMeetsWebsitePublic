<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Jakyeru\Larascord\Http\Controllers\DiscordController;

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


Route::group(['prefix' => 'posts'], static function () {
    Route::get('/view/{id}', [PostController::class, 'show'])->name("posts.show");
    Route::get('/create', [PostController::class, 'create'])->name("posts.create");
    Route::put('/create', [PostController::class, 'store'])->name("posts.store");
    Route::post('/nsfw/{post}', [AdminController::class, 'nsfwtoggle'])->name("admin.nsfw");
});
Route::group(['prefix' => 'users'], static function () {
    Route::get('/dashboard', [UserController::class, 'index'])->middleware('auth')->name("dashboard");
    Route::get('view/{id}', [UserController::class, 'show'])->name("users.show");
    Route::get('settings', [SettingsController::class, 'index'])->middleware('auth')->name("users.settings");
    Route::post('settings/update', [SettingsController::class, 'update'])->middleware('auth')->name("users.settings.update");
    Route::delete('delete/{user}', [UserController::class, 'destroy'])->middleware('auth')->name("users.delete");
    Route::post('restore/{user}', [UserController::class, 'restore'])->middleware('auth')->name("users.restore");
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'permission:access_dashboard']], static function () {
    Route::get('/', [AdminController::class, 'index'])->name("admin.dashboard");
    Route::group(['prefix' => 'posts', 'middleware' => ['permission:manage_posts']], static function () {
        Route::get('/', [PostController::class, 'admin'])->name("admin.posts");
        Route::get('/queue', [AdminController::class, 'queue'])->name("admin.queue");
        Route::post('/approve/{post}', [AdminController::class, 'approvetoggle'])->name("admin.approve");
        Route::delete('/delete/{post}', [AdminController::class, 'destroy'])->name("admin.delete");
    });
    Route::group(['prefix' => 'groups', 'middleware' => ['permission:manage_groups']], static function () {
        Route::get('/', [RoleController::class, 'index'])->name("admin.groups");
        Route::post('/create', [RoleController::class, 'store'])->name("admin.groups.store");
        Route::post('/update/{role}', [RoleController::class, 'update'])->name("admin.groups.update");
        Route::post('/delete/{role}', [RoleController::class, 'destroy'])->name("admin.groups.delete");
    });
    Route::group(['prefix' => 'users', 'middleware' => ['permission:manage_users']], static function () {
        Route::get('/', [AdminUserController::class, 'index'])->name("admin.users");
        Route::post('/update/{user}', [AdminUserController::class, 'update'])->name("admin.users.update");
        Route::post('/delete/{user}', [AdminUserController::class, 'destroy'])->name("admin.users.delete");
    });


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});


// Discord Auth
Route::get('/larascord/callback', [DiscordController::class, 'handle'])->name('larascord.login');

Route::get('/larascord/refresh-token', static function () {
    Redirect::route('login')->with('status', 'Token refreshed!');
})->name('larascord.refresh_token');
