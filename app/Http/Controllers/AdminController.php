<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalRecipes = Recipe::count();
        $totalAdmins = User::where('is_admin', true)->count();
        $recentUsers = User::latest()->take(5)->get();
        $recentRecipes = Recipe::with('user')->latest()->take(5)->get();

        return view('admin.index', compact(
            'totalUsers',
            'totalRecipes', 
            'totalAdmins',
            'recentUsers',
            'recentRecipes'
        ));
    }

    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function recipes()
    {
        $recipes = Recipe::with('user')->latest()->paginate(15);
        return view('admin.recipes', compact('recipes'));
    }

    public function deleteUser(User $user)
    {
        if ($user->is_admin) {
            return back()->with('error', 'Nevar dzēst administratora kontu!');
        }
        
        $user->delete();
        return back()->with('success', 'Lietotājs veiksmīgi dzēsts!');
    }

    public function deleteRecipe(Recipe $recipe)
    {
        $recipe->delete();
        return back()->with('success', 'Recepte veiksmīgi dzēsta!');
    }

    public function toggleAdmin(User $user)
    {
        $user->update(['is_admin' => !$user->is_admin]);
        
        $message = $user->is_admin ? 'Lietotājs ir padarīts par administratoru!' : 'Administratora tiesības noņemtas!';
        
        return back()->with('success', $message);
    }
}
