<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder {
    public function run() {
        $faker = Faker::create();

        // Fetch all categories and their subcategories
        $categories = Category::with('children')->get();

        for ($i = 0; $i < 10; $i++) {
            $name = $faker->regexify('[A-Za-z0-9]{20}');
            $description = $faker->regexify('[A-Za-z0-9]{50}');
            // Generate random due date
            $due_date = $faker->dateTimeBetween('now', '+3 months');
            $duration = rand(1, 250);
            $priority = rand(0, 10);

            // Select a random category
            $category = $categories->random();
            // Select a random subcategory from the selected category
            $subcategory = $category->children->random();

            // Create a new Task instance
            $task = new Task([
                'name' => $name,
                'description' => $description,
                'due_date' => $due_date,
                'duration' => $duration,
                'prio' => $priority,
            ]);
            $task->save();

            // Attach the category and subcategory to the task
            $task->categories()->attach($category->id);
            if ($subcategory) {
                $task->categories()->attach($subcategory->id);
            }
        }
    }
}
