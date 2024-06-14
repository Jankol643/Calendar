<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RecurringEvent
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $frequency
 * @property \DateTime $start_date
 * @property \DateTime $end_date
 * @property bool $all_day
 * @property int $user_id
 */
class RecurringEvent extends Model {
    protected $fillable = [
        'id',
        'title',
        'description',
        'frequency',
        'start_date',
        'end_date',
        'all_day',
        'user_id'
    ];
}
