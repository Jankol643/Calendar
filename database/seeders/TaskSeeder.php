<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use DateTimeImmutable;
use Faker;

class TaskSeeder extends Seeder {
    public function run() {
        $this->create_random_tasks(10);
    }

    private function create_random_tasks(int $number): void {
        for ($i = 0; $i < $number; $i++) {
            $this->create_random_task();
        }
    }

    private function create_random_task(): void {
        $faker = Faker\Factory::create();
        $name = $faker->regexify('[A-Za-z0-9]{20}');
        $description = $faker->regexify('[A-Za-z0-9]{50}');
        $category = $faker->regexify('[A-Za-z0-9]{20}');
        // Generate random due date
        $due_date = $faker->dateTimeBetween('now', '+3 months');
        $duration = rand(1, 250);
        $priority = rand(0, 10);
        $t = Task::createTask([
            'name' => $name,
            'description' => $description,
            'category' => $category,
            'due_date' => $due_date,
            'duration' => $duration,
            'priority' => $priority,
        ]);
        $t->save();
    }
}
