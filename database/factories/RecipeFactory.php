<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RecipeFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(3);
        return [
            'title'       => $title,
            'slug'        => Str::slug($title) . '-' . Str::random(6),
            'description' => $this->faker->paragraph(),
            'ingredients' => implode("\n", $this->faker->sentences(5)),
            'steps'       => implode("\n\n", $this->faker->paragraphs(3)),
            'image'       => null,
            'user_id'     => User::factory(),
        ];
    }
}
