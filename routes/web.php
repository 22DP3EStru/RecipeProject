<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Test route
Route::get('/test', function () {
    return 'TEST ROUTE WORKS!';
});

// Home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/favorites', [App\Http\Controllers\ProfileController::class, 'favorites'])->name('profile.favorites');
    Route::get('/profile/recipes', [App\Http\Controllers\ProfileController::class, 'recipes'])->name('profile.recipes');
});

// Recipe routes
Route::middleware(['auth'])->group(function () {
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
});

// Public recipe routes (no auth required)
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/search', [RecipeController::class, 'search'])->name('recipes.search');

// Categories routes
Route::get('/categories', function () {
    $categories = App\Models\Recipe::select('category')
        ->whereNotNull('category')
        ->groupBy('category')
        ->withCount('recipes')
        ->get()
        ->map(function ($item) {
            return [
                'name' => $item->category,
                'count' => App\Models\Recipe::where('category', $item->category)->count()
            ];
        });
    
    return view('categories.index', compact('categories'));
})->name('categories.index');

Route::get('/categories/{category}', function ($category) {
    $recipes = App\Models\Recipe::with('user')
        ->where('category', $category)
        ->latest()
        ->paginate(12);
    
    return view('categories.show', compact('recipes', 'category'));
})->name('categories.show');

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        if (!Auth::user()->is_admin) {
            return redirect('/dashboard')->with('error', 'Access denied');
        }
        return view('admin.index');
    })->name('admin.index');

    Route::get('/admin/users', function () {
        if (!Auth::user()->is_admin) {
            return redirect('/dashboard');
        }
        $users = App\Models\User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    })->name('admin.users');

    Route::get('/admin/recipes', function () {
        if (!Auth::user()->is_admin) {
            return redirect('/dashboard');
        }
        $recipes = App\Models\Recipe::with('user')->latest()->paginate(15);
        return view('admin.recipes', compact('recipes'));
    })->name('admin.recipes');

    Route::get('/admin/delete-user/{id}', function ($id) {
        if (!Auth::user()->is_admin) {
            return redirect('/dashboard');
        }
        $user = App\Models\User::find($id);
        if ($user && $user->id !== Auth::id()) {
            $user->delete();
            return redirect()->route('admin.index')->with('success', 'User deleted successfully');
        }
        return redirect()->route('admin.index')->with('error', 'Cannot delete user');
    })->name('admin.delete-user');

    Route::get('/admin/delete-recipe/{id}', function ($id) {
        if (!Auth::user()->is_admin) {
            return redirect('/dashboard');
        }
        $recipe = App\Models\Recipe::find($id);
        if ($recipe) {
            $recipe->delete();
            return redirect()->route('admin.index')->with('success', 'Recipe deleted successfully');
        }
        return redirect()->route('admin.index')->with('error', 'Recipe not found');
    })->name('admin.delete-recipe');
});

// Authentication routes
require __DIR__.'/auth.php';
