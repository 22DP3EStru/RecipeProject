<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Recipe, Category};

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        Recipe::factory(25)
            ->create()
            ->each(function ($recipe) {
                // piesaisti 1-3 nejaušas kategorijas
                $recipe->categories()
                       ->attach(Category::inRandomOrder()->take(rand(1, 3))->pluck('id'));
            });
    }
}
