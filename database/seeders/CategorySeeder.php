<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder {
    public function run() {
        // Define the categories and subcategories
        $categories = [
            'Military' => ['Equipment'],
            'Programming' => ['Todo', 'Task'],
            'Digital' => ['Todo'],
            'Airplane' => ['Crash'],
            'Environment' => ['Water'],
            'Journalism' => [],
            'Child' => [],
            'Electricity' => ['Tools'],
            'Welding' => [],
            'Occupational Safety' => ['Hands'],
            'Food' => ['Sweets'],
            'Tools' => ['Woodworking'],
            'Small Animals' => ['Food'],
            'Pets' => ['Dogs'],
            'Hobby' => ['Climbing', 'Model Building'],
            'Physics' => ['Falling Speed', 'Energy Demand'],
            'Computer' => ['Configuration'],
            'Shopping' => ['Smoke Detectors', 'Tools'],
            'Safety' => ['Self-Defense'],
            'Learning' => ['General'],
        ];

        foreach ($categories as $categoryName => $subcategories) {
            $category = Category::create(['name' => $categoryName]);
            foreach ($subcategories as $subcategoryName) {
                Category::create(['name' => $subcategoryName, 'parent_id' => $category->id]);
            }
        }
    }
}
