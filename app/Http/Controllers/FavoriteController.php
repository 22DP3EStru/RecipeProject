<?php // Sākas PHP kods

namespace App\Http\Controllers; // Kontrolieris atrodas Controllers mapē

use App\Models\Recipe; // Recipe modelis (recipes tabula)
use Illuminate\Http\Request; // HTTP pieprasījums

class FavoriteController extends Controller // Kontrolieris favorītu funkcionalitātei
{
    public function index(Request $request) // Parāda lietotāja favorītu receptes
    {
        $recipes = $request->user() 
            // Dabū pašreiz ielogoto lietotāju

            ->favoriteRecipes() 
            // Izsauc attiecību (relationship) no User modeļa
            // (daudzi pret daudziem starp users un recipes caur favorites tabulu)

            ->latest('favorites.created_at') 
            // Sakārto pēc pievienošanas datuma (jaunākie favorīti pirmie)

            ->paginate(12); 
            // Parāda 12 receptes vienā lapā (ar lapošanu)

        return view('profile.favorites', compact('recipes')); 
        // Atver profila favorītu lapu un padod tai receptes
    }

    public function toggle(Request $request, Recipe $recipe) 
    // Pievieno vai noņem recepti no favorītiem
    {
        $request->user()
            ->favoriteRecipes()
            ->toggle($recipe->id); 
        // Ja recepte jau ir favorītos → noņem
        // Ja nav → pievieno

        return back()->with('success', 'Favorīti atjaunināti.'); 
        // Atgriežas atpakaļ ar paziņojumu
    }
}
