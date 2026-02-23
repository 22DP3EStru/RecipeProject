<?php // Sākas PHP kods

namespace App\Http\Controllers; // Kontrolieris atrodas Controllers mapē

use App\Models\Recipe; // Recipe modelis (recipes tabula)
use Illuminate\Http\Request; // HTTP pieprasījums (formu/URL dati)
use Illuminate\Support\Facades\Auth; // Lai dabūtu ielogoto lietotāju / pārbaudītu vai ielogots
use Illuminate\Support\Facades\Log; // Lai pierakstītu kļūdas laravel.log failā
use Illuminate\Support\Str; // Teksta palīgfunkcijas (šajā failā īsti netiek izmantots)

class RecipeController extends Controller // Kontrolieris recepšu funkcijām (saraksts, skatīt, izveidot, labot, dzēst)
{
    public function __construct() // Konstruktors (izpildās, kad kontrolieris tiek izmantots)
    {
        $this->middleware('auth')->except([ // Prasa login visām metodēm, izņemot šīs
            'index', // recepšu saraksts publiski
            'show',  // recepte publiski
            'search', // meklēšana publiski (te gan atsevišķas metodes nav redzama, bet ir atļauta)
        ]);
    }

    public function index(Request $request) // Recešu saraksts + filtri
    {
        $query = Recipe::with('user') // Paņem receptes kopā ar autoru (user)
            ->withAvg('reviews', 'rating') // Pievieno vidējo vērtējumu no reviews (rating)
            ->withCount('reviews'); // Pievieno reviews skaitu (cik atsauksmes)

        if ($request->has('search') && $request->search) { // Ja URL/formā ir search un tas nav tukšs
            $search = $request->search; // Paņem meklēšanas tekstu
            $query->where(function($q) use ($search) { // Grupē nosacījumus vienā blokā
                $q->where('title', 'like', "%{$search}%") // Meklē virsrakstā
                  ->orWhere('description', 'like', "%{$search}%") // Vai aprakstā
                  ->orWhere('ingredients', 'like', "%{$search}%"); // Vai sastāvdaļās
            });
        }

        if ($request->has('category') && $request->category) { // Ja ir izvēlēta kategorija
            $query->where('category', $request->category); // Filtrē pēc kategorijas
        }

        if ($request->has('difficulty') && $request->difficulty) { // Ja ir izvēlēta grūtība
            $query->where('difficulty', $request->difficulty); // Filtrē pēc grūtības
        }

        $recipes = $query->latest()->paginate(12); // Sakārto jaunākās pirmās un rāda 12 vienā lapā
        $categories = Recipe::distinct('category')->pluck('category')->filter(); // Paņem unikālās kategorijas sarakstā

        return view('recipes.index', compact('recipes', 'categories')); // Atver recipes.index skatu ar receptēm + kategorijām
    }

    public function show(Recipe $recipe) // Parāda vienu recepti (Laravel pats atrod pēc ID no URL)
    {
        $recipe->load(['user', 'reviews.user']); // Ielādē autoru + atsauksmes un atsauksmju autorus

        $relatedRecipes = Recipe::with('user') // Līdzīgās receptes (ar autoru)
            ->where('category', $recipe->category) // Tajā pašā kategorijā
            ->where('id', '!=', $recipe->id) // Izņemot šo pašu recepti
            ->inRandomOrder() // Sajauc nejaušā secībā
            ->take(4) // Paņem 4 gabalus
            ->get(); // Izpilda un dabū kolekciju

        $myReview = null; // Noklusēti: lietotāja atsauksme nav atrasta
        if (Auth::check()) { // Ja lietotājs ir ielogots
            $myReview = $recipe->reviews->firstWhere('user_id', Auth::id()); // Atrod pirmo atsauksmi no šī lietotāja
        }

        return view('recipes.show', compact( // Atver receptes skatīšanās lapu
            'recipe', // pašu recepti
            'relatedRecipes', // līdzīgās receptes
            'myReview' // mana atsauksme (ja ir)
        ));
    }

    public function create() // Parāda receptes izveides formu
    {
        return view('recipes.create'); // Atver recipes.create skatu
    }

    public function store(Request $request) // Saglabā jaunu recepti pēc formas iesniegšanas
    {
        $validated = $request->validate([ // Pārbauda ievadītos laukus
            'title' => 'required|string|max:255', // Nosaukums obligāts, teksts, max 255
            'description' => 'required|string', // Apraksts obligāts
            'ingredients' => 'required|string', // Sastāvdaļas obligātas
            'instructions' => 'required|string', // Instrukcijas obligātas
            'prep_time' => 'nullable|integer|min:0', // Gatavošanas sagatavošanas laiks nav obligāts, bet ja ir, tad skaitlis >=0
            'cook_time' => 'nullable|integer|min:0', // Gatavošanas laiks nav obligāts, bet ja ir, tad skaitlis >=0
            'servings' => 'nullable|integer|min:1', // Porcijas nav obligātas, bet ja ir, tad >=1
            'difficulty' => 'nullable|string|max:50', // Grūtība nav obligāta
            'category' => 'nullable|string|max:100', // Kategorija nav obligāta
            'image' => 'nullable|image|max:4096', // Attēls nav obligāts, ja ir, jābūt bildei un max ~4MB
        ]);

        if ($request->hasFile('image')) { // Ja lietotājs augšupielādēja attēlu
            $validated['image_path'] = $request->file('image')->store('recipes', 'public'); 
            // Saglabā bildi storage/public/recipes un ieliek ceļu image_path laukā
        }

        $validated['user_id'] = Auth::id(); // Pievieno receptes autoru (ielogotā lietotāja ID)

        try { // Mēģina saglabāt recepti
            $recipe = Recipe::create($validated); // Izveido recepti datubāzē
            return redirect()->route('recipes.show', $recipe)->with('success', 'Recepte publicēta.'); 
            // Aizved uz receptes skatīšanās lapu ar paziņojumu
        } catch (\Exception $e) { // Ja kaut kas nogāja greizi
            Log::error('Recipe store error', [ // Ieraksta kļūdu laravel.log
                'error' => $e->getMessage(), // Kļūdas teksts
                'request' => $request->all() // Visi ievadītie dati (debug nolūkiem)
            ]);
            return back()->withInput()->with('error', 'Kļūda saglabājot recepti. Skatiet storage/logs/laravel.log'); 
            // Atgriežas atpakaļ, saglabā ievadītos datus un parāda kļūdas ziņu
        }
    }

    public function edit(Recipe $recipe) // Parāda receptes rediģēšanas formu
    {
        if ($recipe->user_id !== Auth::id()) { // Ja šī recepte nepieder ielogotajam lietotājam
            abort(403); // Aizliedz piekļuvi (403 = Forbidden)
        }

        return view('recipes.edit', compact('recipe')); // Atver recipes.edit skatu ar receptes datiem
    }

    public function update(Request $request, Recipe $recipe) // Saglabā izmaiņas receptē
    {
        if ($recipe->user_id !== Auth::id()) { // Ja recepte nepieder lietotājam
            abort(403); // Aizliedz
        }

        if ($request->has('_method') && strtolower($request->input('_method')) === 'delete') { 
            // Aizsardzība: ja forma kļūdaini sūta DELETE, tad šo bloķē
            abort(400, 'Invalid request method.'); // 400 = slikts pieprasījums
        }

        $validated = $request->validate([ // Pārbauda laukus, ko drīkst atjaunināt
            'title' => 'required|string|max:255', // Nosaukums obligāts
            'description' => 'required|string', // Apraksts obligāts
            'ingredients' => 'required|string', // Sastāvdaļas obligātas
            'instructions' => 'required|string', // Instrukcijas obligātas
            'prep_time' => 'nullable|integer|min:0', // Sagatavošanas laiks (ja ir)
            'cook_time' => 'nullable|integer|min:0', // Gatavošanas laiks (ja ir)
            'servings' => 'nullable|integer|min:1', // Porcijas (ja ir)
            'difficulty' => 'required|string|in:Viegla,Vidēja,Grūta', // Grūtība obligāta un tikai no šīm vērtībām
            'category' => 'required|string', // Kategorija obligāta
        ]);

        $recipe->update($validated); // Atjaunina recepti datubāzē ar validētajiem datiem

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recepte veiksmīgi atjaunināta!'); 
        // Aizved atpakaļ uz receptes lapu ar paziņojumu
    }

    public function destroy(Recipe $recipe) // Dzēš recepti
    {
        if ($recipe->user_id !== Auth::id() && !Auth::user()->is_admin) { 
            // Dzēst drīkst: vai nu receptes autors, vai admins
            abort(403); // Ja neviens no tiem → aizliedz
        }

        $recipe->delete(); // Dzēš recepti no datubāzes

        return redirect()->route('profile.recipes')->with('success', 'Recepte veiksmīgi dzēsta!'); 
        // Aizved uz profila recepšu sarakstu ar paziņojumu
    }

    public function userRecipes() // Parāda tikai manas receptes profilā
    {
        $recipes = Recipe::where('user_id', Auth::id()) // Paņem receptes, kur user_id ir mans ID
                        ->latest() // Jaunākās pirmās
                        ->paginate(12); // 12 vienā lapā

        return view('profile.recipes', compact('recipes')); // Atver profila recepšu lapu
    }
}
