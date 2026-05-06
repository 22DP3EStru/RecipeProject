<?php

/**
 * CommentController kontrolieris nodrošina komentāru pievienošanu
 * recepšu tīmekļa vietnē.
 *
 * Kontrolieris atbild par:
 * - jauna komentāra saglabāšanu;
 * - atbildes pievienošanu esošam komentāram;
 * - komentāra datu validāciju;
 * - pārbaudi, vai atbilde tiek pievienota pareizajai receptei;
 * - komentāra sasaisti ar autentificēto lietotāju.
 */

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Saglabā jaunu komentāru vai atbildi uz esošu komentāru.
     */
    public function store(Request $request)
    {
        /**
         * Tiek validēti komentāra formas dati.
         * Komentāram jābūt aizpildītam tekstam, receptei jāeksistē datubāzē,
         * un atbildes gadījumā arī vecākkomentāram jābūt derīgam.
         */
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

        /**
         * Mainīgais tiek izmantots, lai noteiktu,
         * vai tiek veidots parasts komentārs vai atbilde uz komentāru.
         */
        $parent = null;

        /**
         * Ja forma satur parent_id vērtību, tiek meklēts komentārs,
         * uz kuru lietotājs vēlas atbildēt.
         */
        if (!empty($data['parent_id'])) {
            $parent = Comment::findOrFail($data['parent_id']);

            /**
             * Tiek pārbaudīts, vai vecākkomentārs pieder tai pašai receptei.
             * Tas novērš situāciju, kurā atbilde tiek piesaistīta komentāram
             * no citas receptes.
             */
            if ((int) $parent->recipe_id !== (int) $data['recipe_id']) {
                return back()
                    ->withErrors([
                        'body' => 'Nevar atbildēt komentāram no citas receptes.',
                    ])
                    ->withInput();
            }
        }

        /**
         * Tiek izveidots jauns komentāra ieraksts datubāzē.
         * Komentārs tiek sasaistīts ar recepti, autentificēto lietotāju
         * un, ja nepieciešams, ar vecākkomentāru.
         */
        Comment::create([
            'body' => $data['body'],
            'recipe_id' => $data['recipe_id'],
            'user_id' => Auth::id(),
            'parent_id' => $parent?->id,
        ]);

        /**
         * Pēc komentāra saglabāšanas lietotājs tiek novirzīts atpakaļ
         * ar atbilstošu veiksmīgas darbības paziņojumu.
         */
        return back()->with(
            'success',
            $parent ? 'Atbilde pievienota!' : 'Komentārs pievienots!'
        );
    }
}