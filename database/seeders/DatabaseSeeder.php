<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        // Citas kategorijas
        $categories = collect(['Zupas', 'Pamatēdieni', 'Deserti', 'Uzkodas', 'Dzērieni'])->map(function ($name) {
            return Category::create(['name' => $name]);
        });

        // 5 lietotāji
        User::factory(4)->create();

        $users = User::all();

        // 15 receptes
        Recipe::factory(15)->create()->each(function ($recipe) use ($users, $categories) {
            $recipe->update([
                'category_id' => $categories->random()->id,
                'user_id' => $users->random()->id,
            ]);

            // Katrai receptei 1-3 komentāri
            Comment::factory(rand(1,3))->create([
                'recipe_id' => $recipe->id,
                'user_id' => $users->random()->id,
            ]);

            // Katrai receptei 1 vērtējums no random user
            Rating::create([
                'recipe_id' => $recipe->id,
                'user_id' => $users->random()->id,
                'rating' => rand(3,5),
            ]);
        });
    }
}
