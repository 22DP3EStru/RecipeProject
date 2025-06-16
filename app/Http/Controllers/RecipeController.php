<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $categories = Recipe::distinct('category')->pluck('category')->filter();
        
        return view('recipes.index', compact('recipes', 'categories'));
    }

    public function show(Recipe $recipe)
    {
        $relatedRecipes = Recipe::with('user')
            ->where('category', $recipe->category)
            ->where('id', '!=', $recipe->id)
            ->inRandomOrder()
            ->take(4)
            ->get();
        
        return view('recipes.show', compact('recipe', 'relatedRecipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
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

            $validated['user_id'] = Auth::id();

            $recipe = Recipe::create($validated);

            Log::info('Recipe saved successfully', [
                'recipe_id' => $recipe->id,
                'user_id' => Auth::id(),
                'title' => $recipe->title
            ]);

            return redirect()->route('profile.recipes')->with('success', 'Recepte veiksmīgi izveidota!');

        } catch (\Exception $e) {
            Log::error('Failed to save recipe', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'request_data' => $request->all()
            ]);

            return back()->withInput()->with('error', 'Kļūda saglabājot recepti. Lūdzu mēģiniet vēlreiz.');
        }
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
