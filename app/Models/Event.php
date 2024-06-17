<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CalendarEntry;

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
}
