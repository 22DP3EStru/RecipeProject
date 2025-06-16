<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Home route that redirects to dashboard
Route::get('/home', function () {
    return redirect('/dashboard');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Categories routes
Route::get('/categories', [CategoriesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('categories.index');

// Categories show route
Route::get('/categories/{category}', [CategoriesController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('categories.show');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    Route::get('/profile/favorites', [ProfileController::class, 'favorites'])->name('profile.favorites');
    
    // Recipe routes
    Route::resource('recipes', RecipeController::class);
    Route::get('/profile/recipes', [RecipeController::class, 'userRecipes'])->name('profile.recipes');
    Route::get('/recipes/search', [RecipeController::class, 'search'])->name('recipes.search');
    
    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/recipes', [AdminController::class, 'recipes'])->name('admin.recipes');
        Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.destroy');
        Route::delete('/admin/recipes/{recipe}', [AdminController::class, 'deleteRecipe'])->name('admin.recipes.destroy');
        Route::patch('/admin/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('admin.users.toggle-admin');
    });
});

require __DIR__.'/auth.php';
