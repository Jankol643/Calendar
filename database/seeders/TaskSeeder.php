<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use DateTimeImmutable;
use Carbon\Carbon;
use Faker;
use App\Http\Controllers\Helpers\DateUtil;

class TaskSeeder extends Seeder {
    public function run() {
        $this->create_random_tasks(10);
    }

    private function create_random_tasks(int $number): void {
        $faker = Faker\Factory::create();
        $currYear = new DateTimeImmutable();
        $currYear = (int)$currYear->format('Y');
        for ($i = 0; $i < $number; $i++) {
            $recurr = random_int(0, 999999999999999) / 1000000000000000 < 0.5 ? true : false;
            $freq_no = null;
            $freq_dur = null;
            $last_exec = null;

            // Generate random start and end dates
            $startDate = $faker->dateTimeBetween('-1 year', '+1 year');
            $endDate = $faker->dateTimeBetween($startDate, '+5 years');
            while ($startDate > $endDate) {
                $startDate = $faker->dateTimeBetween('-1 year', '+1 year');
                $endDate = $faker->dateTimeBetween($startDate, '+5 years');
            }

            // Generate random due date
            $dueDate = $faker->dateTimeBetween($startDate, $endDate);

            $task_cat = $faker->regexify('[A-Za-z0-9]{20}');
            $task_name = $faker->regexify('[A-Za-z0-9]{20}');
            $task_descr = $faker->regexify('[A-Za-z0-9]{50}');
            $task_dur = rand(1, 250);
            $prio = rand(0, 10);
            $t = Task::createTask($recurr, $freq_no, $freq_dur, $last_exec, $startDate, $endDate, $dueDate, $task_cat, $task_name, $task_descr, $task_dur, $prio);
            $t->save();
        }
    }
}
