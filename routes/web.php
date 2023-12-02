<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get('/test', function () {
    return view('test');
})->name("test");
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});
Route::get('/larascord/callback', [DiscordController::class, 'handle'])->name('larascord.login');

Route::get('/larascord/refresh-token', function (){
    Redirect::route('login')->with('status', 'Token refreshed!');
})->name('larascord.refresh_token');
