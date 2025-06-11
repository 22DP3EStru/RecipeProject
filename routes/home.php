<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
|
| Here are the routes for the main public pages of the recipe website
|
*/

// Main homepage - shows welcome page
Route::get('/', function () {
    $featuredRecipes = \App\Models\Recipe::with(['user', 'category'])
        ->latest()
        ->limit(6)
        ->get();
    
    $categories = \App\Models\Category::all();
    
    return view('welcome', compact('featuredRecipes', 'categories'));
})->name('home');

// Recipes pages
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

// Categories pages
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Search functionality
Route::get('/search', [RecipeController::class, 'search'])->name('recipes.search');