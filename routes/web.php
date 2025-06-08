<?php
use App\Http\Controllers\{RecipeController, ProfileController, AdminController};
use Illuminate\Support\Facades\Route;

Route::get('/', [RecipeController::class,'index'])->name('home');

// publiskās
Route::get('/recipes',        [RecipeController::class,'index'])->name('recipes.index');
Route::get('/recipes/{slug}', [RecipeController::class,'show'])->name('recipes.show');
Route::get('/categories',     [RecipeController::class,'categories'])->name('categories.index');

// autentificētie
Route::middleware('auth')->group(function () {
    Route::post('/recipes/{recipe}/favorite', [RecipeController::class,'toggleFavorite'])->name('recipes.favorite');
    Route::get('/favorites',                  [RecipeController::class,'userFavorites'])->name('favorites');
    Route::resource('profile', ProfileController::class)->only(['edit','update','destroy']);
});

// admin
Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',            [AdminController::class,'dashboard'])->name('dashboard');
    Route::resource('recipes', AdminController::class)->except('show');
    Route::post('categories',  [AdminController::class,'storeCategory'])->name('categories.store');
});

require __DIR__.'/auth.php';
