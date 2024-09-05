<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;

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
    Route::get('/view/{id}', [EventController::class, 'show'])->name('events.show');
    Route::put('/edit/{id}', [EventController::class, 'edit'])->name('events.edit');
    Route::delete('/delete/{id}', [EventController::class, 'delete'])->name('events.delete');
});

Route::group(['prefix' => 'tasks'], function () {
    Route::post('/create', [TaskController::class, 'store'])->name('task.create');
    Route::get('/view/{id}', [TaskController::class, 'show'])->name('task.show');
    Route::put('/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('task.delete');
});

Route::get('/calendar/add_event_form', function () {
    return view('calendar.add_event_form');
});

Route::get('/calendar/add_task_form', function () {
    return view('task.add_task_form');
});
