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

    public function downloadPdf(Recipe $recipe)
    {
        $recipe->loadMissing(['user', 'ingredientsItems']);

        $filename = Str::slug($recipe->title ?? 'recepte') . '-' . $recipe->id . '.pdf';

        $pdf = Pdf::loadView('recipes.pdf', [
            'recipe' => $recipe,
        ])->setPaper('a4');

        return $pdf->download($filename);
    }

    public function printView(Recipe $recipe)
    {
        $recipe->loadMissing(['user', 'ingredientsItems']);

        return view('recipes.print', compact('recipe'));
    }

    private function validationRules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'instructions' => 'required|string|min:10',
            'prep_time' => 'nullable|integer|min:0',
            'cook_time' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:1',
            'difficulty' => 'required|string|in:Viegla,Vidēja,Grūta',
            'category' => 'required|string|max:100',

            'ingredient_name' => 'required|array|min:1',
            'ingredient_name.*' => 'required|string|max:255',

            'ingredient_qty' => 'nullable|array',
            'ingredient_qty.*' => 'nullable|numeric|min:0',

            'ingredient_unit' => 'nullable|array',
            'ingredient_unit.*' => 'nullable|string|max:30',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
            'video' => 'nullable|file|mimetypes:video/mp4,video/webm,video/quicktime|max:51200',
        ];
    }

    private function validationMessages(): array
    {
        return [
            'title.required' => 'Lūdzu, ievadiet receptes nosaukumu.',
            'description.required' => 'Lūdzu, ievadiet receptes aprakstu.',
            'instructions.required' => 'Lūdzu, ievadiet gatavošanas instrukcijas.',
            'ingredient_name.required' => 'Pievienojiet vismaz vienu sastāvdaļu.',
        ];
    }

    public function index(Request $request)
    {
        $search = trim((string) $request->input('search', ''));
        $category = trim((string) $request->input('category', ''));
        $difficulty = trim((string) $request->input('difficulty', ''));

        $query = Recipe::with('user')
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('ingredients', 'like', "%{$search}%");
            });
        }

        if ($category !== '') {
            $query->where('category', $category);
        }

        if ($difficulty !== '') {
            $query->where('difficulty', $difficulty);
        }

        $recipes = $query->latest()->paginate(12)->withQueryString();

        $categories = Recipe::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('recipes.index', compact(
            'recipes',
            'categories',
            'search',
            'category',
            'difficulty'
        ));
    }

    public function userRecipes()
    {
        $recipes = Recipe::with('user')
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(12);

        return view('profile.recipes', compact('recipes'));
    }

    public function show(Recipe $recipe)
    {
        $sessionKey = 'recipe_viewed_' . $recipe->id;

        if (!session()->has($sessionKey)) {
            $recipe->increment('views');
            session()->put($sessionKey, true);
        }

        $recipe->load([
            'user',
            'reviews.user',
            'ingredientsItems',
        ]);

        $comments = $recipe->comments()
            ->with(['user', 'replies.user'])
            ->paginate(8)
            ->withQueryString();

        $relatedRecipes = Recipe::with('user')
            ->where('id', '!=', $recipe->id)
            ->when($recipe->category, function ($query) use ($recipe) {
                $query->where('category', $recipe->category);
            })
            ->inRandomOrder()
            ->take(4)
            ->get();

        $myReview = null;
        if (Auth::check()) {
            $myReview = $recipe->reviews()->where('user_id', Auth::id())->first();
        }

        return view('recipes.show', compact(
            'recipe',
            'relatedRecipes',
            'myReview',
            'comments'
        ));
    }

    public function create()
    {
        return view('recipes.create');
    }

    private function syncIngredientsFromArrays(Recipe $recipe, Request $request): void
    {
        $names = $request->input('ingredient_name', []);
        $qtys = $request->input('ingredient_qty', []);
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
                $legacyLines[] = $quantity . ' ' . $unit . ' ' . $name;
            } elseif ($quantity !== null) {
                $legacyLines[] = $quantity . ' ' . $name;
            } else {
                $legacyLines[] = $name;
            }
        }

        $recipe->ingredients = implode("\n", $legacyLines);
        $recipe->save();
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->validationRules(),
            $this->validationMessages()
        );

        $validated['user_id'] = Auth::id();
        $validated['views'] = 0;
        $validated['ingredients'] = '';

        unset(
            $validated['ingredient_name'],
            $validated['ingredient_qty'],
            $validated['ingredient_unit'],
            $validated['image'],
            $validated['video']
        );

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('recipes/images', 'public');
        }

        if ($request->hasFile('video')) {
            $validated['video_path'] = $request->file('video')->store('recipes/videos', 'public');
        }

        try {
            $recipe = Recipe::create($validated);
            $this->syncIngredientsFromArrays($recipe, $request);

            return redirect()
                ->route('recipes.show', $recipe)
                ->with('success', 'Recepte veiksmīgi publicēta.');
        } catch (\Exception $e) {
            Log::error('Recipe store error', [
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Neizdevās saglabāt recepti.');
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

        $validated = $request->validate(
            $this->validationRules(),
            $this->validationMessages()
        );

        unset(
            $validated['ingredient_name'],
            $validated['ingredient_qty'],
            $validated['ingredient_unit'],
            $validated['image'],
            $validated['video']
        );

        try {
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

            $recipe->update($validated);

            $this->syncIngredientsFromArrays($recipe, $request);

            return redirect()
                ->route('recipes.show', $recipe)
                ->with('success', 'Recepte veiksmīgi atjaunināta.');
        } catch (\Exception $e) {
            Log::error('Recipe update error', [
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Neizdevās atjaunināt recepti.');
        }
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
}