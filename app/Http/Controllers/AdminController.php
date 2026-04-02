<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        // tikai adminiem pieeja
        $this->middleware('auth');
    }

    public function index()
    {
        $usersCount = User::count();
        $recipesCount = Recipe::count();
        $adminsCount = User::where('is_admin', true)->count();

        $latestUsers = User::latest()->take(5)->get();
        $latestRecipes = Recipe::with('user')->latest()->take(5)->get();

        $todayRecipesCount = Recipe::whereDate('created_at', now()->toDateString())->count();
        $newUsersThisWeekCount = User::where('created_at', '>=', now()->subDays(7))->count();
        $newRecipesThisWeekCount = Recipe::where('created_at', '>=', now()->subDays(7))->count();
        $activeAuthorsCount = User::has('recipes')->count();

        $categoriesCount = Recipe::whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->count('category');

        $recipesWithoutImageCount = Recipe::where(function ($query) {
            $query->whereNull('image_path')
                  ->orWhere('image_path', '');
        })->count();

        $recipesWithoutCategoryCount = Recipe::where(function ($query) {
            $query->whereNull('category')
                  ->orWhere('category', '');
        })->count();

        $topRecipes = Recipe::with('user')
            ->orderByDesc('views')
            ->take(5)
            ->get();

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

    // ===== USERS =====

    public function users()
    {
        $users = User::with('recipes')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $usersCount = User::count();
        $adminsCount = User::where('is_admin', true)->count();
        $regularUsersCount = User::where('is_admin', false)->count();
        $newUsersThisWeekCount = User::where('created_at', '>=', now()->subDays(7))->count();

        return view('admin.users', compact(
            'users',
            'usersCount',
            'adminsCount',
            'regularUsersCount',
            'newUsersThisWeekCount'
        ));
    }

    public function destroyUser(User $user)
    {
        // drošība: nedrīkst dzēst adminu
        if ($user->is_admin) {
            return back()->with('error', 'Admin lietotāju nevar dzēst.');
        }

        // dzēš arī lietotāja receptes
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

        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('success', 'Lietotājs veiksmīgi dzēsts!');
    }

    public function toggleAdmin(User $user)
    {
        // nevar noņemt sev admin
        if ($user->id === Auth::user()->id) {
            return back()->with('error', 'Jūs nevarat mainīt savu admin statusu.');
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        return back()->with('success', 'Lietotāja statuss veiksmīgi atjaunināts.');
    }

    // ===== RECIPES =====

    public function recipes()
    {
        $recipes = Recipe::with('user')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $recipesCount = Recipe::count();
        $categoriesCount = Recipe::whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->count('category');
        $newRecipesThisWeekCount = Recipe::where('created_at', '>=', now()->subDays(7))->count();
        $activeAuthorsCount = User::has('recipes')->count();

        return view('admin.recipes', compact(
            'recipes',
            'recipesCount',
            'categoriesCount',
            'newRecipesThisWeekCount',
            'activeAuthorsCount'
        ));
    }

    public function destroyRecipe(Recipe $recipe)
    {
        if ($recipe->image_path) {
            Storage::disk('public')->delete($recipe->image_path);
        }

        if ($recipe->video_path) {
            Storage::disk('public')->delete($recipe->video_path);
        }

        $recipe->ingredientsItems()->delete();
        $recipe->delete();

        return redirect()
            ->route('admin.recipes')
            ->with('success', 'Recepte veiksmīgi dzēsta!');
    }
}