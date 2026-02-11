<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $recipes = $request->user()
            ->favoriteRecipes()
            ->latest('favorites.created_at')
            ->paginate(12);

        return view('profile.favorites', compact('recipes'));
    }

    public function toggle(Request $request, Recipe $recipe)
    {
        $request->user()->favoriteRecipes()->toggle($recipe->id);

        return back()->with('success', 'Favorīti atjaunināti.');
    }
}
