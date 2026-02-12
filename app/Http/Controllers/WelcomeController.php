<?php // Sākas PHP kods

namespace App\Http\Controllers; // Kontrolieris atrodas Controllers mapē

use App\Models\Recipe; // Recipe modelis (recipes tabula)
use Illuminate\Http\Request; // HTTP pieprasījums (šajā failā netiek izmantots)

class WelcomeController extends Controller // Kontrolieris sākumlapai (welcome lapa)
{
    public function index() // Metode, kas parāda sākumlapu
    {
        // Get 3 most popular recipes based on ratings
        // Make sure we only get recipes that have users

        $popularRecipes = Recipe::with(['user']) 
            // Paņem receptes kopā ar autoru (user)

            ->whereHas('user') 
            // Nodrošina, ka tiek paņemtas tikai tās receptes,
            // kurām tiešām eksistē lietotājs (nav “bojātu” ierakstu)

            ->withAvg('ratings', 'rating') 
            // Aprēķina katrai receptei vidējo vērtējumu no ratings tabulas

            ->orderByDesc('ratings_avg_rating') 
            // Sakārto pēc vidējā vērtējuma (no lielākā uz mazāko)

            ->take(3) 
            // Paņem tikai 3 populārākās receptes

            ->get(); 
            // Izpilda vaicājumu un dabū rezultātus

        return view('welcome', compact('popularRecipes')); 
        // Atver welcome skatu un padod tam populārās receptes
    }
}
