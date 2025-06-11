<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }    public function index() {
        $users = User::latest()->take(10)->get();
        $recipes = Recipe::latest()->take(10)->get();
        $userCount = User::count();
        $recipeCount = Recipe::count();
        
        return view('admin.dashboard', compact('users', 'recipes', 'userCount', 'recipeCount'));
    }

    public function deleteUser(User $user) {
        if (!$user->is_admin) {
            $user->delete();
        }
        return back()->with('success', 'Lietotājs izdzēsts.');
    }

    public function deleteRecipe(Recipe $recipe) {
        $recipe->delete();
        return back()->with('success', 'Recepte izdzēsta.');
    }
}
