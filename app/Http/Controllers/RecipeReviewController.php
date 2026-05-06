<?php

/**
 * RecipeReviewController kontrolieris nodrošina recepšu vērtēšanas funkcionalitāti
 * recepšu tīmekļa vietnē.
 *
 * Kontrolieris atbild par:
 * - lietotāja vērtējuma saglabāšanu;
 * - esoša vērtējuma atjaunināšanu;
 * - lietotāja vērtējuma dzēšanu;
 * - vērtējuma datu validāciju;
 * - vērtējuma sasaisti ar recepti un autentificēto lietotāju.
 */

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeReviewController extends Controller
{
    /**
     * Saglabā vai atjaunina lietotāja vērtējumu konkrētai receptei.
     */
    public function store(Request $request, Recipe $recipe)
    {
        /**
         * Tiek validēts lietotāja iesniegtais vērtējums.
         * Vērtējumam jābūt veselam skaitlim intervālā no 1 līdz 5.
         */
        $data = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ], [
            'rating.required' => 'Lūdzu, izvēlieties vērtējumu.',
            'rating.integer' => 'Vērtējumam jābūt skaitlim.',
            'rating.min' => 'Minimālais vērtējums ir 1.',
            'rating.max' => 'Maksimālais vērtējums ir 5.',
        ]);

        /**
         * updateOrCreate metode pārbauda, vai lietotājs jau ir novērtējis šo recepti.
         * Ja vērtējums jau eksistē, tas tiek atjaunināts.
         * Ja vērtējums vēl neeksistē, tiek izveidots jauns ieraksts.
         */
        RecipeReview::updateOrCreate(
            [
                'recipe_id' => $recipe->id,
                'user_id' => Auth::id(),
            ],
            [
                'rating' => $data['rating'],
                'comment' => null,
            ]
        );

        /**
         * Pēc vērtējuma saglabāšanas lietotājs tiek novirzīts atpakaļ
         * ar veiksmīgas darbības paziņojumu.
         */
        return back()->with('success', 'Tavs vērtējums ir saglabāts!');
    }

    /**
     * Dzēš pašreizējā lietotāja vērtējumu konkrētai receptei.
     */
    public function destroy(Recipe $recipe)
    {
        /**
         * Tiek atrasts un dzēsts tikai tas vērtējums,
         * kas pieder pašreiz autentificētajam lietotājam
         * un konkrētajai receptei.
         */
        RecipeReview::where('recipe_id', $recipe->id)
            ->where('user_id', Auth::id())
            ->delete();

        /**
         * Pēc vērtējuma dzēšanas lietotājs tiek novirzīts atpakaļ
         * ar veiksmīgas darbības paziņojumu.
         */
        return back()->with('success', 'Tavs vērtējums ir dzēsts!');
    }
}