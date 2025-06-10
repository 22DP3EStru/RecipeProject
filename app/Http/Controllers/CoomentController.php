<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class CommentController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'body' => 'required|string',
            'recipe_id' => 'required|exists:recipes,id',
        ]);
        $data['user_id'] = Auth::id();
        Comment::create($data);
        return back()->with('success', 'Komentārs pievienots!');
    }
}
