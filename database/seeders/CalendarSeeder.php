<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Calendar;

class CalendarSeeder extends Seeder {
    public function run() {
        $user = User::first();

        Calendar::create([
            'user_id' => $user->id,
            'title' => 'Birthdays',
            'description' => 'A calendar for all birthdays.',
            'color' => '#FF5733'
        ]);
    }
}
