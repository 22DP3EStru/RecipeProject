<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index() {
        return view('recipes.index', ['recipes' => Recipe::with('user', 'category')->latest()->get()]);
    }

    public function create() {
        return view('recipes.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('recipes', 'public');
        }
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Lūdzu, piesakieties, lai pievienotu recepti.');
        }
        $data['user_id'] = $user->id;
        Recipe::create($data);

        return redirect()->route('recipes.index')->with('success', 'Recepte pievienota!');
    }

    public function show(Recipe $recipe) {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe) {
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('recipes', 'public');
        }

        $recipe->update($data);

        return redirect()->route('recipes.index')->with('success', 'Recepte atjaunināta!');
    }

    public function destroy(Recipe $recipe) {
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recepte izdzēsta!');
    }
}
