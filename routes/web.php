<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Models\Calendar;

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
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/downloads', [HomeController::class, 'downloads'])->name('downloads');
    Route::get('/calendar', [HomeController::class, 'index'])->name('calendar');
});

Route::get('/calendar/add_event_form', function () {
    return view('calendar.add_event_form');
});

Route::get('/calendar/add_task_form', function () {
    return view('task.add_task_form');
});

Route::get('/calendars', [CalendarController::class, 'index'])->name('calendars.index');
Route::get('/calendars/{id}/items', [CalendarController::class, 'showCalendarItems'])->name('calendars.items');
Route::get('/add-event-form', function () {
    $calendars = Calendar::where('user_id', Auth::id())->get(); // Fetch calendars
    return view('components.add-event-form', ['calendars' => $calendars]);
});
