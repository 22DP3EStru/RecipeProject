<?php

/**
 * CommentFactory klase nodrošina testa komentāru datu ģenerēšanu.
 *
 * Factory atbild par:
 * - nejaušu komentāru datu izveidi;
 * - testa ierakstu ģenerēšanu datubāzei;
 * - Faker bibliotēkas izmantošanu komentāru satura izveidei;
 * - automatizētu testu un datu aizpildes atbalstu.
 */

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Definē komentāra noklusējuma datu struktūru.
     */
    public function definition(): array
    {
        return [
            /**
             * Tiek ģenerēts nejaušs komentāra teksts,
             * izmantojot Faker bibliotēku.
             */
            'body' => $this->faker->sentence(),
        ];
    }
}