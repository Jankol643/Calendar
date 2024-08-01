<?php

namespace App\Models;

use App\Models\CalendarEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DateTime;

/**
 * Class Event
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property \DateTime $start_date
 * @property \DateTime $end_date
 * @property bool $all_day
 * @property int $user_id
 */
class Event extends CalendarEntry {
    protected $table = 'events';

    protected $fillable = [
        'id',
        'title',
        'description',
        'start_date',
        'end_date',
        'all_day',
        'user_id',
        'created_at',
        'updated_at'
    ];

    protected $guarded = [
        'location'
    ];

    public function location() {
        return $this->hasOne(Location::class);
    }

    /**
     * Create a new Event in the database.
     *
     * @param Request $request The incoming request containing the necessary data for creating a new Event.
     * @return \Illuminate\Http\JsonResponse The created Event as a JSON response with a HTTP 201 status code.
     *
     * @throws \Illuminate\Validation\ValidationException If the incoming request data fails validation.
     * @throws \Carbon\Exceptions\InvalidDateException If the start_time or end_time format is invalid.
     */
    public function create(Request $request) {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date|before_or_equal:end_date',
            'start_time' => 'required',
            'end_date' => 'required|date',
            'end_time' => 'required'
        ]);

        $event = new Event();
        $event->title = $validated['title'];
        $event->description = $validated['description'];

        $dateFormat = 'Y-m-d';
        $timeFormat = 'H:i';

        $start_date = DateTime::createFromFormat($dateFormat, $validated['start_date']);
        $end_date = DateTime::createFromFormat($dateFormat, $validated['end_date']);

        $event->start_date = $start_date;
        $event->end_date = $end_date;

        $start_time = DateTime::createFromFormat($timeFormat, $validated['start_time']);
        $end_time = DateTime::createFromFormat($timeFormat, $validated['end_time']);

        if (!isset($request->all_day)) {
            $event->start_date->setTime($start_time->format('H'), $start_time->format('i'));
            $event->end_date->setTime($end_time->format('H'), $end_time->format('i'));
            $event->all_day = false;
        } else {
            $event->all_day = true;
        }

        $event->user_id = 1;
        $event->save();

        return response()->json($event, 201);
    }

    /**
     * Update an existing Event in the database.
     *
     * @param Request $request The incoming request containing the necessary data for updating an existing Event.
     * @param int $id The ID of the Event to update.
     * @return \Illuminate\Http\JsonResponse The updated Event as a JSON response with a HTTP 200 status code.
     *
     * @throws \Illuminate\Validation\ValidationException If the incoming request data fails validation.
     * @throws \Carbon\Exceptions\InvalidDateException If the start_time or end_time format is invalid.
     */
    public function updateEvent(Request $request, $id) {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date|before_or_equal:end_date',
            'start_time' => 'required',
            'end_date' => 'required|date',
            'end_time' => 'required'
        ]);

        $event->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'start_date' => Carbon::parse($validated['start_date']),
            'end_date' => Carbon::parse($validated['end_date']),
            'user_id' => $validated['user_id'],
        ]);
    }

    public static function get_by_user($user_id) {
        return self::where('user_id', $user_id)->get();
    }

    public static function get_all() {
        return self::all();
    }

    public function getEvents() {
        $events = Event::all()->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => $event->start_date->format('Y-m-d\TH:i:s'),
                'end' => $event->end_date->format('Y-m-d\TH:i:s'),
                'allDay' => $event->all_day,
            ];
        });

        return response()->json($events);
    }
}
