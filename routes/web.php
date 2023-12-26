<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RulesController;
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


Route::group(['prefix' => 'posts'], function () {
    Route::get('/view/{id}', [PostController::class, 'show'])->name("posts.show");
    Route::get('/create', [PostController::class, 'create'])->name("posts.create");
    Route::put('/create', [PostController::class, 'store'])->name("posts.store");
});
Route::group(['prefix' => 'users'], function () {
    Route::get('/dashboard', [UserController::class, 'index'])->middleware('auth')->name("users.home");
    Route::get('view/{id}', [UserController::class, 'show'])->name("users.show");

});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->middleware('auth')->name("admin.dashboard");

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});


// Discord Auth
Route::get('/larascord/callback', [DiscordController::class, 'handle'])->name('larascord.login');

Route::get('/larascord/refresh-token', function () {
    Redirect::route('login')->with('status', 'Token refreshed!');
})->name('larascord.refresh_token');
