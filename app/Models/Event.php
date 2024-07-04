<?php

namespace App\Models;

use App\Models\CalendarEntry;
use Carbon\Exceptions\InvalidFormatException;
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
        $start_date = DateTime::createFromFormat('Y-m-d', $validated['start_date']);
        $end_date = DateTime::createFromFormat('Y-m-d', $validated['start_date']);
        // Convert the start_time and end_time to DateTime objects
        $start_time = DateTime::createFromFormat('H:i', $validated['start_time']);
        $end_time = DateTime::createFromFormat('H:i', $validated['end_time']);

        // Check if the conversion was successful
        if ($start_date !== false && $end_date !== false && $start_time !== false && $end_time !== false) {
            // Assign the DateTime objects to the start_date and end_date variables
            $event->start_date = $start_date;
            $event->end_date = $end_date;
            // Now you can use the setTime() method on the DateTime objects
            $event->start_date->setTime($start_time->format('H'), $start_time->format('i'));
            $event->end_date->setTime($end_time->format('H'), $end_time->format('i'));
        } else {
            throw new InvalidFormatException('Invalid start_time or end_time format');
        }
        if ($request->all_day === 'on' || $request->all_day === '1') {
            $event->all_day = true;
        } else {
            $event->all_day = false;
        }
        $event->user_id = 1;
        $event->save();
        Log::debug(print_r($event, true));

        return response()->json($event, 201);
    }

    public static function get_all() {
        return self::all();
    }
}
