<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'recipe_id' => 'required|exists:recipes,id',
        ]);
        $data['user_id'] = Auth::id();

        Rating::updateOrCreate(
            ['user_id' => $data['user_id'], 'recipe_id' => $data['recipe_id']],
            ['rating' => $data['rating']]
        );

        return back()->with('success', 'Vērtējums saglabāts!');
    }
}
