<?php

/**
 * RecipeFactory klase nodrošina testa recepšu datu ģenerēšanu.
 *
 * Factory atbild par:
 * - nejaušu recepšu datu izveidi;
 * - testa ierakstu ģenerēšanu datubāzei;
 * - recepšu sasaisti ar lietotājiem un kategorijām;
 * - Faker bibliotēkas izmantošanu datu ģenerēšanai;
 * - automatizētu testu un datu aizpildes atbalstu.
 */

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

class RecipeFactory extends Factory
{
    /**
     * Definē receptes noklusējuma datu struktūru.
     */
    public function definition(): array
    {
        return [

            /**
             * Tiek ģenerēts nejaušs receptes nosaukums
             * ar četriem vārdiem.
             */
            'title' => $this->faker->sentence(4),

            /**
             * Tiek ģenerēts nejaušs receptes apraksts
             * ar trim teikumiem.
             */
            'description' => $this->faker->paragraph(3),

            /**
             * Tiek norādīts noklusējuma receptes attēla ceļš.
             */
            'image' => 'recipes/default.jpg',

            /**
             * Receptes ierakstam tiek piešķirts
             * nejauši izvēlēts lietotājs.
             */
            'user_id' => User::inRandomOrder()->first()->id,

            /**
             * Receptes ierakstam tiek piešķirta
             * nejauši izvēlēta kategorija.
             */
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}