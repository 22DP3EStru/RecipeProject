<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Recipe $recipe)
    {
        $user = Auth::user();
        
        if ($user->favoriteRecipes()->where('recipe_id', $recipe->id)->exists()) {
            // Remove from favorites
            $user->favoriteRecipes()->detach($recipe->id);
            $favorited = false;
        } else {
            // Add to favorites
            $user->favoriteRecipes()->attach($recipe->id);
            $favorited = true;
        }
        
        return response()->json([
            'success' => true,
            'favorited' => $favorited
        ]);
    }
}
