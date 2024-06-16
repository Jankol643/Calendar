<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Task extends CalendarEntry {
    protected $fillable = [
        'name',
        'description',
        'category',
        'due_date',
        'duration',
        'prio',
    ];
}
