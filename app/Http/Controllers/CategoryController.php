<?php

/**
 * CategoryController kontrolieris nodrošina recepšu kategoriju
 * attēlošanu recepšu tīmekļa vietnē.
 *
 * Kontrolieris atbild par:
 * - visu recepšu kategoriju sākumlapas attēlošanu;
 * - konkrētas kategorijas recepšu attēlošanu;
 * - kategoriju datu iegūšanu no datubāzes;
 * - recepšu filtrēšanu pēc kategorijas;
 * - kategoriju saraksta nodošanu skatiem.
 */

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Attēlo kategoriju sākumlapu ar visām receptēm.
     */
    public function index()
    {
        /**
         * Tiek iegūtas visas receptes no datubāzes.
         * Receptes tiek ielādētas kopā ar autoru datiem
         * un sakārtotas pēc jaunākajiem ierakstiem.
         */
        $recipes = Recipe::with('user')
            ->latest()
            ->get();

        /**
         * Iegūtie dati tiek nodoti kategoriju skatam.
         */
        return view('categories', compact('recipes'));
    }

    /**
     * Attēlo konkrētas kategorijas receptes.
     */
    public function show($category)
    {
        /**
         * URL kategorijas nosaukums tiek pārveidots
         * cilvēkam lasāmā formātā.
         */
        $categoryName = urldecode($category);

        /**
         * Tiek atlasītas receptes, kuru kategorija
         * sakrīt ar izvēlēto kategoriju.
         *
         * Receptes tiek ielādētas kopā ar autoru datiem,
         * sakārtotas pēc jaunākajiem ierakstiem
         * un sadalītas lapās pa 12 receptēm.
         */
        $recipes = Recipe::with('user')
            ->where('category', $categoryName)
            ->latest()
            ->paginate(12);

        /**
         * Tiek iegūts visu unikālo kategoriju saraksts.
         * Tukšās vērtības tiek izņemtas no rezultāta.
         */
        $allCategories = Recipe::distinct('category')
            ->pluck('category')
            ->filter();

        /**
         * Kategorijas dati tiek nodoti categories.show skatam.
         */
        return view('categories.show', [
            'recipes' => $recipes,
            'categoryName' => $categoryName,
            'allCategories' => $allCategories
        ]);
    }
}