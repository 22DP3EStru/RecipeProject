<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\User;
use App\Models\Ingredient;
use App\Models\Instruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $stats = [
            'total_recipes' => Recipe::count(),
            'total_users' => User::count(),
            'total_categories' => Category::count(),
            'total_favorites' => DB::table('favorites')->count(),
        ];

        $recentRecipes = Recipe::with('category')->latest()->limit(5)->get();
        $popularRecipes = Recipe::withCount('favorites')->orderBy('favorites_count', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentRecipes', 'popularRecipes'));
    }

    public function recipes()
    {
        $recipes = Recipe::with(['category', 'user'])->latest()->paginate(10);
        return view('admin.recipes.index', compact('recipes'));
    }

    public function createRecipe()
    {
        $categories = Category::all();
        return view('admin.recipes.create', compact('categories'));
    }

    public function storeRecipe(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'cook_time' => 'required|integer',
            'prep_time' => 'required|integer',
            'servings' => 'required|integer',
            'difficulty' => 'required|in:Easy,Medium,Hard',
            'calories' => 'nullable|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi|max:20480',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.quantity' => 'required|string',
            'ingredients.*.unit' => 'nullable|string',
            'instructions' => 'required|array',
            'instructions.*' => 'required|string',
        ]);

        $imagePath = $request->file('image')->store('recipes', 'public');
        $videoPath = null;
        
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('recipes/videos', 'public');
        }

        $recipe = Recipe::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'cook_time' => $validated['cook_time'],
            'prep_time' => $validated['prep_time'],
            'servings' => $validated['servings'],
            'difficulty' => $validated['difficulty'],
            'calories' => $validated['calories'],
            'image' => $imagePath,
            'user_id' => optional(Auth::user())->id,
        ]);

        // Add ingredients
        foreach ($validated['ingredients'] as $ingredient) {
            Ingredient::create([
                'recipe_id' => $recipe->id,
                'name' => $ingredient['name'],
                'quantity' => $ingredient['quantity'],
                'unit' => $ingredient['unit'] ?? null,
            ]);
        }

        // Add instructions
        foreach ($validated['instructions'] as $index => $instruction) {
            Instruction::create([
                'recipe_id' => $recipe->id,
                'step_number' => $index + 1,
                'description' => $instruction,
            ]);
        }

        return redirect()->route('admin.recipes')->with('success', 'Recipe created successfully!');
    }

    public function categories()
    {
        $categories = Category::withCount('recipes')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully!');
    }

}
