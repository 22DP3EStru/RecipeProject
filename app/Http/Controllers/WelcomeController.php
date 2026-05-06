<?php

/**
 * WelcomeController kontrolieris nodrošina sistēmas sākumlapas funkcionalitāti.
 *
 * Kontrolieris atbild par:
 * - sākumlapas attēlošanu;
 * - populārāko recepšu atlasi;
 * - recepšu vidējā vērtējuma aprēķināšanu;
 * - recepšu datu nodošanu sākumlapas skatam.
 */

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Attēlo sistēmas sākumlapu ar populārākajām receptēm.
     */
    public function index()
    {
        /**
         * Tiek atlasītas receptes kopā ar autoru datiem.
         */
        $popularRecipes = Recipe::with(['user'])

            /**
             * Tiek atlasītas tikai tās receptes,
             * kurām eksistē saistīts lietotājs.
             */
            ->whereHas('user')

            /**
             * Katrai receptei tiek aprēķināts vidējais vērtējums
             * no ratings tabulas.
             */
            ->withAvg('ratings', 'rating')

            /**
             * Receptes tiek sakārtotas dilstošā secībā
             * pēc vidējā vērtējuma.
             */
            ->orderByDesc('ratings_avg_rating')

            /**
             * Tiek atlasītas tikai trīs populārākās receptes.
             */
            ->take(3)

            /**
             * Tiek izpildīts datubāzes vaicājums.
             */
            ->get();

        /**
         * Populārāko recepšu dati tiek nodoti welcome skatam.
         */
        return view('welcome', compact('popularRecipes'));
    }
}