<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

// Public routes
Route::get('/', [RecipeController::class, 'home'])->name('home');
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipe/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('/categories', [RecipeController::class, 'categories'])->name('recipes.categories');
Route::get('/', [HomeController::class, 'index'])->name('home');

// Favorites for authenticated users
Route::middleware('auth')->group(function () {
    Route::post('/recipe/{recipe}/favorite', [RecipeController::class, 'toggleFavorite'])->name('recipes.favorite');
    Route::get('/favorites', [RecipeController::class, 'userFavorites'])->name('recipes.favorites');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/recipes', [AdminController::class, 'recipes'])->name('recipes');
    Route::get('/recipes/create', [AdminController::class, 'createRecipe'])->name('recipes.create');
    Route::post('/recipes', [AdminController::class, 'storeRecipe'])->name('recipes.store');
    
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
});

// Redirect /dashboard and /home to profile page
Route::redirect('/dashboard', '/dashboard');
Route::redirect('/home', '/profile');
Route::redirect('/register-success', '/profile'); // Optional: if you want a custom register success route

// Auth routes (register, login, etc.)
require __DIR__.'/auth.php';
// Recipes
Route::resource('recipes', RecipeController::class);

// Users (tikai delete darbībai)
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
