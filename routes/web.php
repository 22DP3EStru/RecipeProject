<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeReviewController;
use App\Http\Controllers\PdfController;
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

Route::get('/recipes/{recipe}/pdf', [RecipeController::class, 'downloadPdf'])
    ->middleware(['auth','verified']) // ja gribi tikai ielogotiem
    ->name('recipes.pdf');

Route::get('/recipes/{recipe}/pdf/image', [RecipeController::class, 'downloadImagePdf'])
    ->middleware(['auth','verified'])
    ->name('recipes.pdf.image');

Route::get('/recipes/{recipe}/print', [RecipeController::class, 'printView'])
    ->middleware(['auth','verified'])
    ->name('recipes.print');
    
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

Route::prefix('pdf')->name('pdf.')->group(function () {
    Route::get('/recipe/{recipe}/full', [PdfController::class, 'recipeFull'])->name('recipe.full');
    Route::get('/recipe/{recipe}/ingredients', [PdfController::class, 'recipeIngredients'])->name('recipe.ingredients');
    Route::get('/recipe/{recipe}/steps', [PdfController::class, 'recipeSteps'])->name('recipe.steps');

    Route::get('/category/{category}/recipes', [PdfController::class, 'categoryRecipes'])->name('category.recipes');
    Route::get('/user/{user}/profile', [PdfController::class, 'userProfile'])->name('user.profile');

    Route::get('/popular-recipes', [PdfController::class, 'popularRecipes'])->name('popular.recipes');
    Route::get('/admin-statistics', [PdfController::class, 'adminStatistics'])->name('admin.statistics');
    Route::get('/filtered-recipes', [PdfController::class, 'filteredRecipes'])->name('filtered.recipes');
});


require __DIR__ . '/auth.php';
