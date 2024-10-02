<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Http\Request;

class Task extends Model {
    protected $fillable = [
        'name',
        'description',
        'due_date',
        'duration',
        'prio',
        'calendar_id'
    ];

    public function calendar() {
        return $this->belongsTo(Calendar::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'task_category_rel');
    }

    public function createTask($name, $description = null, $due_date = null, $duration = null, $prio = null, $categories = [], $calendar_id = 1) {
        // Create a new Task instance
        $task = new Task();
        $task->name = $name;
        $task->description = $description;
        $task->due_date = $due_date;
        $task->duration = $duration;
        $task->prio = $prio;
        $task->calendar_id = $calendar_id;

        // Save the task
        $task->save();

        // Handle categories if provided
        if (!empty($categories)) {
            foreach ($categories as $categoryName) {
                $category = Category::firstOrCreate(['name' => $categoryName]);
                $task->categories()->attach($category->id);
            }
        }

        return $task; // Return the created task
    }
}
