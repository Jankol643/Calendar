<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Task;

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
        // Retrieve all events and tasks
        $events = Event::all();
        $tasks = Task::all();

        // Pass the collections to the view
        return view('calendar.index', compact('events', 'tasks'));
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
