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
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, 'task_category_rel');
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categories' => 'nullable|array', // Allow multiple categories
            'categories.*' => 'string', // Each category should be a string
            'due_date' => 'nullable|date',
            'duration' => 'nullable|integer',
            'prio' => 'nullable|integer',
        ]);

        // Create a new Task instance
        $task = new Task();
        $task->name = $validated['name'];
        $task->description = $validated['description'];
        $task->due_date = $validated['due_date'];
        $task->duration = $validated['duration'];
        $task->prio = $validated['prio'];

        if (!empty($validated['categories'])) {
            foreach ($validated['categories'] as $categoryName) {
                $category = Category::firstOrCreate(['name' => $categoryName]);
                $task->categories()->attach($category->id);
            }
        }

        $task->user_id = 1; // Assuming a user ID is set here
        $task->save();

        return response()->json($task, 201);
    }
}
