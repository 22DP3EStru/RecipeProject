<?php

/**
 * RecipeController kontrolieris nodrošina galveno recepšu pārvaldības funkcionalitāti
 * recepšu tīmekļa vietnē.
 *
 * Kontrolieris atbild par:
 * - recepšu saraksta attēlošanu;
 * - recepšu meklēšanu un filtrēšanu;
 * - konkrētas receptes attēlošanu;
 * - jaunas receptes izveidi;
 * - esošas receptes rediģēšanu;
 * - receptes dzēšanu;
 * - receptes attēlu un video failu apstrādi;
 * - sastāvdaļu strukturētu saglabāšanu;
 * - receptes PDF lejupielādi;
 * - drukāšanai paredzēta receptes skata attēlošanu;
 * - skatījumu skaita palielināšanu.
 */

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
    /**
     * Konstruktors nosaka piekļuves ierobežojumus recepšu darbībām.
     *
     * Recepšu sarakstu, konkrētu recepti un meklēšanu var skatīt arī viesi,
     * bet pārējām darbībām nepieciešama autentifikācija.
     */
    public function __construct()
    {
        $this->middleware('auth')->except([
            'index',
            'show',
            'search',
        ]);
    }

    /**
     * Ģenerē un lejupielādē konkrētas receptes PDF dokumentu.
     */
    public function downloadPdf(Recipe $recipe)
    {
        /**
         * Tiek ielādēti ar recepti saistītie dati:
         * autors un sastāvdaļas.
         */
        $recipe->loadMissing(['user', 'ingredientsItems']);

        /**
         * PDF faila nosaukums tiek izveidots no receptes nosaukuma un identifikatora.
         */
        $filename = Str::slug($recipe->title ?? 'recepte') . '-' . $recipe->id . '.pdf';

        /**
         * Tiek ģenerēts PDF dokuments, izmantojot receptes PDF skatu.
         */
        $pdf = Pdf::loadView('recipes.pdf', [
            'recipe' => $recipe,
        ])->setPaper('a4');

        return $pdf->download($filename);
    }

    /**
     * Attēlo recepti drukāšanai paredzētā skatā.
     */
    public function printView(Recipe $recipe)
    {
        /**
         * Tiek ielādēti drukas skatam nepieciešamie receptes dati.
         */
        $recipe->loadMissing(['user', 'ingredientsItems']);

        return view('recipes.print', compact('recipe'));
    }

    /**
     * Definē recepšu izveides un rediģēšanas validācijas noteikumus.
     */
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

    /**
     * Definē recepšu formas validācijas kļūdu paziņojumus latviešu valodā.
     */
    private function validationMessages(): array
    {
        return [
            'title.required' => 'Lūdzu, ievadiet receptes nosaukumu.',
            'title.string' => 'Receptes nosaukumam jābūt tekstam.',
            'title.max' => 'Receptes nosaukums nedrīkst pārsniegt 255 rakstzīmes.',

            'description.required' => 'Lūdzu, ievadiet receptes aprakstu.',
            'description.string' => 'Receptes aprakstam jābūt tekstam.',
            'description.min' => 'Receptes aprakstam jābūt vismaz 10 rakstzīmes garam.',

            'instructions.required' => 'Lūdzu, ievadiet gatavošanas instrukcijas.',
            'instructions.string' => 'Gatavošanas instrukcijām jābūt tekstam.',
            'instructions.min' => 'Gatavošanas instrukcijām jābūt vismaz 10 rakstzīmes garām.',

            'prep_time.integer' => 'Sagatavošanas laikam jābūt veselam skaitlim.',
            'prep_time.min' => 'Sagatavošanas laiks nedrīkst būt negatīvs.',

            'cook_time.integer' => 'Gatavošanas laikam jābūt veselam skaitlim.',
            'cook_time.min' => 'Gatavošanas laiks nedrīkst būt negatīvs.',

            'servings.integer' => 'Porciju skaitam jābūt veselam skaitlim.',
            'servings.min' => 'Porciju skaitam jābūt vismaz 1.',

            'difficulty.required' => 'Lūdzu, izvēlieties grūtības līmeni.',
            'difficulty.in' => 'Izvēlētais grūtības līmenis nav derīgs.',

            'category.required' => 'Lūdzu, izvēlieties kategoriju.',
            'category.max' => 'Kategorija nedrīkst pārsniegt 100 rakstzīmes.',

            'ingredient_name.required' => 'Lūdzu, pievienojiet vismaz vienu sastāvdaļu.',
            'ingredient_name.min' => 'Lūdzu, pievienojiet vismaz vienu sastāvdaļu.',
            'ingredient_name.*.required' => 'Lūdzu, ievadiet sastāvdaļas nosaukumu.',
            'ingredient_name.*.max' => 'Sastāvdaļas nosaukums nedrīkst pārsniegt 255 rakstzīmes.',

            'ingredient_qty.*.numeric' => 'Sastāvdaļas daudzumam jābūt skaitlim.',
            'ingredient_qty.*.min' => 'Sastāvdaļas daudzums nedrīkst būt negatīvs.',

            'ingredient_unit.*.max' => 'Sastāvdaļas mērvienība nedrīkst pārsniegt 30 rakstzīmes.',

            'image.image' => 'Augšupielādētajam failam jābūt attēlam.',
            'image.mimes' => 'Attēlam jābūt JPG, JPEG, PNG, WEBP vai GIF formātā.',
            'image.max' => 'Attēla izmērs nedrīkst pārsniegt 4 MB.',

            'video.mimetypes' => 'Video jābūt MP4, WEBM vai MOV formātā.',
            'video.max' => 'Video izmērs nedrīkst pārsniegt 50 MB.',
        ];
    }

    /**
     * Attēlo recepšu sarakstu ar meklēšanas un filtrēšanas iespējām.
     */
    public function index(Request $request)
    {
        /**
         * Tiek iegūtas meklēšanas un filtrēšanas vērtības no pieprasījuma.
         */
        $search = trim((string) $request->input('search', ''));
        $category = trim((string) $request->input('category', ''));
        $difficulty = trim((string) $request->input('difficulty', ''));

        /**
         * Tiek sagatavots recepšu vaicājums kopā ar autoru,
         * vidējo vērtējumu un atsauksmju skaitu.
         */
        $query = Recipe::with('user')
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        /**
         * Ja lietotājs ir ievadījis meklēšanas tekstu,
         * receptes tiek meklētas pēc nosaukuma, apraksta un sastāvdaļām.
         */
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('ingredients', 'like', "%{$search}%");
            });
        }

        /**
         * Ja ir izvēlēta kategorija, receptes tiek filtrētas pēc kategorijas.
         */
        if ($category !== '') {
            $query->where('category', $category);
        }

        /**
         * Ja ir izvēlēts grūtības līmenis,
         * receptes tiek filtrētas pēc grūtības līmeņa.
         */
        if ($difficulty !== '') {
            $query->where('difficulty', $difficulty);
        }

        /**
         * Filtrētās receptes tiek sakārtotas pēc jaunākajiem ierakstiem
         * un sadalītas lapās pa 12 receptēm.
         */
        $recipes = $query->latest()->paginate(12)->withQueryString();

        /**
         * Tiek iegūts visu pieejamo kategoriju saraksts filtra laukam.
         */
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
     * Attēlo pašreizējā lietotāja izveidotās receptes.
     */
    public function userRecipes()
    {
        /**
         * Tiek atlasītas tikai tās receptes, kuras izveidojis pašreizējais lietotājs.
         */
        $recipes = Recipe::with('user')
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(12);

        return view('profile.recipes', compact('recipes'));
    }

    /**
     * Attēlo konkrētas receptes detalizēto skatu.
     */
    public function show(Recipe $recipe)
    {
        /**
         * Tiek izveidota sesijas atslēga, lai vienā sesijā
         * vienu recepti skaitītu kā skatītu tikai vienu reizi.
         */
        $sessionKey = 'recipe_viewed_' . $recipe->id;

        /**
         * Ja recepte šajā sesijā vēl nav skatīta,
         * tās skatījumu skaits tiek palielināts par vienu.
         */
        if (!session()->has($sessionKey)) {
            $recipe->increment('views');
            session()->put($sessionKey, true);
        }

        /**
         * Tiek ielādēti detalizētajam receptes skatam nepieciešamie dati.
         */
        $recipe->load([
            'user',
            'reviews.user',
            'ingredientsItems',
        ]);

        /**
         * Tiek ielādēti receptes komentāri kopā ar lietotājiem un atbildēm.
         */
        $comments = $recipe->comments()
            ->with(['user', 'replies.user'])
            ->paginate(8)
            ->withQueryString();

        /**
         * Tiek atlasītas citas līdzīgas receptes no tās pašas kategorijas.
         */
        $relatedRecipes = Recipe::with('user')
            ->where('id', '!=', $recipe->id)
            ->when($recipe->category, function ($query) use ($recipe) {
                $query->where('category', $recipe->category);
            })
            ->inRandomOrder()
            ->take(4)
            ->get();

        /**
         * Ja lietotājs ir autentificēts, tiek pārbaudīts,
         * vai viņš jau ir pievienojis vērtējumu šai receptei.
         */
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

    /**
     * Attēlo jaunas receptes izveides formu.
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Sinhronizē formas sastāvdaļu laukus ar receptes sastāvdaļu ierakstiem.
     */
    private function syncIngredientsFromArrays(Recipe $recipe, Request $request): void
    {
        /**
         * Tiek iegūti sastāvdaļu nosaukumi, daudzumi un mērvienības.
         */
        $names = $request->input('ingredient_name', []);
        $qtys = $request->input('ingredient_qty', []);
        $units = $request->input('ingredient_unit', []);

        /**
         * Pirms jauno sastāvdaļu saglabāšanas tiek dzēsti esošie sastāvdaļu ieraksti.
         */
        $recipe->ingredientsItems()->delete();

        $legacyLines = [];

        /**
         * Tiek noteikts lielākais ievadīto sastāvdaļu lauku skaits,
         * lai apstrādātu visus formas masīvus.
         */
        $count = max(count($names), count($qtys), count($units));

        for ($i = 0; $i < $count; $i++) {
            $name = trim((string) ($names[$i] ?? ''));
            $qtyRaw = $qtys[$i] ?? null;
            $unit = trim((string) ($units[$i] ?? ''));

            /**
             * Tukšas sastāvdaļu rindas netiek saglabātas.
             */
            if ($name === '') {
                continue;
            }

            $quantity = null;

            /**
             * Daudzums tiek normalizēts, lai atbalstītu gan punktu,
             * gan komatu kā decimāldaļas atdalītāju.
             */
            if ($qtyRaw !== null && $qtyRaw !== '') {
                $qtyNorm = str_replace(',', '.', (string) $qtyRaw);
                if (is_numeric($qtyNorm)) {
                    $quantity = (float) $qtyNorm;
                }
            }

            /**
             * Sastāvdaļa tiek saglabāta strukturētā sastāvdaļu tabulā.
             */
            $recipe->ingredientsItems()->create([
                'name' => $name,
                'quantity' => $quantity,
                'unit' => $unit !== '' ? $unit : null,
            ]);

            /**
             * Paralēli tiek izveidota teksta formāta sastāvdaļu versija,
             * lai saglabātu saderību ar receptes ingredients lauku.
             */
            if ($quantity !== null && $unit !== '') {
                $legacyLines[] = $quantity . ' ' . $unit . ' ' . $name;
            } elseif ($quantity !== null) {
                $legacyLines[] = $quantity . ' ' . $name;
            } else {
                $legacyLines[] = $name;
            }
        }

        /**
         * Teksta formāta sastāvdaļu saraksts tiek saglabāts receptes ierakstā.
         */
        $recipe->ingredients = implode("\n", $legacyLines);
        $recipe->save();
    }

    /**
     * Saglabā jaunu recepti datubāzē.
     */
    public function store(Request $request)
    {
        /**
         * Tiek validēti jaunas receptes formas dati.
         */
        $validated = $request->validate(
            $this->validationRules(),
            $this->validationMessages()
        );

        /**
         * Validētajiem datiem tiek pievienots receptes autors,
         * sākotnējais skatījumu skaits un sākotnēji tukšs sastāvdaļu teksts.
         */
        $validated['user_id'] = Auth::id();
        $validated['views'] = 0;
        $validated['ingredients'] = '';

        /**
         * Strukturēto sastāvdaļu un failu lauki tiek izņemti,
         * jo tie tiek apstrādāti atsevišķi.
         */
        unset(
            $validated['ingredient_name'],
            $validated['ingredient_qty'],
            $validated['ingredient_unit'],
            $validated['image'],
            $validated['video']
        );

        /**
         * Ja ir augšupielādēts attēls, tas tiek saglabāts publiskajā glabātuvē.
         */
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('recipes/images', 'public');
        }

        /**
         * Ja ir augšupielādēts video, tas tiek saglabāts publiskajā glabātuvē.
         */
        if ($request->hasFile('video')) {
            $validated['video_path'] = $request->file('video')->store('recipes/videos', 'public');
        }

        try {
            /**
             * Tiek izveidots receptes ieraksts un saglabātas saistītās sastāvdaļas.
             */
            $recipe = Recipe::create($validated);
            $this->syncIngredientsFromArrays($recipe, $request);

            return redirect()
                ->route('recipes.show', $recipe)
                ->with('success', 'Recepte veiksmīgi publicēta.');
        } catch (\Exception $e) {
            /**
             * Kļūdas gadījumā informācija tiek ierakstīta žurnālā.
             */
            Log::error('Recipe store error', [
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Neizdevās saglabāt recepti.');
        }
    }

    /**
     * Attēlo receptes rediģēšanas formu.
     */
    public function edit(Recipe $recipe)
    {
        /**
         * Rediģēt recepti drīkst tikai tās autors.
         */
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        /**
         * Tiek ielādētas receptes sastāvdaļas rediģēšanas formai.
         */
        $recipe->load('ingredientsItems');

        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Atjaunina esošu recepti.
     */
    public function update(Request $request, Recipe $recipe)
    {
        /**
         * Atjaunināt recepti drīkst tikai tās autors.
         */
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }

        /**
         * Tiek validēti receptes rediģēšanas formas dati.
         */
        $validated = $request->validate(
            $this->validationRules(),
            $this->validationMessages()
        );

        /**
         * Strukturēto sastāvdaļu un failu lauki tiek izņemti,
         * jo tie tiek apstrādāti atsevišķi.
         */
        unset(
            $validated['ingredient_name'],
            $validated['ingredient_qty'],
            $validated['ingredient_unit'],
            $validated['image'],
            $validated['video']
        );

        try {
            /**
             * Ja tiek augšupielādēts jauns attēls,
             * iepriekšējais attēls tiek dzēsts un aizstāts ar jauno.
             */
            if ($request->hasFile('image')) {
                if ($recipe->image_path) {
                    Storage::disk('public')->delete($recipe->image_path);
                }

                $validated['image_path'] = $request->file('image')->store('recipes/images', 'public');
            }

            /**
             * Ja tiek augšupielādēts jauns video,
             * iepriekšējais video tiek dzēsts un aizstāts ar jauno.
             */
            if ($request->hasFile('video')) {
                if ($recipe->video_path) {
                    Storage::disk('public')->delete($recipe->video_path);
                }

                $validated['video_path'] = $request->file('video')->store('recipes/videos', 'public');
            }

            /**
             * Receptes dati tiek atjaunināti datubāzē.
             */
            $recipe->update($validated);

            /**
             * Tiek atjaunināts receptes strukturētais sastāvdaļu saraksts.
             */
            $this->syncIngredientsFromArrays($recipe, $request);

            return redirect()
                ->route('recipes.show', $recipe)
                ->with('success', 'Recepte veiksmīgi atjaunināta.');
        } catch (\Exception $e) {
            /**
             * Kļūdas gadījumā informācija tiek ierakstīta žurnālā.
             */
            Log::error('Recipe update error', [
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Neizdevās atjaunināt recepti.');
        }
    }

    /**
     * Dzēš konkrētu recepti.
     */
    public function destroy(Recipe $recipe)
    {
        /**
         * Recepti dzēst drīkst tās autors vai administrators.
         */
        if ($recipe->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        /**
         * Ja receptei ir attēls, tas tiek dzēsts no publiskās glabātuves.
         */
        if ($recipe->image_path) {
            Storage::disk('public')->delete($recipe->image_path);
        }

        /**
         * Ja receptei ir video, tas tiek dzēsts no publiskās glabātuves.
         */
        if ($recipe->video_path) {
            Storage::disk('public')->delete($recipe->video_path);
        }

        /**
         * Tiek dzēsti receptes sastāvdaļu ieraksti un pēc tam pati recepte.
         */
        $recipe->ingredientsItems()->delete();
        $recipe->delete();

        return redirect()
            ->route('profile.recipes')
            ->with('success', 'Recepte veiksmīgi dzēsta!');
    }
}