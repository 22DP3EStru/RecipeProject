<?php

/**
 * PdfController kontrolieris nodrošina PDF dokumentu ģenerēšanu
 * recepšu tīmekļa vietnē.
 *
 * Kontrolieris atbild par:
 * - pilnas receptes PDF dokumenta izveidi;
 * - receptes sastāvdaļu PDF dokumenta izveidi;
 * - receptes pagatavošanas soļu PDF dokumenta izveidi;
 * - kategorijas recepšu PDF dokumenta izveidi;
 * - lietotāja profila PDF dokumenta izveidi;
 * - populārāko recepšu PDF dokumenta izveidi;
 * - administratora statistikas PDF dokumenta izveidi;
 * - filtrēto recepšu PDF dokumenta izveidi;
 * - sastāvdaļu daudzuma pielāgošanu porciju skaitam.
 */

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
    /**
     * Pārveido pagatavošanas instrukciju tekstu atsevišķu soļu masīvā.
     */
    private function extractStepsFromInstructions(?string $instructions): array
    {
        /**
         * Ja instrukcijas nav norādītas, tiek atgriezts tukšs masīvs.
         */
        if (!$instructions) {
            return [];
        }

        /**
         * Instrukciju teksts tiek sadalīts rindās.
         * Katra rinda tiek apstrādāta kā atsevišķs pagatavošanas solis.
         */
        $lines = preg_split('/\r\n|\r|\n/', trim($instructions));
        $lines = array_filter(array_map('trim', $lines));

        return array_values($lines);
    }

    /**
     * Ģenerē pilnas receptes PDF dokumentu.
     */
    public function recipeFull(Request $request, Recipe $recipe)
    {
        /**
         * Tiek ielādēti ar recepti saistītie dati:
         * autors, sastāvdaļas un atsauksmes.
         */
        $recipe->load(['user', 'ingredientsItems', 'reviews']);

        /**
         * Pagatavošanas instrukcijas tiek pārveidotas atsevišķos soļos.
         */
        $steps = $this->extractStepsFromInstructions($recipe->instructions);

        /**
         * Sastāvdaļu daudzumi tiek pielāgoti izvēlētajam porciju skaitam.
         */
        $scaledData = $this->getScaledIngredients($recipe, $request->get('servings'));

        /**
         * Tiek izveidots PDF dokuments, izmantojot pilnas receptes skatu.
         */
        $pdf = Pdf::loadView('pdf.recipe-full', [
            'recipe' => $recipe,
            'steps' => $steps,
            'scaledIngredients' => $scaledData['ingredients'],
            'targetServings' => $scaledData['targetServings'],
            'originalServings' => $scaledData['originalServings'],
        ])->setPaper('a4', 'portrait');

        return $pdf->download('recepte-pilna-' . $recipe->id . '.pdf');
    }

    /**
     * Ģenerē receptes sastāvdaļu PDF dokumentu.
     */
    public function recipeIngredients(Request $request, Recipe $recipe)
    {
        /**
         * Tiek ielādētas receptes sastāvdaļas.
         */
        $recipe->load(['ingredientsItems']);

        /**
         * Sastāvdaļu daudzumi tiek pielāgoti izvēlētajam porciju skaitam.
         */
        $scaledData = $this->getScaledIngredients($recipe, $request->get('servings'));

        /**
         * Tiek izveidots PDF dokuments, kurā redzamas tikai receptes sastāvdaļas.
         */
        $pdf = Pdf::loadView('pdf.recipe-ingredients', [
            'recipe' => $recipe,
            'scaledIngredients' => $scaledData['ingredients'],
            'targetServings' => $scaledData['targetServings'],
            'originalServings' => $scaledData['originalServings'],
        ])->setPaper('a4', 'portrait');

        return $pdf->download('recepte-sastavdalas-' . $recipe->id . '.pdf');
    }

    /**
     * Ģenerē receptes pagatavošanas soļu PDF dokumentu.
     */
    public function recipeSteps(Request $request, Recipe $recipe)
    {
        /**
         * Pagatavošanas instrukcijas tiek pārveidotas soļu sarakstā.
         */
        $steps = $this->extractStepsFromInstructions($recipe->instructions);

        /**
         * Tiek noteikts izvēlētais porciju skaits.
         * Ja tas nav norādīts, tiek izmantots receptes sākotnējais porciju skaits.
         */
        $targetServings = max((int)($request->get('servings', $recipe->servings ?? 1)), 1);

        /**
         * Tiek izveidots PDF dokuments ar receptes pagatavošanas soļiem.
         */
        $pdf = Pdf::loadView('pdf.recipe-steps', compact('recipe', 'steps', 'targetServings'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('recepte-soli-' . $recipe->id . '.pdf');
    }

    /**
     * Pielāgo sastāvdaļas daudzumu atbilstoši porciju skaita attiecībai.
     */
    private function scaleAmount($amount, $ratio)
    {
        /**
         * Ja daudzums nav norādīts, tas tiek atgriezts nemainīts.
         */
        if (!$amount) {
            return $amount;
        }

        /**
         * Ja daudzums ir skaitlis, tas tiek reizināts ar porciju attiecību.
         */
        if (is_numeric($amount)) {
            $scaled = (float)$amount * $ratio;
            return fmod($scaled, 1.0) == 0.0 ? (int)$scaled : round($scaled, 2);
        }

        /**
         * Ja daudzums satur skaitli un mērvienību, tiek pielāgota tikai skaitliskā daļa.
         */
        if (preg_match('/^\s*(\d+(?:[.,]\d+)?)\s*(.*)$/u', trim($amount), $matches)) {
            $number = (float) str_replace(',', '.', $matches[1]);
            $unit = trim($matches[2]);

            $scaled = $number * $ratio;
            $scaledFormatted = fmod($scaled, 1.0) == 0.0 ? (int)$scaled : round($scaled, 2);

            return trim($scaledFormatted . ' ' . $unit);
        }

        /**
         * Ja daudzumu nav iespējams matemātiski pielāgot,
         * tas tiek atgriezts sākotnējā formā.
         */
        return $amount;
    }

    /**
     * Sagatavo sastāvdaļu sarakstu atbilstoši izvēlētajam porciju skaitam.
     */
    private function getScaledIngredients($recipe, $targetServings = null)
    {
        /**
         * Tiek noteikts sākotnējais un izvēlētais porciju skaits.
         */
        $originalServings = max((int)($recipe->servings ?? 1), 1);
        $targetServings = max((int)($targetServings ?? $originalServings), 1);
        $ratio = $targetServings / $originalServings;

        $scaledIngredients = [];

        /**
         * Ja receptei ir strukturētas sastāvdaļas,
         * katras sastāvdaļas daudzums tiek pielāgots porciju attiecībai.
         */
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

    /**
     * Ģenerē konkrētas kategorijas recepšu PDF dokumentu.
     */
    public function categoryRecipes(Category $category)
    {
        /**
         * Tiek atlasītas visas receptes, kas atbilst izvēlētajai kategorijai.
         */
        $recipes = Recipe::with('user', 'reviews')
            ->where('category', $category->name)
            ->latest()
            ->get();

        /**
         * Tiek izveidots kategorijas recepšu PDF dokuments.
         */
        $pdf = Pdf::loadView('pdf.category-recipes', compact('category', 'recipes'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('kategorija-' . $category->id . '-receptes.pdf');
    }

    /**
     * Ģenerē kategorijas recepšu PDF dokumentu pēc kategorijas nosaukuma.
     */
    public function categoryRecipesByName($categoryName)
    {
        /**
         * URL kategorijas nosaukums tiek pārveidots par parastu tekstu.
         */
        $decodedCategoryName = urldecode($categoryName);

        /**
         * Tiek atlasītas receptes pēc kategorijas nosaukuma.
         */
        $recipes = Recipe::with('user', 'reviews')
            ->where('category', $decodedCategoryName)
            ->latest()
            ->get();

        /**
         * Tiek izveidots kategorijas objekts PDF skata vajadzībām.
         */
        $category = (object) [
            'name' => $decodedCategoryName,
            'slug' => \Illuminate\Support\Str::slug($decodedCategoryName),
        ];

        /**
         * Tiek izveidots kategorijas recepšu PDF dokuments.
         */
        $pdf = Pdf::loadView('pdf.category-recipes', compact('category', 'recipes'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('kategorija-' . $decodedCategoryName . '-receptes.pdf');
    }

    /**
     * Ģenerē lietotāja profila PDF dokumentu.
     */
    public function userProfile(User $user)
    {
        /**
         * Tiek iegūtas lietotāja pievienotās receptes kopā ar atsauksmēm.
         */
        $recipes = $user->recipes()
            ->with('reviews')
            ->latest()
            ->get();

        /**
         * Tiek izveidots lietotāja profila PDF dokuments.
         */
        $pdf = Pdf::loadView('pdf.user-profile', compact('user', 'recipes'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('lietotajs-' . $user->id . '-profils.pdf');
    }

    /**
     * Ģenerē populārāko recepšu PDF dokumentu.
     */
    public function popularRecipes(Request $request)
    {
        /**
         * Tiek iegūts dienu skaits, par kuru paredzēts attēlot populārākās receptes.
         */
        $days = (int) $request->get('days', 30);

        /**
         * Tiek sagatavots recepšu vaicājums kopā ar autoru un atsauksmēm.
         */
        $query = Recipe::with('user', 'reviews');

        /**
         * Ja datubāzē eksistē views kolonna, receptes tiek kārtotas pēc skatījumu skaita.
         * Pretējā gadījumā tās tiek kārtotas pēc jaunākajiem ierakstiem.
         */
        if (Schema::hasColumn('recipes', 'views')) {
            $query->orderByDesc('views');
        } else {
            $query->latest();
        }

        /**
         * Tiek atlasītas desmit populārākās receptes.
         */
        $recipes = $query->take(10)->get();

        /**
         * Tiek aprēķināts kopējais recepšu skatījumu skaits.
         */
        $totalViews = Schema::hasColumn('recipes', 'views')
            ? Recipe::sum('views')
            : 0;

        /**
         * Tiek izveidots populārāko recepšu PDF dokuments.
         */
        $pdf = Pdf::loadView('pdf.popular-recipes', compact('recipes', 'days', 'totalViews'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('popularakas-receptes.pdf');
    }

    /**
     * Ģenerē administratora sistēmas statistikas PDF dokumentu.
     */
    public function adminStatistics()
    {
        /**
         * Tiek aprēķināts kopējais lietotāju un recepšu skaits.
         */
        $usersCount = User::count();
        $recipesCount = Recipe::count();

        /**
         * Tiek aprēķināts komentāru skaits, ja komentāru tabula eksistē.
         */
        $commentsCount = 0;
        if (Schema::hasTable('comments')) {
            $commentsCount = DB::table('comments')->count();
        }

        /**
         * Tiek aprēķināts vidējais recepšu vērtējums.
         */
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

        /**
         * Tiek aprēķināts kopējais skatījumu skaits,
         * ja datubāzē eksistē views kolonna.
         */
        $totalViews = Schema::hasColumn('recipes', 'views')
            ? Recipe::sum('views')
            : 0;

        /**
         * Tiek aprēķināts vidējais skatījumu skaits uz vienu recepti.
         */
        $averageViewsPerRecipe = $recipesCount > 0
            ? round($totalViews / $recipesCount, 2)
            : 0;

        /**
         * Tiek noteikta visvairāk skatītā recepte.
         */
        $mostViewedRecipe = null;
        if (Schema::hasColumn('recipes', 'views')) {
            $mostViewedRecipe = Recipe::with('user', 'reviews')
                ->orderByDesc('views')
                ->first();
        }

        /**
         * Tiek sagatavots populārāko recepšu saraksts administratora statistikai.
         */
        $popularRecipesQuery = Recipe::with('user', 'reviews');

        if (Schema::hasColumn('recipes', 'views')) {
            $popularRecipesQuery->orderByDesc('views');
        } else {
            $popularRecipesQuery->latest();
        }

        $popularRecipes = $popularRecipesQuery->take(10)->get();

        /**
         * Tiek saglabāts PDF ģenerēšanas laiks.
         */
        $generatedAt = now();

        /**
         * Tiek izveidots sistēmas statistikas PDF dokuments.
         */
        $pdf = Pdf::loadView('pdf.admin-statistics', compact(
            'usersCount',
            'recipesCount',
            'commentsCount',
            'averageRating',
            'popularRecipes',
            'generatedAt',
            'totalViews',
            'averageViewsPerRecipe',
            'mostViewedRecipe'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('sistemas-statistika.pdf');
    }

    /**
     * Ģenerē PDF dokumentu ar filtrētām receptēm.
     */
    public function filteredRecipes(Request $request)
    {
        /**
         * Tiek sagatavots recepšu vaicājums kopā ar autoru un atsauksmēm.
         */
        $query = Recipe::with('user', 'reviews');

        /**
         * Ja ir norādīta kategorija, receptes tiek filtrētas pēc kategorijas.
         */
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        /**
         * Ja ir norādīts sarežģītības līmenis,
         * receptes tiek filtrētas pēc sarežģītības.
         */
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        /**
         * Ja ir norādīts maksimālais laiks,
         * receptes tiek filtrētas pēc kopējā pagatavošanas laika.
         */
        if ($request->filled('max_time')) {
            $query->whereRaw('(COALESCE(prep_time,0) + COALESCE(cook_time,0)) <= ?', [$request->max_time]);
        }

        /**
         * Tiek iegūtas filtrētās receptes.
         */
        $recipes = $query->latest()->get();

        /**
         * Tiek saglabāti izmantotie filtri, lai tos varētu attēlot PDF dokumentā.
         */
        $filters = [
            'category' => $request->category,
            'difficulty' => $request->difficulty,
            'max_time' => $request->max_time,
        ];

        /**
         * Tiek izveidots filtrēto recepšu PDF dokuments.
         */
        $pdf = Pdf::loadView('pdf.filtered-recipes', compact('recipes', 'filters'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('filtretas-receptes.pdf');
    }
}