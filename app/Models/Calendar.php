<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model {

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'color'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
