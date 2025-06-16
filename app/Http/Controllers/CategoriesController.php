<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with('user')->latest()->get();
        return view('categories', compact('recipes'));
    }

    public function show($category)
    {
        // Decode the category name from URL
        $categoryName = urldecode($category);
        
        // Get recipes for this specific category
        $recipes = Recipe::with('user')
            ->where('category', $categoryName)
            ->latest()
            ->paginate(12);
        
        // Get all categories for navigation
        $allCategories = Recipe::distinct('category')->pluck('category')->filter();
        
        return view('categories.show', [
            'recipes' => $recipes,
            'categoryName' => $categoryName,
            'allCategories' => $allCategories
        ]);
    }
}
