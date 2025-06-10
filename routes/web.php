<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RecipeController::class, 'index'])->name('home'); 

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {
    Route::resource('recipes', RecipeController::class)->except(['index', 'show']);
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
});

Route::resource('recipes', RecipeController::class)->only(['index', 'show']);
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

require __DIR__.'/auth.php';



Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/user/{user}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::delete('/recipe/{recipe}', [AdminController::class, 'deleteRecipe'])->name('admin.deleteRecipe');
});
