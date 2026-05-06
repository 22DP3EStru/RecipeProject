<?php

/**
 * FavoriteController kontrolieris nodrošina favorītu funkcionalitāti
 * recepšu tīmekļa vietnē.
 *
 * Kontrolieris atbild par:
 * - lietotāja favorītu saraksta attēlošanu;
 * - favorītu statistikas apkopošanu;
 * - receptes pievienošanu favorītiem;
 * - receptes izņemšanu no favorītiem;
 * - favorītu datu nodošanu skatiem.
 */

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Attēlo autentificētā lietotāja favorītu receptes.
     */
    public function index(Request $request)
    {
        /**
         * Tiek iegūts pašreiz autorizētais lietotājs.
         */
        $user = $request->user();

        /**
         * Tiek izveidots favorītu recepšu vaicājums,
         * izmantojot lietotāja favoriteRecipes relāciju.
         */
        $favoritesQuery = $user->favoriteRecipes();

        /**
         * Tiek iegūtas favorītu receptes,
         * sakārtotas pēc jaunākajiem favorītu ierakstiem
         * un sadalītas lapās pa 12 receptēm.
         */
        $recipes = (clone $favoritesQuery)
            ->latest('favorites.created_at')
            ->paginate(12)
            ->withQueryString();

        /**
         * Tiek aprēķināts kopējais favorītu recepšu skaits.
         */
        $favoritesCount = (clone $favoritesQuery)->count();

        /**
         * Tiek aprēķināts pēdējo 30 dienu laikā
         * pievienoto favorītu skaits.
         */
        $recentFavoritesCount = (clone $favoritesQuery)
            ->wherePivot('created_at', '>=', now()->subDays(30))
            ->count();

        /**
         * Tiek noteikts unikālo favorītu kategoriju skaits,
         * neiekļaujot tukšas kategorijas.
         */
        $categoriesCount = (clone $favoritesQuery)
            ->whereNotNull('recipes.category')
            ->where('recipes.category', '!=', '')
            ->distinct('recipes.category')
            ->count('recipes.category');

        /**
         * Favorītu dati un statistika tiek nodota profilā esošajam favorītu skatam.
         */
        return view('profile.favorites', compact(
            'recipes',
            'favoritesCount',
            'recentFavoritesCount',
            'categoriesCount'
        ));
    }

    /**
     * Pievieno vai izņem recepti no lietotāja favorītiem.
     */
    public function toggle(Request $request, Recipe $recipe)
    {
        /**
         * toggle metode automātiski:
         * - pievieno recepti favorītiem, ja tās tur nav;
         * - izņem recepti no favorītiem, ja tā jau eksistē.
         */
        $request->user()
            ->favoriteRecipes()
            ->toggle($recipe->id);

        /**
         * Pēc darbības lietotājs tiek novirzīts atpakaļ
         * ar veiksmīgas darbības paziņojumu.
         */
        return back()->with('success', 'Favorīti atjaunināti.');
    }
}