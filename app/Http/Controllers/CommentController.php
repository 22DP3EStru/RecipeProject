<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
            'recipe_id' => ['required', 'exists:recipes,id'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ], [
            'body.required' => 'Lūdzu, ierakstiet komentāru.',
            'body.string' => 'Komentāram jābūt tekstam.',
            'body.max' => 'Komentārs nedrīkst būt garāks par 2000 rakstzīmēm.',
            'recipe_id.required' => 'Nav norādīta recepte.',
            'recipe_id.exists' => 'Norādītā recepte netika atrasta.',
            'parent_id.exists' => 'Komentārs, uz kuru vēlaties atbildēt, netika atrasts.',
        ]);

        $parent = null;

        if (!empty($data['parent_id'])) {
            $parent = Comment::findOrFail($data['parent_id']);

            if ((int) $parent->recipe_id !== (int) $data['recipe_id']) {
                return back()
                    ->withErrors([
                        'body' => 'Nevar atbildēt komentāram no citas receptes.',
                    ])
                    ->withInput();
            }
        }

        Comment::create([
            'body' => $data['body'],
            'recipe_id' => $data['recipe_id'],
            'user_id' => Auth::id(),
            'parent_id' => $parent?->id,
        ]);

        return back()->with(
            'success',
            $parent ? 'Atbilde pievienota!' : 'Komentārs pievienots!'
        );
    }
}