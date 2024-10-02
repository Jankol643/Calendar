<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller {
    // Display a listing of the user's calendars
    public function index() {
        $calendars = Calendar::where('user_id', Auth::id())->get();
        return response()->json($calendars);
    }

    // Store a newly created calendar
    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $calendar = Calendar::create([
            'user_id' => $request->user_id,
        ]);

        return response()->json($calendar, 201);
    }

    // Display the specified calendar
    public function show($id) {
        $calendar = Calendar::findOrFail($id);
        return response()->json($calendar);
    }

    // Update the specified calendar
    public function update(Request $request, $id) {
        $calendar = Calendar::findOrFail($id);

        $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $calendar->update($request->only('user_id'));

        return response()->json($calendar);
    }

    // Remove the specified calendar
    public function destroy($id) {
        $calendar = Calendar::findOrFail($id);
        $calendar->delete();

        return response()->json(null, 204);
    }

    // Display the events and tasks for a specific calendar
    public function showCalendarItems($id) {
        $calendar = Calendar::findOrFail($id);

        // Ensure the calendar belongs to the logged-in user
        if ($calendar->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Retrieve events and tasks associated with the calendar
        $events = $calendar->events; // Assuming a relationship exists
        $tasks = $calendar->tasks; // Assuming a relationship exists

        return response()->json([
            'calendar' => $calendar,
            'events' => $events,
            'tasks' => $tasks,
        ]);
    }
}
