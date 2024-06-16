<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Navbar;

class NavbarSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $links = [
            [
                'name' => 'Welcome',
                'route' => '/',
                'ordering' => 1,
                'parent_id' => null
            ],
            [
                'name' => 'Calendar',
                'route' => 'calendar',
                'ordering' => 2,
                'parent_id' => null
            ],
            [
                'name' => 'Downloads',
                'route' => 'downloads',
                'ordering' => 3,
                'parent_id' => null
            ],
            [
                'name' => 'Home',
                'route' => 'home',
                'ordering' => 4,
                'parent_id' => null
            ]
        ];

        foreach ($links as $navbar) {
            Navbar::create($navbar);
        }
    }
}
