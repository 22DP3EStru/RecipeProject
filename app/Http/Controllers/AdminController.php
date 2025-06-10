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
    }

    public function index() {
        abort_unless(Auth::user()->is_admin, 403);
        return view('admin.index');
    }

    public function deleteUser(User $user) {
        abort_unless(Auth::user()->is_admin, 403);
        if (!$user->is_admin) {
            $user->delete();
        }
        return back()->with('success', 'Lietotājs izdzēsts.');
    }

    public function deleteRecipe(Recipe $recipe) {
        abort_unless(Auth::user()->is_admin, 403);
        $recipe->delete();
        return back()->with('success', 'Recepte izdzēsta.');
    }
}
