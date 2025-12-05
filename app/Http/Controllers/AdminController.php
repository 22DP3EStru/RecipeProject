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
            return back()->with('error', 'Nevar dzÄ“st administratora kontu!');
        }
        
        $user->delete();
        return back()->with('success', 'LietotÄjs veiksmÄ«gi dzÄ“sts!');
    }

    public function deleteRecipe(Recipe $recipe)
    {
        $recipe->delete();
        return back()->with('success', 'Recepte veiksmÄ«gi dzÄ“sta!');
    }

    public function toggleAdmin(User $user)
    {
        $user->update(['is_admin' => !$user->is_admin]);
        
        $message = $user->is_admin ? 'LietotÄjs ir padarÄ«ts par administratoru!' : 'Administratora tiesÄ«bas noÅ†emtas!';
        
        return back()->with('success', $message);
    }
}

