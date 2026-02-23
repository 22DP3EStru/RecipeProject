<?php // Sākas PHP kods

namespace App\Http\Controllers; // Kontrolieris atrodas Controllers mapē

use App\Models\Recipe; // Recipe modelis (recipes tabula)
use Illuminate\Http\Request; // HTTP pieprasījums (šajā failā tieši netiek izmantots)

class CategoryController extends Controller // Kontrolieris kategoriju lapām
{
    public function index() // Parāda kategoriju sākumlapu (šeit: visas receptes)
    {
        $recipes = Recipe::with('user')->latest()->get(); 
        // Paņem visas receptes no datubāzes
        // with('user') nozīmē: paņem arī receptes autoru (lietotāju)
        // latest() nozīmē: jaunākās receptes pirmās
        // get() nozīmē: paņem visus ierakstus (bez lapošanas)

        return view('categories', compact('recipes')); 
        // Atver categories skatu un iedod tam mainīgo $recipes
    }

    public function show($category) // Parāda konkrētas kategorijas receptes
    {
        $categoryName = urldecode($category); 
        // Pārvērš URL tekstu normālā tekstā
        // (piem., %20 pārvēršas par atstarpi)

        $recipes = Recipe::with('user') 
            // Paņem receptes kopā ar autoru (user)
            ->where('category', $categoryName) 
            // Filtrē receptes, kur category sakrīt ar izvēlēto kategoriju
            ->latest() 
            // Jaunākās receptes pirmās
            ->paginate(12); 
            // Parāda pa 12 receptēm vienā lapā (lapošana)

        $allCategories = Recipe::distinct('category')->pluck('category')->filter(); 
        // Paņem visas unikālās kategorijas no recipes tabulas
        // distinct('category') nozīmē: bez dublikātiem
        // pluck('category') paņem tikai category kolonnu (sarakstu)
        // filter() izmet tukšās vērtības (piem., null vai "")

        return view('categories.show', [ 
            // Atver categories.show skatu un iedod tam šos datus
            'recipes' => $recipes, // Konkrētās kategorijas receptes
            'categoryName' => $categoryName, // Kategorijas nosaukums, ko rāda lapā
            'allCategories' => $allCategories // Visu kategoriju saraksts (piem., sidebar/filtrs)
        ]);
    }
}


