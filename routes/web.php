<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/calendar', [HomeController::class, 'index'])->name('calendar');
Auth::routes();

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::middleware('auth')->group(function () {
    // Routes that require authentication
    Route::get('/downloads', [HomeController::class, 'downloads'])->name('downloads');
});
Route::post('/event/create', [EventController::class, 'store']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::put('/events/{id}', [EventController::class, 'update']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);
