<?php

/**
 * Comment modelis nodrošina darbu ar komentāru datiem datubāzē.
 *
 * Modelis atbild par:
 * - komentāru ierakstu glabāšanu;
 * - komentāru sasaisti ar lietotājiem;
 * - komentāru sasaisti ar receptēm;
 * - atbilžu sistēmas uzturēšanu komentāriem;
 * - komentāru relāciju definēšanu Eloquent ORM sistēmā.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * Tiek pievienota factory funkcionalitāte,
     * kas ļauj ģenerēt testa datus un izmantot model factories.
     */
    use HasFactory;

    /**
     * Lauki, kurus atļauts masveidā aizpildīt,
     * izmantojot create() vai update() metodes.
     */
    protected $fillable = [
        'body',
        'user_id',
        'recipe_id',
        'parent_id',
    ];

    /**
     * Definē saistību starp komentāru un lietotāju.
     *
     * Katrs komentārs pieder vienam lietotājam.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Definē saistību starp komentāru un recepti.
     *
     * Katrs komentārs pieder vienai receptei.
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Definē saistību starp komentāru un vecākkomentāru.
     *
     * Šī relācija tiek izmantota atbilžu sistēmai.
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Definē saistību starp komentāru un tā atbildēm.
     *
     * Vienam komentāram var būt vairākas atbildes.
     * Atbildes tiek ielādētas kopā ar lietotāju datiem
     * un sakārtotas pēc jaunākajiem ierakstiem.
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')
            ->with('user')
            ->latest();
    }
}