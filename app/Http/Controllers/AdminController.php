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
        $usersCount   = User::count();
        $recipesCount = Recipe::count();
        $adminsCount  = User::where('is_admin', true)->count();

        $latestUsers   = User::latest()->take(5)->get();
        $latestRecipes = Recipe::with('user')->latest()->take(5)->get();

        $todayRecipesCount = Recipe::whereDate('created_at', now()->toDateString())->count();

        return view('admin.dashboard', compact(
            'usersCount',
            'recipesCount',
            'adminsCount',
            'latestUsers',
            'latestRecipes',
            'todayRecipesCount'
        ));
    }

    // ===== USERS =====

    public function users()
    {
        $users = User::with('recipes')->latest()->paginate(15);

        return view('admin.users', compact('users'));
    }

    public function destroyUser(User $user)
    {
        // drošība: nedrīkst dzēst adminu
        if ($user->is_admin) {
            return back()->with('error', 'Admin lietotāju nevar dzēst.');
        }

        // dzēš arī lietotāja receptes (ja vajag)
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
        $recipes = Recipe::with('user')->latest()->paginate(15);

        return view('admin.recipes', compact('recipes'));
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