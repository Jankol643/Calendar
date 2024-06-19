<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CalendarEntry;
use Illuminate\Http\Request;

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
    protected $fillable = [
        'id',
        'title',
        'description',
        'start_date',
        'end_date',
        'all_day',
        'user_id'
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
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'all_day' => 'boolean',
        ]);

        // Create a new Event instance
        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->all_day = $request->all_day ?? false; // Default to false if 'all_day' is not provided
        $event->user_id = $request->user_id;

        // Save the Event to the database
        $event->save();

        return response()->json($event, 201);
    }

    public static function get_all() {
        return self::all();
    }
}
