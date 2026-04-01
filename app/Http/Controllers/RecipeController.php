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

    private function validationRules(bool $isUpdate = false): array
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
            'title.max' => 'Receptes nosaukums nedrīkst būt garāks par 255 rakstzīmēm.',

            'description.required' => 'Lūdzu, ievadiet receptes aprakstu.',
            'description.min' => 'Receptes aprakstam jābūt vismaz 10 rakstzīmes garam.',

            'instructions.required' => 'Lūdzu, ievadiet gatavošanas instrukcijas.',
            'instructions.min' => 'Gatavošanas instrukcijām jābūt vismaz 10 rakstzīmes garām.',

            'prep_time.integer' => 'Sagatavošanas laikam jābūt veselam skaitlim.',
            'prep_time.min' => 'Sagatavošanas laiks nedrīkst būt negatīvs.',

            'cook_time.integer' => 'Gatavošanas laikam jābūt veselam skaitlim.',
            'cook_time.min' => 'Gatavošanas laiks nedrīkst būt negatīvs.',

            'servings.integer' => 'Porciju skaitam jābūt veselam skaitlim.',
            'servings.min' => 'Porciju skaitam jābūt vismaz 1.',

            'difficulty.required' => 'Lūdzu, izvēlieties grūtības līmeni.',
            'difficulty.in' => 'Izvēlieties derīgu grūtības līmeni.',

            'category.required' => 'Lūdzu, izvēlieties kategoriju.',
            'category.max' => 'Kategorijas nosaukums ir pārāk garš.',

            'ingredient_name.required' => 'Pievienojiet vismaz vienu sastāvdaļu.',
            'ingredient_name.array' => 'Sastāvdaļu formāts nav derīgs.',
            'ingredient_name.min' => 'Pievienojiet vismaz vienu sastāvdaļu.',
            'ingredient_name.*.required' => 'Katras sastāvdaļas nosaukums ir obligāts.',
            'ingredient_name.*.max' => 'Sastāvdaļas nosaukums nedrīkst būt garāks par 255 rakstzīmēm.',

            'ingredient_qty.*.numeric' => 'Sastāvdaļas daudzumam jābūt skaitlim.',
            'ingredient_qty.*.min' => 'Sastāvdaļas daudzums nedrīkst būt negatīvs.',

            'ingredient_unit.*.max' => 'Mērvienība nedrīkst būt garāka par 30 rakstzīmēm.',

            'image.image' => 'Augšupielādētajam failam jābūt attēlam.',
            'image.mimes' => 'Attēlam jābūt JPG, JPEG, PNG, WEBP vai GIF formātā.',
            'image.max' => 'Attēls nedrīkst pārsniegt 4 MB.',

            'video.file' => 'Augšupielādētajam failam jābūt video failam.',
            'video.mimetypes' => 'Video failam jābūt MP4, WEBM vai MOV formātā.',
            'video.max' => 'Video fails nedrīkst pārsniegt 50 MB.',
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

        $recipe->refresh();

        $this->tryBackfillIngredientQuantity($recipe);

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
        $validated = $request->validate(
            $this->validationRules(),
            $this->validationMessages()
        );

        $validated['user_id'] = Auth::id();
        $validated['views'] = 0;

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
                ->with('success', 'Recepte veiksmīgi publicēta.');
        } catch (\Exception $e) {
            Log::error('Recipe store error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Neizdevās saglabāt recepti. Lūdzu, mēģiniet vēlreiz.');
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

        $validated = $request->validate(
            $this->validationRules(true),
            $this->validationMessages()
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

            $validated['ingredients'] = $recipe->ingredients ?? '';
            $recipe->update($validated);

            $this->syncIngredientsFromArrays($recipe, $request);

            return redirect()
                ->route('recipes.show', $recipe)
                ->with('success', 'Recepte veiksmīgi atjaunināta.');
        } catch (\Exception $e) {
            Log::error('Recipe update error', [
                'recipe_id' => $recipe->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Neizdevās atjaunināt recepti. Lūdzu, mēģiniet vēlreiz.');
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

    public function userRecipes()
    {
        $recipes = Recipe::where('user_id', Auth::id())
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('profile.recipes', compact('recipes'));
    }
}