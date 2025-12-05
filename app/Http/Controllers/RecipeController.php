<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
        // Optional temporary debug: uncomment to inspect incoming request
        // dd($request->all());

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer|min:0',
            'cook_time' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:1',
            'difficulty' => 'nullable|string|max:50',
            'category' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('recipes', 'public');
        }

        $validated['user_id'] = Auth::id();

        try {
            $recipe = Recipe::create($validated);
            return redirect()->route('recipes.show', $recipe)->with('success', 'Recepte publicÄ“ta.');
        } catch (\Exception $e) {
            Log::error('Recipe store error', [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);
            return back()->withInput()->with('error', 'KÄ¼Å«da saglabÄjot recepti. Skatiet storage/logs/laravel.log');
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

        // Prevent accidental delete if form mistakenly sends _method=DELETE
        if ($request->has('_method') && strtolower($request->input('_method')) === 'delete') {
            abort(400, 'Invalid request method.');
        }

        // Validate only the fields we expect and use the validated data for update
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer|min:0',
            'cook_time' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:1',
            'difficulty' => 'required|string|in:Viegla,VidÄ“ja,GrÅ«ta',
            'category' => 'required|string',
        ]);

        $recipe->update($validated);

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recepte veiksmÄ«gi atjauninÄta!');
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        $recipe->delete();

        return redirect()->route('profile.recipes')->with('success', 'Recepte veiksmÄ«gi dzÄ“sta!');
    }

    public function userRecipes()
    {
        $recipes = Recipe::where('user_id', Auth::id())
                        ->latest()
                        ->paginate(12);

        return view('profile.recipes', compact('recipes'));
    }
}

