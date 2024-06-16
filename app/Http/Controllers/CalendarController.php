<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller {
    public function index() {
        $events = Event::get_all();
        return view('calendar.index', compact('events'));
    }

    public function eventDetail(Request $request, $event) {
        $event = Event::find($event);
        return view('calendar.event-detail', compact('event'));
    }
}
