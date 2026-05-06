<?php

/**
 * UserFactory klase nodrošina testa lietotāju datu ģenerēšanu.
 *
 * Factory atbild par:
 * - nejaušu lietotāju datu izveidi;
 * - unikālu e-pasta adrešu ģenerēšanu;
 * - paroļu šifrēšanu;
 * - autentifikācijas tokenu ģenerēšanu;
 * - automatizētu testu un datu aizpildes atbalstu.
 */

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Definē lietotāja noklusējuma datu struktūru.
     */
    public function definition(): array
    {
        return [

            /**
             * Tiek ģenerēts nejaušs lietotāja vārds,
             * izmantojot Faker bibliotēku.
             */
            'name' => $this->faker->name(),

            /**
             * Tiek ģenerēta unikāla un droša e-pasta adrese.
             */
            'email' => $this->faker->unique()->safeEmail(),

            /**
             * Tiek iestatīts e-pasta apstiprināšanas datums
             * uz pašreizējo laiku.
             */
            'email_verified_at' => now(),

            /**
             * Noklusējuma parole tiek šifrēta,
             * izmantojot Hash funkcionalitāti.
             */
            'password' => Hash::make('password'),

            /**
             * Tiek ģenerēts nejaušs atcerēšanās tokens,
             * kuru izmanto autentifikācijas sistēma.
             */
            'remember_token' => Str::random(10),
        ];
    }
}