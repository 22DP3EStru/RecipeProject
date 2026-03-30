<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PdfController;
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

// PDF / Print - tikai ielogotiem, bet ne obligāti verificētiem
Route::get('/recipes/{recipe}/pdf', [RecipeController::class, 'downloadPdf'])
    ->middleware(['auth'])
    ->name('recipes.pdf');

Route::get('/recipes/{recipe}/pdf/image', [RecipeController::class, 'downloadImagePdf'])
    ->middleware(['auth'])
    ->name('recipes.pdf.image');

Route::get('/recipes/{recipe}/print', [RecipeController::class, 'printView'])
    ->middleware(['auth'])
    ->name('recipes.print');

// Dashboard (tikai ielogotiem)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('/profile/recipes', [RecipeController::class, 'userRecipes'])->name('profile.recipes');

    // Recipes - skatīties var ielogots lietotājs, bet veidot/labot/dzēst tikai verificēts
    Route::get('/recipes/search', [RecipeController::class, 'search'])->name('recipes.search');
    Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
    Route::get('/recipes/create', [RecipeController::class, 'create'])->middleware('verified')->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->middleware('verified')->name('recipes.store');
    Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->middleware('verified')->name('recipes.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->middleware('verified')->name('recipes.update');
    Route::patch('/recipes/{recipe}', [RecipeController::class, 'update'])->middleware('verified')->name('recipes.patch');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->middleware('verified')->name('recipes.destroy');

    // Favorites - tikai verificētiem
    Route::post('/recipes/{recipe}/favorite', [FavoriteController::class, 'toggle'])
        ->middleware('verified')
        ->name('recipes.favorite.toggle');

    Route::get('/profile/favorites', [FavoriteController::class, 'index'])
        ->middleware('verified')
        ->name('profile.favorites');

    // Reviews - tikai verificētiem
    Route::post('/recipes/{recipe}/reviews', [RecipeReviewController::class, 'store'])
        ->middleware('verified')
        ->name('recipes.reviews.store');

    Route::delete('/recipes/{recipe}/reviews', [RecipeReviewController::class, 'destroy'])
        ->middleware('verified')
        ->name('recipes.reviews.destroy');

    // Admin - tikai adminiem; ieteicams esošajiem admin DB ielikt email_verified_at
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/recipes', [AdminController::class, 'recipes'])->name('recipes');

        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.destroy');
        Route::patch('/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('users.toggle-admin');

        Route::delete('/recipes/{recipe}', [AdminController::class, 'deleteRecipe'])->name('recipes.destroy');
    });
});

// PDF sekcija - publiska, jo te iepriekš middleware nebija
Route::prefix('pdf')->name('pdf.')->group(function () {
    Route::get('/recipe/{recipe}/full', [PdfController::class, 'recipeFull'])->name('recipe.full');
    Route::get('/recipe/{recipe}/ingredients', [PdfController::class, 'recipeIngredients'])->name('recipe.ingredients');
    Route::get('/recipe/{recipe}/steps', [PdfController::class, 'recipeSteps'])->name('recipe.steps');

    Route::get('/category-name/{categoryName}/recipes', [PdfController::class, 'categoryRecipesByName'])
        ->name('category.recipes.byname');

    Route::get('/user/{user}/profile', [PdfController::class, 'userProfile'])->name('user.profile');

    Route::get('/popular-recipes', [PdfController::class, 'popularRecipes'])->name('popular.recipes');
    Route::get('/admin-statistics', [PdfController::class, 'adminStatistics'])->name('admin.statistics');
    Route::get('/filtered-recipes', [PdfController::class, 'filteredRecipes'])->name('filtered.recipes');
});

require __DIR__ . '/auth.php';