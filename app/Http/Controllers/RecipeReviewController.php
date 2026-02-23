<?php // Sākas PHP kods

namespace App\Http\Controllers; // Kontrolieris atrodas Controllers mapē

use App\Models\Recipe; // Recipe modelis (lai saņemtu konkrēto recepti no URL)
use App\Models\RecipeReview; // RecipeReview modelis (atsauksmes tabula)
use Illuminate\Http\Request; // HTTP pieprasījums (formu dati)
use Illuminate\Support\Facades\Auth; // Lai dabūtu ielogotā lietotāja ID

class RecipeReviewController extends Controller // Kontrolieris recepšu atsauksmēm (rating + komentārs)
{
    public function store(Request $request, Recipe $recipe) // Pievieno vai atjaunina atsauksmi konkrētai receptei
    {
        $data = $request->validate([ // Pārbauda ievadītos datus
            'rating' => ['required', 'integer', 'min:1', 'max:5'], // Vērtējums obligāts, skaitlis 1..5
            'comment' => ['nullable', 'string', 'max:2000'], // Komentārs nav obligāts, teksts, max 2000 simboli
        ]);

        RecipeReview::updateOrCreate( 
        // Ja atsauksme jau eksistē (šim lietotājam par šo recepti) → atjaunina
        // Ja neeksistē → izveido jaunu
            ['recipe_id' => $recipe->id, 'user_id' => Auth::id()], 
            // Meklē pēc: recipe_id + user_id (tātad 1 atsauksme uz 1 lietotāju uz 1 recepti)

            ['rating' => $data['rating'], 'comment' => $data['comment'] ?? null]
            // Ko saglabā: rating un comment (ja comment nav iedots, tad null)
        );

        return back()->with('success', 'Tava atsauksme ir saglabāta!'); 
        // Atgriežas atpakaļ ar paziņojumu, ka viss ok
    }

    public function destroy(Recipe $recipe) // Dzēš ielogotā lietotāja atsauksmi konkrētai receptei
    {
        RecipeReview::where('recipe_id', $recipe->id) // Atrod atsauksmi pēc receptes ID
            ->where('user_id', Auth::id()) // Un pēc ielogotā lietotāja ID
            ->delete(); // Dzēš to no datubāzes

        return back()->with('success', 'Tava atsauksme ir dzēsta!'); 
        // Atgriežas atpakaļ ar paziņojumu
    }
}
