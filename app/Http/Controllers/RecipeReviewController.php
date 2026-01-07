<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeReviewController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $data = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:2000'],
        ]);

        RecipeReview::updateOrCreate(
            ['recipe_id' => $recipe->id, 'user_id' => Auth::id()],
            ['rating' => $data['rating'], 'comment' => $data['comment'] ?? null]
        );

        return back()->with('success', 'Tava atsauksme ir saglabāta!');
    }

    public function destroy(Recipe $recipe)
    {
        RecipeReview::where('recipe_id', $recipe->id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Tava atsauksme ir dzēsta!');
    }
}