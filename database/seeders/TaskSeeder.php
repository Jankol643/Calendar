<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Calendar;
use App\Models\Task;
use App\Models\Category;

class TaskSeeder extends Seeder {
    public function run() {
        $user = User::first();
        $calendar = Calendar::first();

        $tasks = [
            [
                'name' => 'Buy a gift',
                'description' => 'Purchase a gift for John\'s birthday.',
                'due_date' => '2024-09-30',
                'duration' => 2,
                'priority' => 1,
                'categories' => ['Gifts', 'Shopping'],
                'calendar_id' => $calendar->id
            ],
            [
                'name' => 'Order cake',
                'description' => 'Order a birthday cake for John.',
                'due_date' => '2024-09-28',
                'duration' => 1,
                'priority' => 2,
                'categories' => ['Food', 'Events'],
                'calendar_id' => $calendar->id
            ]
        ];

        foreach ($tasks as $taskData) {
            $task = Task::create([
                'name' => $taskData['name'],
                'description' => $taskData['description'],
                'due_date' => $taskData['due_date'],
                'duration' => $taskData['duration'],
                'priority' => $taskData['priority'],
                'calendar_id' => $taskData['calendar_id']
            ]);

            if (!empty($taskData['categories'])) {
                foreach ($taskData['categories'] as $categoryName) {
                    $category = Category::firstOrCreate(['name' => $categoryName]);
                    $task->categories()->attach($category->id);
                }
            }
        }
    }
}
