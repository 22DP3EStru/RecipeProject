<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Get 3 most popular recipes based on ratings
        $popularRecipes = Recipe::with(['user', 'category'])
            ->withAvg('ratings', 'rating')
            ->orderByDesc('ratings_avg_rating')
            ->take(3)
            ->get();

        return view('welcome', compact('popularRecipes'));
    }
}
