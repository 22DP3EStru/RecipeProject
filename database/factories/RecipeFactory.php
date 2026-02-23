<?php // Norāda, ka šis ir PHP fails

namespace Database\Factories; // Definē nosaukumvietu (namespace) fabriku klasēm

use Illuminate\Database\Eloquent\Factories\Factory; // Iekļauj bāzes Factory klasi
use App\Models\User; // Iekļauj User modeli
use App\Models\Category; // Iekļauj Category modeli

class RecipeFactory extends Factory // Definē RecipeFactory klasi, kas paplašina Factory
{
    public function definition(): array // Metode, kas nosaka noklusējuma datu struktūru receptes ģenerēšanai
    {
        return [
            'title' => $this->faker->sentence(4), // Ģenerē nejaušu nosaukumu ar 4 vārdiem
            'description' => $this->faker->paragraph(3), // Ģenerē nejaušu aprakstu ar 3 teikumiem
            'image' => 'recipes/default.jpg', // Norāda noklusējuma attēla ceļu
            'user_id' => User::inRandomOrder()->first()->id, // Piešķir nejauša lietotāja ID
            'category_id' => Category::inRandomOrder()->first()->id, // Piešķir nejaušas kategorijas ID
        ];
    }
}

