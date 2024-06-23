<?php

namespace App\Models;

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
