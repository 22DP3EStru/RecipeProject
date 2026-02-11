<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeReviewController;
use Illuminate\Support\Facades\Route;

// Public (bez login)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');

// Dashboard (tikai ielogotiem)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('/profile/recipes', [RecipeController::class, 'userRecipes'])->name('profile.recipes');

    // Recipes
    Route::get('/recipes/search', [RecipeController::class, 'search'])->name('recipes.search');
    Route::resource('recipes', RecipeController::class);

    // Favorites
    Route::post('/recipes/{recipe}/favorite', [FavoriteController::class, 'toggle'])->name('recipes.favorite.toggle');
    Route::get('/profile/favorites', [FavoriteController::class, 'index'])->name('profile.favorites');

    // Reviews
    Route::post('/recipes/{recipe}/reviews', [RecipeReviewController::class, 'store'])->name('recipes.reviews.store');
    Route::delete('/recipes/{recipe}/reviews', [RecipeReviewController::class, 'destroy'])->name('recipes.reviews.destroy');

    // Admin
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/recipes', [AdminController::class, 'recipes'])->name('recipes');

        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.destroy');
        Route::patch('/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('users.toggle-admin');

        Route::delete('/recipes/{recipe}', [AdminController::class, 'deleteRecipe'])->name('recipes.destroy');
    });

});

require __DIR__ . '/auth.php';
