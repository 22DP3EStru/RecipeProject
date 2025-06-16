<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::with('user');

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ingredients', 'like', "%{$search}%");
            });
        }

        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        if ($request->has('difficulty') && $request->difficulty) {
            $query->where('difficulty', $request->difficulty);
        }

        $recipes = $query->latest()->paginate(12);
        
        // ADD THIS LINE - Get all categories for the filter dropdown
        $categories = Recipe::distinct('category')->pluck('category')->filter();
        
        return view('recipes.index', compact('recipes', 'categories'));
    }

    // Add this search method
    public function search(Request $request)
    {
        // Redirect to the index with search parameters
        return redirect()->route('recipes.index', $request->all());
    }

    public function show(Recipe $recipe)
    {
        // Get related recipes from the same category
        $relatedRecipes = Recipe::with('user')
            ->where('category', $recipe->category)
            ->where('id', '!=', $recipe->id)
            ->inRandomOrder()
            ->take(4)
            ->get();
        
        // If not enough related recipes in same category, get from other categories
        if ($relatedRecipes->count() < 4) {
            $additionalRecipes = Recipe::with('user')
                ->where('id', '!=', $recipe->id)
                ->whereNotIn('id', $relatedRecipes->pluck('id'))
                ->inRandomOrder()
                ->take(4 - $relatedRecipes->count())
                ->get();
            
            $relatedRecipes = $relatedRecipes->merge($additionalRecipes);
        }
        
        return view('recipes.show', compact('recipe', 'relatedRecipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer|min:0',
            'cook_time' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:1',
            'difficulty' => 'required|string|in:Viegla,Vidēja,Grūta',
            'category' => 'required|string',
        ], [
            'title.required' => 'Receptes nosaukums ir obligāts.',
            'description.required' => 'Apraksts ir obligāts.',
            'ingredients.required' => 'Sastāvdaļas ir obligātas.',
            'instructions.required' => 'Instrukcijas ir obligātas.',
            'difficulty.required' => 'Grūtības līmenis ir obligāts.',
            'category.required' => 'Kategorija ir obligāta.',
        ]);

        Recipe::create([
            'title' => $request->title,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'prep_time' => $request->prep_time,
            'cook_time' => $request->cook_time,
            'servings' => $request->servings,
            'difficulty' => $request->difficulty,
            'category' => $request->category,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('profile.recipes')->with('success', 'Recepte veiksmīgi izveidota!');
    }

    public function edit(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer|min:0',
            'cook_time' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:1',
            'difficulty' => 'required|string|in:Viegla,Vidēja,Grūta',
            'category' => 'required|string',
        ], [
            'title.required' => 'Receptes nosaukums ir obligāts.',
            'description.required' => 'Apraksts ir obligāts.',
            'ingredients.required' => 'Sastāvdaļas ir obligātas.',
            'instructions.required' => 'Instrukcijas ir obligātas.',
            'difficulty.required' => 'Grūtības līmenis ir obligāts.',
            'category.required' => 'Kategorija ir obligāta.',
        ]);

        $recipe->update($request->all());

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recepte veiksmīgi atjaunināta!');
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        $recipe->delete();

        return redirect()->route('profile.recipes')->with('success', 'Recepte veiksmīgi dzēsta!');
    }

    public function userRecipes()
    {
        $recipes = Recipe::where('user_id', Auth::id())
                        ->latest()
                        ->paginate(12);

        return view('profile.recipes', compact('recipes'));
    }
}
