<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;

/**
 * Galvenais datubāzes seederis.
 *
 * Šis seederis tiek izmantots tikai sistēmas pamata datu izveidei.
 * Šeit netiek ģenerētas testa receptes, lai netiktu sajaukti
 * lietotāja ievadītie dati ar automātiski izveidotiem datiem.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Izpilda datubāzes sākotnējo aizpildīšanu.
     */
    public function run(): void
    {
        /**
         * Tiek izveidots vai atjaunināts administratora konts.
         *
         * updateOrCreate nodrošina, ka administrators netiek
         * izveidots vairākas reizes pie atkārtotas seeder palaišanas.
         */
        User::updateOrCreate(
            [
                'email' => 'admin@example.com',
            ],
            [
                'name' => 'Admin',

                /**
                 * Parole tiek šifrēta ar bcrypt algoritmu.
                 */
                'password' => bcrypt('Admin12345!'),

                /**
                 * Lietotājam tiek piešķirtas administratora tiesības.
                 */
                'is_admin' => true,
            ]
        );

        /**
         * Tiek definēts sistēmā pieejamo kategoriju saraksts.
         *
         * Šīs kategorijas vēlāk lietotājs var izmantot,
         * pievienojot receptes mājaslapā.
         */
        collect([
            'Brokastis',
            'Pusdienas',
            'Vakariņas',
            'Deserti',
            'Dzērieni',
            'Uzkodas',
            'Salāti',
            'Zupas',
            'Veģetārās',
            'Vegānās',
            'Bezglutēna',
            'Ātrās receptes',
        ])->each(function ($name) {

            /**
             * Katra kategorija tiek izveidota tikai tad,
             * ja tā vēl neeksistē datubāzē.
             */
            Category::firstOrCreate([
                'name' => $name,
            ]);
        });

        /**
         * Šajā seederī netiek ģenerētas testa receptes.
         *
         * Visas receptes tiek pievienotas tikai caur mājaslapu,
         * lai lietotāja ievadītie dati netiktu pārrakstīti
         * vai sajaukti ar automātiski ģenerētiem datiem.
         */
    }
}