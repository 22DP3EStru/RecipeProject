<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $favoritesQuery = $user->favoriteRecipes();

        $recipes = (clone $favoritesQuery)
            ->latest('favorites.created_at')
            ->paginate(12)
            ->withQueryString();

        $favoritesCount = (clone $favoritesQuery)->count();

        $recentFavoritesCount = (clone $favoritesQuery)
            ->wherePivot('created_at', '>=', now()->subDays(30))
            ->count();

        $categoriesCount = (clone $favoritesQuery)
            ->whereNotNull('recipes.category')
            ->where('recipes.category', '!=', '')
            ->distinct('recipes.category')
            ->count('recipes.category');

        return view('profile.favorites', compact(
            'recipes',
            'favoritesCount',
            'recentFavoritesCount',
            'categoriesCount'
        ));
    }

    public function toggle(Request $request, Recipe $recipe)
    {
        $request->user()
            ->favoriteRecipes()
            ->toggle($recipe->id);

        return back()->with('success', 'Favorīti atjaunināti.');
    }
}