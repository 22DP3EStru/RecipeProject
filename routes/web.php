<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Include home routes (public pages)
require __DIR__.'/home.php';

// Dashboard and profile routes (authenticated users)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Profile pages
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/favorites', [App\Http\Controllers\ProfileController::class, 'favorites'])->name('profile.favorites');
    Route::get('/profile/recipes', [App\Http\Controllers\ProfileController::class, 'recipes'])->name('profile.recipes');
});

// Authentication routes
require __DIR__.'/auth.php';

// Protected routes for authenticated users
Route::middleware(['auth'])->group(function () {
    // Recipe management (create, edit, update, delete)
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
    
    // Comments and ratings
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
    
    // Favorites
    Route::post('/favorites/{recipe}', [App\Http\Controllers\FavoriteController::class, 'toggle'])->name('favorites.toggle');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/user/{user}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::delete('/recipe/{recipe}', [AdminController::class, 'deleteRecipe'])->name('admin.deleteRecipe');
});
