<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    // RecipeFactory.php
    public function definition()
    { 
        $title = $this->faker->sentence(3);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph,
            'user_id' => User::factory(), // vai cita user loģika
        ];
}

}
