<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
class Event extends Model {
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

    public static function get_by_user($user_id) {
        return self::where('user_id', $user_id)->get();
    }

    public static function get_all() {
        return self::all();
    }

    /**
     * Convert all events to FullCalendar format.
     *
     * @return array
     */
    public static function toFullCalendarFormat() {
        return self::all()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => \Carbon\Carbon::parse($event->start_date)->toIso8601String(),
                'end' => \Carbon\Carbon::parse($event->end_date)->toIso8601String(),
                'allDay' => $event->all_day,
                'extendedProps' => [
                    'description' => $event->description
                ],
            ];
        })->toArray();
    }
}
