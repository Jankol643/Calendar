<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reminder
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property \DateTime $remind_at
 * @property int $user_id
 */
class Reminder extends Model {
    protected $fillable = [
        'id',
        'title',
        'description',
        'remind_at',
        'user_id'
    ];
}
