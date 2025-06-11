<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::withCount('recipes')->get();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category) {
        $recipes = Recipe::where('category_id', $category->id)
                        ->with('user', 'category')
                        ->latest()
                        ->paginate(12);
        
        return view('categories.show', compact('category', 'recipes'));
    }
}
