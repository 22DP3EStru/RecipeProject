<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Recipe::with('user');
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('ingredients', 'like', "%{$search}%");
            });
        }
        
        // Category filter
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        // Difficulty filter
        if ($request->has('difficulty') && $request->difficulty) {
            $query->where('difficulty', $request->difficulty);
        }
        
        $recipes = $query->latest()->paginate(12);
        
        // Get unique categories for filter dropdown
        $categories = Recipe::distinct()->pluck('category')->filter()->sort();
        
        return view('recipes.index', compact('recipes', 'categories'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'category' => 'required|string|max:100',
            'prep_time' => 'nullable|integer|min:1',
            'cook_time' => 'nullable|integer|min:1',
            'servings' => 'nullable|integer|min:1',
            'difficulty' => 'required|in:Easy,Medium,Hard',
        ]);

        Recipe::create([
            'title' => $request->title,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'category' => $request->category,
            'prep_time' => $request->prep_time,
            'cook_time' => $request->cook_time,
            'servings' => $request->servings,
            'difficulty' => $request->difficulty,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Recepte pievienota!');
    }

    public function show(Recipe $recipe) {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        // Check if user owns the recipe
        if ($recipe->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Jūs varat rediģēt tikai savas receptes.');
        }

        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        // Check if user owns the recipe
        if ($recipe->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Jūs varat rediģēt tikai savas receptes.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'category' => 'required|string|max:100',
            'prep_time' => 'nullable|integer|min:1',
            'cook_time' => 'nullable|integer|min:1',
            'servings' => 'nullable|integer|min:1',
            'difficulty' => 'required|in:Easy,Medium,Hard',
        ]);

        $recipe->update([
            'title' => $request->title,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'category' => $request->category,
            'prep_time' => $request->prep_time,
            'cook_time' => $request->cook_time,
            'servings' => $request->servings,
            'difficulty' => $request->difficulty,
        ]);

        return redirect()->route('dashboard')->with('success', 'Recepte atjaunināta!');
    }

    public function destroy(Recipe $recipe)
    {
        // Check if user owns the recipe or is admin
        if ($recipe->user_id !== Auth::id() && !Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Jūs varat dzēst tikai savas receptes.');
        }

        $recipe->delete();

        return redirect()->route('dashboard')->with('success', 'Recepte izdzēsta!');
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }
}
