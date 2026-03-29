<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

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

    /**
     * PDF (A4) – recepte + bilde
     * View: resources/views/recipes/pdf.blade.php
     */
    public function downloadPdf(Recipe $recipe)
    {
        $this->ensurePdfWritableDirs();
        $recipe->loadMissing(['user', 'ingredientsItems']);

        $filename = Str::slug($recipe->title ?? 'recepte') . '-' . $recipe->id . '.pdf';

        $pdf = Pdf::loadView('recipes.pdf', [
            'recipe' => $recipe,
        ])->setPaper('a4');

        return $pdf->download($filename);
    }

    /**
     * PDF (A4) – tikai recepšu bilde (1 lapa)
     * View: resources/views/recipes/pdf_image.blade.php
     */
    public function downloadImagePdf(Recipe $recipe)
    {
        $this->ensurePdfWritableDirs();

        $filename = Str::slug($recipe->title ?? 'recepte') . '-' . $recipe->id . '-bilde.pdf';

        $pdf = Pdf::loadView('recipes.pdf_image', [
            'recipe' => $recipe,
        ])->setPaper('a4');

        return $pdf->download($filename);
    }

    /**
     * Print view (HTML) – cilvēks atver pārlūkā un spiež Ctrl+P
     * View: resources/views/recipes/print.blade.php
     */
    public function printView(Recipe $recipe)
    {
        $recipe->loadMissing(['user', 'ingredientsItems']);
        return view('recipes.print', compact('recipe'));
    }

    /**
     * Fix permissions edge cases (Docker/FS)
     */
    private function ensurePdfWritableDirs(): void
    {
        $paths = [
            storage_path('framework'),
            storage_path('framework/cache'),
            storage_path('framework/views'),
            storage_path('framework/sessions'),
            storage_path('logs'),
            base_path('bootstrap/cache'),
        ];

        foreach ($paths as $p) {
            if (!is_dir($p)) {
                @mkdir($p, 0775, true);
            }
        }
    }

    public function index(Request $request)
    {
        $query = Recipe::with('user')
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
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

    /**
     * Ja recipe_ingredients.quantity ir NULL, bet name ir "200 g Milti",
     * tad sadala un ieliek quantity/unit/name pareizajās kolonnās.
     */
    private function tryBackfillIngredientQuantity(Recipe $recipe): void
    {
        $items = $recipe->relationLoaded('ingredientsItems')
            ? $recipe->ingredientsItems
            : $recipe->ingredientsItems()->get();

        foreach ($items as $item) {
            if (!is_null($item->quantity)) {
                continue;
            }

            $line = trim((string) $item->name);
            if ($line === '') {
                continue;
            }

            if (preg_match('/^(\d+(?:[.,]\d+)?)\s*([^\d\s]+)?\s+(.+)$/u', $line, $m)) {
                $qty = (float) str_replace(',', '.', $m[1]);
                $unit = isset($m[2]) ? trim($m[2]) : null;
                $name = trim($m[3]);

                $item->quantity = $qty;
                if (empty($item->unit) && !empty($unit)) {
                    $item->unit = $unit;
                }
                $item->name = $name;
                $item->save();
            }
        }
    }

    public function show(Recipe $recipe)
    {
        $recipe->load([
            'user',
            'reviews.user',
            'ingredientsItems',
        ]);

        $this->tryBackfillIngredientQuantity($recipe);
        $recipe->load('ingredientsItems');

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
     * No ingredient_*[] masīviem:
     *  - izveido recipe_ingredients ierakstus
     *  - uzģenerē legacy text lauku recipes.ingredients
     */
    private function syncIngredientsFromArrays(Recipe $recipe, Request $request): void
    {
        $names = $request->input('ingredient_name', []);
        $qtys  = $request->input('ingredient_qty', []);
        $units = $request->input('ingredient_unit', []);

        $recipe->ingredientsItems()->delete();

        $legacyLines = [];

        $count = max(count($names), count($qtys), count($units));
        for ($i = 0; $i < $count; $i++) {
            $name = trim((string) ($names[$i] ?? ''));
            $qtyRaw = $qtys[$i] ?? null;
            $unit = trim((string) ($units[$i] ?? ''));

            if ($name === '') {
                continue;
            }

            $quantity = null;
            if ($qtyRaw !== null && $qtyRaw !== '') {
                $qtyNorm = str_replace(',', '.', (string) $qtyRaw);
                if (is_numeric($qtyNorm)) {
                    $quantity = (float) $qtyNorm;
                }
            }

            $recipe->ingredientsItems()->create([
                'name' => $name,
                'quantity' => $quantity,
                'unit' => $unit !== '' ? $unit : null,
            ]);

            if ($quantity !== null && $unit !== '') {
                $legacyLines[] = rtrim(rtrim((string) $quantity, '0'), '.') . ' ' . $unit . ' ' . $name;
            } elseif ($quantity !== null) {
                $legacyLines[] = rtrim(rtrim((string) $quantity, '0'), '.') . ' ' . $name;
            } else {
                $legacyLines[] = $name . ($unit !== '' ? ' (' . $unit . ')' : '');
            }
        }

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

            'ingredient_name' => 'required|array|min:1',
            'ingredient_name.*' => 'nullable|string|max:255',
            'ingredient_qty' => 'nullable|array',
            'ingredient_qty.*' => 'nullable',
            'ingredient_unit' => 'nullable|array',
            'ingredient_unit.*' => 'nullable|string|max:30',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'video' => 'nullable|file|mimetypes:video/mp4,video/webm,video/quicktime|max:51200',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('recipes/images', 'public');
        }

        if ($request->hasFile('video')) {
            $validated['video_path'] = $request->file('video')->store('recipes/videos', 'public');
        }

        $validated['ingredients'] = '';

        try {
            $recipe = Recipe::create($validated);
            $this->syncIngredientsFromArrays($recipe, $request);

            return redirect()
                ->route('recipes.show', $recipe)
                ->with('success', 'Recepte publicēta.');
        } catch (\Exception $e) {
            Log::error('Recipe store error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Kļūda saglabājot recepti. Skatiet storage/logs/laravel.log');
        }
    }

    public function edit(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        $recipe->load('ingredientsItems');
        $this->tryBackfillIngredientQuantity($recipe);
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

            'ingredient_name' => 'required|array|min:1',
            'ingredient_name.*' => 'nullable|string|max:255',
            'ingredient_qty' => 'nullable|array',
            'ingredient_qty.*' => 'nullable|numeric|min:0',
            'ingredient_unit' => 'nullable|array',
            'ingredient_unit.*' => 'nullable|string|max:30',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'video' => 'nullable|file|mimetypes:video/mp4,video/webm,video/quicktime|max:51200',
        ]);

        if ($request->hasFile('image')) {
            if ($recipe->image_path) {
                Storage::disk('public')->delete($recipe->image_path);
            }

            $validated['image_path'] = $request->file('image')->store('recipes/images', 'public');
        }

        if ($request->hasFile('video')) {
            if ($recipe->video_path) {
                Storage::disk('public')->delete($recipe->video_path);
            }

            $validated['video_path'] = $request->file('video')->store('recipes/videos', 'public');
        }

        $validated['ingredients'] = $recipe->ingredients ?? '';
        $recipe->update($validated);

        $this->syncIngredientsFromArrays($recipe, $request);

        return redirect()
            ->route('recipes.show', $recipe)
            ->with('success', 'Recepte veiksmīgi atjaunināta!');
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        if ($recipe->image_path) {
            Storage::disk('public')->delete($recipe->image_path);
        }

        if ($recipe->video_path) {
            Storage::disk('public')->delete($recipe->video_path);
        }

        $recipe->ingredientsItems()->delete();
        $recipe->delete();

        return redirect()
            ->route('profile.recipes')
            ->with('success', 'Recepte veiksmīgi dzēsta!');
    }

    public function userRecipes()
    {
        $recipes = Recipe::where('user_id', Auth::id())
            ->latest()
            ->paginate(12);

        return view('profile.recipes', compact('recipes'));
    }
}