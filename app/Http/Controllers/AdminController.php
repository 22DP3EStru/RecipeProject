<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;

class AdminController extends Controller
{
    public function index()
    {
        // Counts (match admin/dashboard.blade.php variable names)
        $usersCount   = User::count();
        $recipesCount = Recipe::count();
        $adminsCount  = User::where("is_admin", true)->count();

        // Lists used in the dashboard
        $latestUsers   = User::latest()->take(5)->get();
        $latestRecipes = Recipe::with("user")->latest()->take(5)->get();

        // Optional: today count (if your blade shows "today recipes")
        $todayRecipesCount = Recipe::whereDate("created_at", now()->toDateString())->count();

        return view("admin.dashboard", compact(
            "usersCount",
            "recipesCount",
            "adminsCount",
            "latestUsers",
            "latestRecipes",
            "todayRecipesCount"
        ));
    }
}
