<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    private function extractStepsFromInstructions(?string $instructions): array
    {
        if (!$instructions) {
            return [];
        }

        $lines = preg_split('/\r\n|\r|\n/', trim($instructions));
        $lines = array_filter(array_map('trim', $lines));

        return array_values($lines);
    }

    public function recipeFull(Request $request, Recipe $recipe)
    {
        $recipe->load(['user', 'ingredientsItems', 'reviews']);

        $steps = $this->extractStepsFromInstructions($recipe->instructions);

        $scaledData = $this->getScaledIngredients($recipe, $request->get('servings'));

        $pdf = Pdf::loadView('pdf.recipe-full', [
            'recipe' => $recipe,
            'steps' => $steps,
            'scaledIngredients' => $scaledData['ingredients'],
            'targetServings' => $scaledData['targetServings'],
            'originalServings' => $scaledData['originalServings'],
        ])->setPaper('a4', 'portrait');

        return $pdf->download('recepte-pilna-' . $recipe->id . '.pdf');
    }

    public function recipeIngredients(Request $request, Recipe $recipe)
    {
        $recipe->load(['ingredientsItems']);

        $scaledData = $this->getScaledIngredients($recipe, $request->get('servings'));

        $pdf = Pdf::loadView('pdf.recipe-ingredients', [
            'recipe' => $recipe,
            'scaledIngredients' => $scaledData['ingredients'],
            'targetServings' => $scaledData['targetServings'],
            'originalServings' => $scaledData['originalServings'],
        ])->setPaper('a4', 'portrait');

        return $pdf->download('recepte-sastavdalas-' . $recipe->id . '.pdf');
    }

    public function recipeSteps(Request $request, Recipe $recipe)
    {
        $steps = $this->extractStepsFromInstructions($recipe->instructions);
        $targetServings = max((int)($request->get('servings', $recipe->servings ?? 1)), 1);

        $pdf = Pdf::loadView('pdf.recipe-steps', compact('recipe', 'steps', 'targetServings'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('recepte-soli-' . $recipe->id . '.pdf');
    }

    private function scaleAmount($amount, $ratio)
    {
        if (!$amount) {
            return $amount;
        }

        if (is_numeric($amount)) {
            $scaled = (float)$amount * $ratio;
            return fmod($scaled, 1.0) == 0.0 ? (int)$scaled : round($scaled, 2);
        }

        if (preg_match('/^\s*(\d+(?:[.,]\d+)?)\s*(.*)$/u', trim($amount), $matches)) {
            $number = (float) str_replace(',', '.', $matches[1]);
            $unit = trim($matches[2]);

            $scaled = $number * $ratio;
            $scaledFormatted = fmod($scaled, 1.0) == 0.0 ? (int)$scaled : round($scaled, 2);

            return trim($scaledFormatted . ' ' . $unit);
        }

        return $amount;
    }

    private function getScaledIngredients($recipe, $targetServings = null)
    {
        $originalServings = max((int)($recipe->servings ?? 1), 1);
        $targetServings = max((int)($targetServings ?? $originalServings), 1);
        $ratio = $targetServings / $originalServings;

        $scaledIngredients = [];

        if ($recipe->ingredientsItems && $recipe->ingredientsItems->count()) {
            foreach ($recipe->ingredientsItems as $ingredient) {
                $scaledIngredients[] = [
                    'name' => $ingredient->name ?? $ingredient->ingredient ?? '-',
                    'amount' => $this->scaleAmount($ingredient->amount ?? $ingredient->quantity ?? '-', $ratio),
                ];
            }
        }

        return [
            'originalServings' => $originalServings,
            'targetServings' => $targetServings,
            'ratio' => $ratio,
            'ingredients' => $scaledIngredients,
        ];
    }

    public function categoryRecipes(Category $category)
{
    $recipes = Recipe::with('user', 'reviews')
        ->where('category', $category->name)
        ->latest()
        ->get();

    $pdf = Pdf::loadView('pdf.category-recipes', compact('category', 'recipes'))
        ->setPaper('a4', 'portrait');

    return $pdf->download('kategorija-' . $category->id . '-receptes.pdf');
}

public function userProfile(User $user)
{
    $recipes = $user->recipes()
        ->with('reviews')
        ->latest()
        ->get();

    $pdf = Pdf::loadView('pdf.user-profile', compact('user', 'recipes'))
        ->setPaper('a4', 'portrait');

    return $pdf->download('lietotajs-' . $user->id . '-profils.pdf');
}

public function popularRecipes(Request $request)
{
    $days = (int) $request->get('days', 30);

    $recipes = Recipe::with('user', 'reviews')
        ->latest()
        ->take(10)
        ->get();

    $totalViews = 0;

    if (Schema::hasColumn('recipes', 'views_count')) {
        $recipes = Recipe::with('user', 'reviews')
            ->orderByDesc('views_count')
            ->take(10)
            ->get();

        $totalViews = $recipes->sum('views_count');
    }

    $pdf = Pdf::loadView('pdf.popular-recipes', compact('recipes', 'days', 'totalViews'))
        ->setPaper('a4', 'portrait');

    return $pdf->download('popularakas-receptes.pdf');
}

public function adminStatistics()
{
    $usersCount = User::count();
    $recipesCount = Recipe::count();

    $commentsCount = 0;
    if (Schema::hasTable('comments')) {
        $commentsCount = DB::table('comments')->count();
    }

    $averageRating = 0;
    $allRecipes = Recipe::with('reviews', 'user')->get();

    $ratings = [];
    foreach ($allRecipes as $recipe) {
        foreach ($recipe->reviews as $review) {
            if (isset($review->rating)) {
                $ratings[] = $review->rating;
            }
        }
    }

    if (count($ratings) > 0) {
        $averageRating = array_sum($ratings) / count($ratings);
    }

    $popularRecipes = Recipe::with('user', 'reviews')
        ->latest()
        ->take(10)
        ->get();

    if (Schema::hasColumn('recipes', 'views_count')) {
        $popularRecipes = Recipe::with('user', 'reviews')
            ->orderByDesc('views_count')
            ->take(10)
            ->get();
    }

    $generatedAt = now();

    $pdf = Pdf::loadView('pdf.admin-statistics', compact(
        'usersCount',
        'recipesCount',
        'commentsCount',
        'averageRating',
        'popularRecipes',
        'generatedAt'
    ))->setPaper('a4', 'portrait');

    return $pdf->download('sistemas-statistika.pdf');
}

public function filteredRecipes(Request $request)
{
    $query = Recipe::with('user', 'reviews');

    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    if ($request->filled('difficulty')) {
        $query->where('difficulty', $request->difficulty);
    }

    if ($request->filled('max_time')) {
        $query->whereRaw('(COALESCE(prep_time,0) + COALESCE(cook_time,0)) <= ?', [$request->max_time]);
    }

    $recipes = $query->latest()->get();

    $filters = [
        'category' => $request->category,
        'difficulty' => $request->difficulty,
        'max_time' => $request->max_time,
    ];

    $pdf = Pdf::loadView('pdf.filtered-recipes', compact('recipes', 'filters'))
        ->setPaper('a4', 'portrait');

    return $pdf->download('filtretas-receptes.pdf');
}
}