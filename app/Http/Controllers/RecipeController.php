<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RecipeController extends Controller
{
    /**
     * Parāda recepšu sarakstu ar meklēšanas un kategoriju filtriem.
     */
    public function index(Request $request)
    {
        $query = Recipe::with('ratings', 'categories');

        // filtrs – kategorija
        if ($cat = $request->query('category')) {
            $query->whereHas('categories', fn ($q) => $q->where('slug', $cat));
        }

        // filtrs – meklēšana
        if ($s = $request->query('q')) {
            $query->where('title', 'like', "%$s%");
        }

        $recipes = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('recipes.index', compact('recipes', 'categories'));
    }

    /**
     * Parāda kategoriju sarakstu.
     */
    public function categories()
    {
        $categories = Category::withCount('recipes')->orderBy('name')->get();
        return view('recipes.categories', compact('categories'));
    }

    /**
     * Pārslēdz (pievieno/noņem) recepti lietotāja favorītos.
     */
    public function toggleFavorite(Recipe $recipe)
    {
        $recipe->favorites()->toggle(Auth::id());
        return back()->with('status', 'Favorīts tika atjaunināts!');
    }

    /**
     * Parāda autentificētā lietotāja favorītās receptes.
     */
    public function userFavorites()
    {
        /** @var \App\Models\User $user */ 
        $recipes = Auth::user()->favorites()->with('ratings', 'categories')->paginate(12);
        return view('recipes.favorites', compact('recipes'));
    }

    /**
     * Parāda konkrētas receptes detaļas pēc slug.
     */
    public function show($slug)
    {
        $recipe = Recipe::with('ratings', 'categories')->where('slug', $slug)->firstOrFail();
        return view('recipes.show', compact('recipe'));
    }
}
