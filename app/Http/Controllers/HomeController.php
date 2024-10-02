<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Task;
use App\Models\Calendar;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->only('downloads');
    }

    public function index() {
        // Retrieve the calendars of the currently logged-in user
        $calendars = Calendar::where('user_id', Auth::id())->get();

        // Retrieve all events and tasks
        $events = Event::all();
        $tasks = Task::all();

        // Pass the collections to the view
        return view('calendar.index', compact('calendars', 'events', 'tasks'));
    }

    /**
     * Show the welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome() {
        return view('welcome');
    }

    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home() {
        return view('home');
    }

    /**
     * Show the downloads page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function downloads() {
        return view('downloads');
    }
}
