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
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->is_admin) {
                return redirect('/')->with('error', 'You do not have admin access.');
            }
            return $next($request);
        });
    }
    
    public function index()
    {
        $usersCount = User::count();
        $recipesCount = Recipe::count();
        $latestUsers = User::latest()->take(5)->get();
        $latestRecipes = Recipe::with('user')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('usersCount', 'recipesCount', 'latestUsers', 'latestRecipes'));
    }
    
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }
    
    public function recipes()
    {
        $recipes = Recipe::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.recipes.index', compact('recipes'));
    }
    
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
    
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'is_admin' => 'boolean'
        ]);
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->has('is_admin')
        ]);
        
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }
    
    public function deleteUser(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }
        
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
    
    public function deleteRecipe(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('admin.recipes')->with('success', 'Recipe deleted successfully.');
    }
}
