<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WelcomeController;
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
Route::get('/', [WelcomeController::class, 'index'])->name('home');

// Recipes pages
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

// Categories pages
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Search functionality
Route::get('/search', [RecipeController::class, 'search'])->name('recipes.search');

// Home routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public recipe browsing (no auth required)
Route::get('/recipes', function () {
    $recipes = App\Models\Recipe::with('user')->latest()->paginate(12);
    return view('recipes.index', compact('recipes'));
})->name('recipes.index');