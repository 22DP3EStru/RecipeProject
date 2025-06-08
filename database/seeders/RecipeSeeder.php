<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Recipe;

// database/seeders/RecipeSeeder.php
class RecipeSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Recipe::factory(20)
            ->create()
            ->each(function ($recipe) {
                $recipe->categories()
                       ->attach(\App\Models\Category::inRandomOrder()->take(2)->pluck('id'));
            });

        Recipe::factory(10)->create()->each(function ($recipe) {
            $recipe->categories()->attach(
                Category::inRandomOrder()->take(rand(1, 3))->pluck('id')
            );
        });
    }
}

