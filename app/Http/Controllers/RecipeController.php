<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Recipe::with(['category', 'user']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Difficulty filter
        if ($request->has('difficulty') && $request->difficulty) {
            $query->where('difficulty', $request->difficulty);
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        
        $recipes = $query->orderBy($sortBy, $sortOrder)->paginate(12);

        return response()->json([
            'recipes' => $recipes->items(),
            'pagination' => [
                'current_page' => $recipes->currentPage(),
                'last_page' => $recipes->lastPage(),
                'total' => $recipes->total(),
                'per_page' => $recipes->perPage(),
            ]
        ]);
    }

    public function show(Recipe $recipe): JsonResponse
    {
        $recipe->load(['category', 'ingredients', 'instructions', 'user']);
        
        // Get related recipes
        $relatedRecipes = Recipe::where('category_id', $recipe->category_id)
                               ->where('id', '!=', $recipe->id)
                               ->with(['category', 'user'])
                               ->limit(4)
                               ->get();

        // Check if current user has favorited this recipe
        $isFavorited = false;
        if (Auth::check()) {
            $user = Auth::user();
            if ($user instanceof User) {
                $isFavorited = $user->hasFavorited($recipe->id);
            }
        }

        return response()->json([
            'recipe' => $recipe,
            'related_recipes' => $relatedRecipes,
            'is_favorited' => $isFavorited
        ]);
    }

    public function categories(): JsonResponse
    {
        $categories = Category::withCount('recipes')->get();
        
        return response()->json([
            'categories' => $categories
        ]);
    }

    public function featured(): JsonResponse
    {
        $featuredRecipes = Recipe::where('is_featured', true)
                                ->with(['category', 'user'])
                                ->limit(6)
                                ->get();

        return response()->json([
            'featured_recipes' => $featuredRecipes
        ]);
    }

    public function toggleFavorite(Recipe $recipe): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Authentication required'], 401);
        }

        $user = Auth::user();
        if (!($user instanceof User)) {
            return response()->json(['error' => 'User model not found'], 500);
        }
        
        // Check if already favorited using the pivot table
        $existingFavorite = $user->favorites()->where('recipe_id', $recipe->id)->first();
        
        if ($existingFavorite) {
            // Remove from favorites
            $user->favorites()->detach($recipe->id);
            $favorited = false;
            $message = 'Recipe removed from favorites';
        } else {
            // Add to favorites
            $user->favorites()->attach($recipe->id);
            $favorited = true;
            $message = 'Recipe added to favorites';
        }

        return response()->json([
            'favorited' => $favorited,
            'message' => $message
        ]);
    }

    public function userFavorites(): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Authentication required'], 401);
        }

        $user = Auth::user();
        if (!($user instanceof User)) {
            return response()->json(['error' => 'User model not found'], 500);
        }

        $favorites = $user->favorites()
                          ->with(['category', 'user'])
                          ->paginate(12);

        return response()->json([
            'favorites' => $favorites->items(),
            'pagination' => [
                'current_page' => $favorites->currentPage(),
                'last_page' => $favorites->lastPage(),
                'total' => $favorites->total(),
                'per_page' => $favorites->perPage(),
            ]
        ]);
    }
        public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Recipe deleted successfully.');
    }


    public function home()
    {
        return view('welcome');
    }
}
