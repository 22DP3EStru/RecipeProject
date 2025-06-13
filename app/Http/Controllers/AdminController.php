<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        if (!Auth::user()->is_admin) {
            return redirect('/dashboard')->with('error', 'Access denied');
        }
        
        $usersCount = User::count();
        $recipesCount = Recipe::count();
        $adminsCount = User::where('is_admin', true)->count();
        $latestUsers = User::latest()->take(5)->get();
        $latestRecipes = Recipe::with('user')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('usersCount', 'recipesCount', 'adminsCount', 'latestUsers', 'latestRecipes'));
    }
    
    public function users()
    {
        if (!Auth::user()->is_admin) {
            return redirect('/dashboard')->with('error', 'Access denied');
        }
        
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users', compact('users'));
    }
    
    public function recipes()
    {
        if (!Auth::user()->is_admin) {
            return redirect('/dashboard')->with('error', 'Access denied');
        }
        
        $recipes = Recipe::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.recipes', compact('recipes'));
    }
    
    public function deleteUser(User $user)
    {
        if (!Auth::user()->is_admin) {
            return redirect('/dashboard')->with('error', 'Access denied');
        }
        
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Cannot delete your own account');
        }
        
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }
    
    public function deleteRecipe(Recipe $recipe)
    {
        if (!Auth::user()->is_admin) {
            return redirect('/dashboard')->with('error', 'Access denied');
        }
        
        $recipe->delete();
        return back()->with('success', 'Recipe deleted successfully');
    }
    
    public function toggleAdmin(User $user)
    {
        if (!Auth::user()->is_admin) {
            return redirect('/dashboard')->with('error', 'Access denied');
        }
        
        $user->is_admin = !$user->is_admin;
        $user->save();
        
        return back()->with('success', 'Admin status updated');
    }
}
