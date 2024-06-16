<?php

use App\Http\Controllers\CalendarController;
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
Route::get('/calendar', [CalendarController::class, 'calendar'])->name('calendar');

Auth::routes();

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::middleware('auth')->group(function () {
    // Routes that require authentication
    Route::get('/downloads', [HomeController::class, 'downloads'])->name('downloads');
});
