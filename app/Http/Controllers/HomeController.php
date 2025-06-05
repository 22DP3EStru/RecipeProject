<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class HomeController extends Controller
{
    // Mājaslapas sākumlapa
    public function index()
    {
        // Iegūst pēdējās receptes
        $recipes = Recipe::latest()->take(6)->get();

        return view('home.index', compact('recipes'));
    }

    // Atsevišķas receptes skatījums
    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);

        return view('home.show', compact('recipe'));
    }

    // Meklēšana pēc nosaukuma
    public function search(Request $request)
    {
        $query = $request->input('query');

        $recipes = Recipe::where('title', 'LIKE', '%' . $query . '%')->get();

        return view('home.search', compact('recipes', 'query'));
    }
}
