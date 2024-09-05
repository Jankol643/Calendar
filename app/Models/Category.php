<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Category extends Model {
    protected $fillable = ['name', 'parent_id'];

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function tasks() {
        return $this->belongsToMany(Task::class, 'task_category_rel');
    }
}
