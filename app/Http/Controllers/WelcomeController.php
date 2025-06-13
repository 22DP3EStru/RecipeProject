<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Get 3 most popular recipes based on ratings
        // Make sure we only get recipes that have users
        $popularRecipes = Recipe::with(['user'])
            ->whereHas('user') // This ensures we only get recipes with existing users
            ->withAvg('ratings', 'rating')
            ->orderByDesc('ratings_avg_rating')
            ->take(3)
            ->get();

        return view('welcome', compact('popularRecipes'));
    }
}
