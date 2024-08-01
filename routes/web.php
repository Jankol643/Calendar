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
Auth::routes(['register' => false]); // Disable registration

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/downloads', [HomeController::class, 'downloads'])->name('downloads');
});

Route::group(['prefix' => 'events'], function () {
    Route::post('/create', [EventController::class, 'store'])->name('events.create');
    Route::get('/{id}', [EventController::class, 'show'])->name('events.show');
    Route::put('/{id}', [EventController::class, 'edit'])->name('events.edit');
    Route::delete('/{id}', [EventController::class, 'delete'])->name('events.delete');
});
