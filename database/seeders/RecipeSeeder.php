<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{
    public function run()
    {
        Recipe::create([
            'title' => json_encode(['lv' => 'Ābolu pīrāgs', 'en' => 'Apple Pie']),
            'ingredients' => json_encode(['lv' => ['1 kg ābolu', '200 g cukura'], 'en' => ['1 kg apples', '200 g sugar']]),
            'steps' => json_encode(['lv' => ['Nomazgā ābolus', 'Cep 40 min'], 'en' => ['Wash apples', 'Bake 40 min']]),
        ]);
    }
}
