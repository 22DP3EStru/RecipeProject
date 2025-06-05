<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RecipeController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $recipes = Recipe::with('ratings')->latest()->paginate(12);
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'prep_time' => 'nullable|integer|min:0',
            'cook_time' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:1',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('recipe_images', 'public');
        }


        /** @var \App\Models\User $user */
        $recipe = $user->recipes()->create($data);


        return redirect()
            ->route('recipes.show', $recipe)
            ->with('success', 'Recipe created successfully!');
    }

    public function show(Recipe $recipe)
    {
        $recipe->load(['ingredients', 'steps', 'ratings.user']);
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        $this->authorize('update', $recipe);
        $recipe->load(['ingredients', 'steps']);
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $this->authorize('update', $recipe);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'prep_time' => 'nullable|integer|min:0',
            'cook_time' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:1',
        ]);

        if ($request->hasFile('image')) {
            if ($recipe->image_path) {
                Storage::disk('public')->delete($recipe->image_path);
            }
            $data['image_path'] = $request->file('image')->store('recipe_images', 'public');
        }

        $recipe->update($data);

        return redirect()
            ->route('recipes.show', $recipe)
            ->with('success', 'Recipe updated successfully!');
    }

    public function destroy(Recipe $recipe)
    {
        $this->authorize('delete', $recipe);

        if ($recipe->image_path) {
            Storage::disk('public')->delete($recipe->image_path);
        }

        $recipe->delete();

        return redirect()
            ->route('recipes.index')
            ->with('success', 'Recipe deleted!');
    }
}
