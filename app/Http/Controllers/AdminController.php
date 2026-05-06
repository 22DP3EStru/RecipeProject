<?php

/**
 * AdminController kontrolieris nodrošina administratora funkcionalitāti
 * recepšu tīmekļa vietnē.
 *
 * Kontrolieris atbild par:
 * - administratora paneļa attēlošanu;
 * - lietotāju pārvaldību;
 * - recepšu pārvaldību;
 * - sistēmas statistikas apkopošanu;
 * - lietotāju administratora statusa maiņu;
 * - lietotāju un recepšu dzēšanu.
 *
 * Kontrolieris izmanto Laravel autentifikācijas mehānismu,
 * lai administrācijas sadaļai piekļūtu tikai autorizēti lietotāji.
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Konstruktors nosaka, ka administrācijas sadaļai
     * var piekļūt tikai autentificēti lietotāji.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Attēlo administratora informācijas paneli ar kopējo sistēmas statistiku,
     * jaunākajiem lietotājiem, jaunākajām receptēm un populārākajām receptēm.
     */
    public function index()
    {
        /**
         * Tiek iegūti galvenie sistēmas statistikas dati:
         * lietotāju skaits, recepšu skaits un administratoru skaits.
         */
        $usersCount = User::count();
        $recipesCount = Recipe::count();
        $adminsCount = User::where('is_admin', true)->count();

        /**
         * Tiek atlasīti jaunākie lietotāji un jaunākās receptes,
         * lai administratora panelī parādītu pēdējās aktivitātes.
         */
        $latestUsers = User::latest()->take(5)->get();
        $latestRecipes = Recipe::with('user')->latest()->take(5)->get();

        /**
         * Tiek aprēķināta papildu statistika par šodien pievienotajām receptēm,
         * jaunajiem lietotājiem, jaunajām receptēm un aktīvajiem autoriem.
         */
        $todayRecipesCount = Recipe::whereDate('created_at', now()->toDateString())->count();
        $newUsersThisWeekCount = User::where('created_at', '>=', now()->subDays(7))->count();
        $newRecipesThisWeekCount = Recipe::where('created_at', '>=', now()->subDays(7))->count();
        $activeAuthorsCount = User::has('recipes')->count();

        /**
         * Tiek noteikts unikālo kategoriju skaits,
         * neiekļaujot tukšas vai nenorādītas kategorijas.
         */
        $categoriesCount = Recipe::whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->count('category');

        /**
         * Tiek saskaitītas receptes, kurām nav pievienots attēls.
         */
        $recipesWithoutImageCount = Recipe::where(function ($query) {
            $query->whereNull('image_path')
                  ->orWhere('image_path', '');
        })->count();

        /**
         * Tiek saskaitītas receptes, kurām nav norādīta kategorija.
         */
        $recipesWithoutCategoryCount = Recipe::where(function ($query) {
            $query->whereNull('category')
                  ->orWhere('category', '');
        })->count();

        /**
         * Tiek atlasītas piecas populārākās receptes pēc skatījumu skaita.
         */
        $topRecipes = Recipe::with('user')
            ->orderByDesc('views')
            ->take(5)
            ->get();

        /**
         * Visi iegūtie dati tiek nodoti administratora informācijas paneļa skatam.
         */
        return view('admin.dashboard', compact(
            'usersCount',
            'recipesCount',
            'adminsCount',
            'latestUsers',
            'latestRecipes',
            'todayRecipesCount',
            'newUsersThisWeekCount',
            'newRecipesThisWeekCount',
            'activeAuthorsCount',
            'categoriesCount',
            'recipesWithoutImageCount',
            'recipesWithoutCategoryCount',
            'topRecipes'
        ));
    }

    /**
     * Attēlo lietotāju pārvaldības sadaļu.
     */
    public function users()
    {
        /**
         * Tiek iegūts lietotāju saraksts kopā ar viņu receptēm.
         * Rezultāti tiek sakārtoti pēc jaunākajiem ierakstiem un sadalīti lapās.
         */
        $users = User::with('recipes')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        /**
         * Tiek aprēķināta lietotāju statistika:
         * kopējais lietotāju skaits, administratoru skaits,
         * parasto lietotāju skaits un jaunie lietotāji pēdējo septiņu dienu laikā.
         */
        $usersCount = User::count();
        $adminsCount = User::where('is_admin', true)->count();
        $regularUsersCount = User::where('is_admin', false)->count();
        $newUsersThisWeekCount = User::where('created_at', '>=', now()->subDays(7))->count();

        /**
         * Lietotāju dati un statistika tiek nodota administratora lietotāju skatam.
         */
        return view('admin.users', compact(
            'users',
            'usersCount',
            'adminsCount',
            'regularUsersCount',
            'newUsersThisWeekCount'
        ));
    }

    /**
     * Dzēš konkrētu lietotāju un visas ar viņu saistītās receptes.
     */
    public function destroyUser(User $user)
    {
        /**
         * Drošības nolūkos administratora lietotāju dzēšana nav atļauta.
         */
        if ($user->is_admin) {
            return back()->with('error', 'Admin lietotāju nevar dzēst.');
        }

        /**
         * Pirms lietotāja dzēšanas tiek dzēstas visas viņa receptes,
         * kā arī ar receptēm saistītie attēli, video un sastāvdaļu ieraksti.
         */
        foreach ($user->recipes as $recipe) {
            if ($recipe->image_path) {
                Storage::disk('public')->delete($recipe->image_path);
            }

            if ($recipe->video_path) {
                Storage::disk('public')->delete($recipe->video_path);
            }

            $recipe->ingredientsItems()->delete();
            $recipe->delete();
        }

        /**
         * Pēc saistīto datu dzēšanas tiek dzēsts pats lietotājs.
         */
        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('success', 'Lietotājs veiksmīgi dzēsts!');
    }

    /**
     * Maina lietotāja administratora statusu.
     */
    public function toggleAdmin(User $user)
    {
        /**
         * Lietotājs nedrīkst mainīt savu administratora statusu,
         * lai netiktu nejauši zaudēta piekļuve administrācijas sadaļai.
         */
        if ($user->id === Auth::user()->id) {
            return back()->with('error', 'Jūs nevarat mainīt savu admin statusu.');
        }

        /**
         * Administratora statuss tiek pārslēgts uz pretējo vērtību.
         */
        $user->is_admin = !$user->is_admin;
        $user->save();

        return back()->with('success', 'Lietotāja statuss veiksmīgi atjaunināts.');
    }

    /**
     * Attēlo recepšu pārvaldības sadaļu administratoram.
     */
    public function recipes()
    {
        /**
         * Tiek iegūts recepšu saraksts kopā ar receptes autoru.
         * Receptes tiek sakārtotas pēc jaunākajiem ierakstiem un sadalītas lapās.
         */
        $recipes = Recipe::with('user')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        /**
         * Tiek aprēķināta recepšu sadaļas statistika:
         * kopējais recepšu skaits, kategoriju skaits,
         * jauno recepšu skaits un aktīvo autoru skaits.
         */
        $recipesCount = Recipe::count();

        $categoriesCount = Recipe::whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->count('category');

        $newRecipesThisWeekCount = Recipe::where('created_at', '>=', now()->subDays(7))->count();
        $activeAuthorsCount = User::has('recipes')->count();

        /**
         * Recepšu dati un statistika tiek nodota administratora recepšu skatam.
         */
        return view('admin.recipes', compact(
            'recipes',
            'recipesCount',
            'categoriesCount',
            'newRecipesThisWeekCount',
            'activeAuthorsCount'
        ));
    }

    /**
     * Dzēš konkrētu recepti un ar to saistītos failus.
     */
    public function destroyRecipe(Recipe $recipe)
    {
        /**
         * Ja receptei ir pievienots attēls, tas tiek dzēsts no publiskās glabātuves.
         */
        if ($recipe->image_path) {
            Storage::disk('public')->delete($recipe->image_path);
        }

        /**
         * Ja receptei ir pievienots video, tas tiek dzēsts no publiskās glabātuves.
         */
        if ($recipe->video_path) {
            Storage::disk('public')->delete($recipe->video_path);
        }

        /**
         * Pirms receptes dzēšanas tiek dzēsti ar recepti saistītie sastāvdaļu ieraksti.
         */
        $recipe->ingredientsItems()->delete();
        $recipe->delete();

        return redirect()
            ->route('admin.recipes')
            ->with('success', 'Recepte veiksmīgi dzēsta!');
    }
}