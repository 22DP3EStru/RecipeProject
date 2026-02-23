<?php // Norāda, ka šis ir PHP fails

namespace Database\Factories; // Definē nosaukumvietu (namespace) fabriku klasēm

use Illuminate\Database\Eloquent\Factories\Factory; // Iekļauj bāzes Factory klasi

class CommentFactory extends Factory // Definē CommentFactory klasi, kas paplašina Factory
{
    public function definition(): array // Metode, kas nosaka noklusējuma datu struktūru fabrikas izveidei
    {
        return [
            'body' => $this->faker->sentence(), // Ģenerē nejaušu teikumu komentāra tekstam, izmantojot Faker bibliotēku
        ];
    }
}
