<?php

namespace App\Http\Controllers;

use App\Models\Event;

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
        $events = Event::all();

        // Convert the events to an array of objects with all parameters
        $events = $events->map(function ($event) {
            return (object) [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'start_date' => $event->start_date instanceof \DateTime ? $event->start_date->format('Y-m-d H:i:s') : null,
                'end_date' => $event->end_date instanceof \DateTime ? $event->end_date->format('Y-m-d H:i:s') : null,
                'all_day' => $event->all_day,
                'user_id' => $event->user_id
            ];
        });

        return view('calendar.index', compact('events'));
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
