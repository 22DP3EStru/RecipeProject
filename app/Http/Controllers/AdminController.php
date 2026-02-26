<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Counts (match admin/dashboard.blade.php variable names)
        $usersCount   = User::count();
        $recipesCount = Recipe::count();
        $adminsCount  = User::where('is_admin', true)->count();

        // Lists used in the dashboard
        $latestUsers   = User::latest()->take(5)->get();
        $latestRecipes = Recipe::with('user')->latest()->take(5)->get();

        // Optional: today count (if your blade shows "today recipes")
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

    // /admin/users  -> route('admin.users')
    public function users()
    {
        $users = User::latest()->paginate(15);

        return view('admin.users', compact('users'));
    }

    // /admin/recipes -> route('admin.recipes')
    public function recipes()
    {
        $recipes = Recipe::with('user')->latest()->paginate(15);

        return view('admin.recipes', compact('recipes'));
    }
}