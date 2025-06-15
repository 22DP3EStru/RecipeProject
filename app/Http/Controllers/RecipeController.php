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
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('ingredients', 'like', '%' . $request->search . '%');
            });
        }

        // Category filter
        if ($request->category) {
            $query->where('category', $request->category);
        }

        // Difficulty filter
        if ($request->difficulty) {
            $query->where('difficulty', $request->difficulty);
        }

        $recipes = $query->latest()->paginate(12);
        
        // Get all categories for the filter dropdown
        $categories = Recipe::distinct()->pluck('category')->filter()->sort()->values();

        return view('recipes.index', compact('recipes', 'categories'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'category' => 'required|string',
            'difficulty' => 'required|string|in:Easy,Medium,Hard',
            'servings' => 'nullable|integer|min:1',
            'prep_time' => 'nullable|integer|min:1',
            'cook_time' => 'nullable|integer|min:1',
        ]);

        $validated['user_id'] = Auth::id();

        Recipe::create($validated);

        return redirect()->route('recipes.index')->with('success', 'Recepte pievienota!');
    }

    public function show(Recipe $recipe) {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        // Check if user owns this recipe
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        // Check if user owns this recipe
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'category' => 'required|string',
            'difficulty' => 'required|string|in:Easy,Medium,Hard',
            'servings' => 'nullable|integer|min:1',
            'prep_time' => 'nullable|integer|min:1',
            'cook_time' => 'nullable|integer|min:1',
        ]);

        $recipe->update($validated);

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recepte atjaunināta!');
    }

    public function destroy(Recipe $recipe)
    {
        // Check if user owns this recipe
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        $recipe->delete();

        return redirect()->route('profile.recipes')->with('success', 'Recepte izdzēsta!');
    }
}
