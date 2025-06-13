<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Include home routes (public pages)
require __DIR__.'/home.php';

// Dashboard and profile routes (authenticated users)
Route::get('dashboard', function () {
        // Remove 'category' from the with() method since it's not a relationship
        $featuredRecipes = \App\Models\Recipe::with(['user'])
            ->latest()
            ->limit(6)
            ->get();
        
        return view('dashboard', compact('featuredRecipes'));
    })
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
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('\admin');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/recipes', [AdminController::class, 'recipes'])->name('admin.recipes');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
    Route::delete('/admin/recipes/{recipe}', [AdminController::class, 'deleteRecipe'])->name('admin.delete-recipe');
    Route::patch('/admin/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('admin.toggle-admin');
});

// Simple admin route - add at the end of web.php
Route::get('/admin', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    if (!Auth::user()->is_admin) {
        return redirect('/dashboard')->with('error', 'Access denied - not admin');
    }
    return view('admin.index'); // This should work now
});

// Additional admin routes
Route::get('/admin/delete-user/{id}', function ($id) {
    if (!Auth::check() || !Auth::user()->is_admin) {
        return redirect('/dashboard');
    }
    $user = App\Models\User::find($id);
    if ($user && $user->id !== Auth::id()) {
        $user->delete();
        return redirect('/admin')->with('success', 'User deleted successfully');
    }
    return redirect('/admin')->with('error', 'Cannot delete user');
});

Route::get('/admin/delete-recipe/{id}', function ($id) {
    if (!Auth::check() || !Auth::user()->is_admin) {
        return redirect('/dashboard');
    }
    $recipe = App\Models\Recipe::find($id);
    if ($recipe) {
        $recipe->delete();
        return redirect('/admin')->with('success', 'Recipe deleted successfully');
    }
    return redirect('/admin')->with('error', 'Recipe not found');
});
