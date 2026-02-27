<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except([
            'index',
            'show',
            'search',
        ]);
    }

    public function index(Request $request)
    {
        $query = Recipe::with('user')
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ingredients', 'like', "%{$search}%"); // legacy field
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
        $recipe->load([
            'user',
            'reviews.user',
            'ingredientsItems',
        ]);

        $relatedRecipes = Recipe::with('user')
            ->where('category', $recipe->category)
            ->where('id', '!=', $recipe->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        $myReview = null;
        if (Auth::check()) {
            $myReview = $recipe->reviews->firstWhere('user_id', Auth::id());
        }

        return view('recipes.show', compact('recipe', 'relatedRecipes', 'myReview'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    /**
     * ✅ No ingredient_*[] masīviem:
     *  - izveido recipe_ingredients ierakstus
     *  - uzģenerē legacy text lauku recipes.ingredients (meklēšanai + backward-compat)
     */
    private function syncIngredientsFromArrays(Recipe $recipe, Request $request): void
    {
        $names = $request->input('ingredient_name', []);
        $qtys  = $request->input('ingredient_qty', []);
        $units = $request->input('ingredient_unit', []);

        // Notīra vecos
        $recipe->ingredientsItems()->delete();

        $legacyLines = [];

        $count = max(count($names), count($qtys), count($units));
        for ($i = 0; $i < $count; $i++) {
            $name = trim((string)($names[$i] ?? ''));
            $qtyRaw = $qtys[$i] ?? null;
            $unit = trim((string)($units[$i] ?? ''));

            if ($name === '') {
                continue; // tukša rinda -> ignorē
            }

            // quantity var būt null (piem. "pēc garšas")
            $quantity = null;
            if ($qtyRaw !== null && $qtyRaw !== '') {
                // normalizē komatu uz punktu
                $qtyNorm = str_replace(',', '.', (string)$qtyRaw);
                if (is_numeric($qtyNorm)) {
                    $quantity = (float)$qtyNorm;
                }
            }

            $recipe->ingredientsItems()->create([
                'name' => $name,
                'quantity' => $quantity,
                'unit' => $unit !== '' ? $unit : null,
            ]);

            // Legacy string: "200 g Milti" / "Milti"
            if ($quantity !== null && $unit !== '') {
                $legacyLines[] = rtrim(rtrim((string)$quantity, '0'), '.') . ' ' . $unit . ' ' . $name;
            } elseif ($quantity !== null) {
                $legacyLines[] = rtrim(rtrim((string)$quantity, '0'), '.') . ' ' . $name;
            } else {
                $legacyLines[] = $name . ($unit !== '' ? ' (' . $unit . ')' : '');
            }
        }

        // uzliek recipes.ingredients tekstu, lai search un vecie skati turpina strādāt
        $recipe->ingredients = implode("\n", $legacyLines);
        $recipe->save();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer|min:0',
            'cook_time' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:1',
            'difficulty' => 'nullable|string|max:50',
            'category' => 'nullable|string|max:100',

            // ✅ NEW: ingredients arrays
            'ingredient_name' => 'required|array|min:1',
            'ingredient_name.*' => 'nullable|string|max:255',
            'ingredient_qty' => 'nullable|array',
            'ingredient_qty.*' => 'nullable',
            'ingredient_unit' => 'nullable|array',
            'ingredient_unit.*' => 'nullable|string|max:30',

            // ✅ MEDIA
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'image_url' => 'nullable|url|max:2048',
            'video' => 'nullable|file|mimetypes:video/mp4,video/webm,video/quicktime|max:51200',
            'video_url' => 'nullable|url|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        // Media
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('recipes/images', 'public');
            $validated['image_url'] = null;
        } elseif ($request->filled('image_url')) {
            $validated['image_url'] = $request->input('image_url');
            $validated['image_path'] = null;
        }

        if ($request->hasFile('video')) {
            $validated['video_path'] = $request->file('video')->store('recipes/videos', 'public');
            $validated['video_url'] = null;
        } elseif ($request->filled('video_url')) {
            $validated['video_url'] = $request->input('video_url');
        }

        // Legacy field placeholder (tiks aizpildīts syncIngredientsFromArrays)
        $validated['ingredients'] = '';

        try {
            $recipe = Recipe::create($validated);

            // ✅ saglabā ingredientus tabulā + uzģenerē legacy string
            $this->syncIngredientsFromArrays($recipe, $request);

            return redirect()->route('recipes.show', $recipe)->with('success', 'Recepte publicēta.');
        } catch (\Exception $e) {
            Log::error('Recipe store error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->withInput()->with('error', 'Kļūda saglabājot recepti. Skatiet storage/logs/laravel.log');
        }
    }

    public function edit(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        $recipe->load('ingredientsItems');

        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer|min:0',
            'cook_time' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:1',
            'difficulty' => 'required|string|in:Viegla,Vidēja,Grūta',
            'category' => 'required|string',

            // ✅ NEW: ingredients arrays
            'ingredient_name' => 'required|array|min:1',
            'ingredient_name.*' => 'nullable|string|max:255',
            'ingredient_qty' => 'nullable|array',
            'ingredient_qty.*' => 'nullable|numeric|min:0',
            'ingredient_unit' => 'nullable|array',
            'ingredient_unit.*' => 'nullable|string|max:30',

            // ✅ MEDIA
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'image_url' => 'nullable|url|max:2048',
            'video' => 'nullable|file|mimetypes:video/mp4,video/webm,video/quicktime|max:51200',
            'video_url' => 'nullable|url|max:2048',
        ]);

        // IMAGE update
        if ($request->hasFile('image')) {
            if ($recipe->image_path) Storage::disk('public')->delete($recipe->image_path);
            $validated['image_path'] = $request->file('image')->store('recipes/images', 'public');
            $validated['image_url'] = null;
        } elseif ($request->filled('image_url')) {
            if ($recipe->image_path) Storage::disk('public')->delete($recipe->image_path);
            $validated['image_path'] = null;
            $validated['image_url'] = $request->input('image_url');
        }

        // VIDEO update
        if ($request->hasFile('video')) {
            if ($recipe->video_path) Storage::disk('public')->delete($recipe->video_path);
            $validated['video_path'] = $request->file('video')->store('recipes/videos', 'public');
            $validated['video_url'] = null;
        } elseif ($request->filled('video_url')) {
            $validated['video_url'] = $request->input('video_url');
        }

        // Legacy field placeholder (tiks aizpildīts syncIngredientsFromArrays)
        $validated['ingredients'] = $recipe->ingredients ?? '';

        $recipe->update($validated);

        // ✅ ingredientu tabula + legacy string
        $this->syncIngredientsFromArrays($recipe, $request);

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recepte veiksmīgi atjaunināta!');
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        if ($recipe->image_path) Storage::disk('public')->delete($recipe->image_path);
        if ($recipe->video_path) Storage::disk('public')->delete($recipe->video_path);

        $recipe->ingredientsItems()->delete();
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