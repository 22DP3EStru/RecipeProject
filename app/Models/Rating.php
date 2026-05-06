<?php

/**
 * Rating modelis nodrošina darbu ar recepšu vērtējumu datiem datubāzē.
 *
 * Modelis atbild par:
 * - recepšu vērtējumu glabāšanu;
 * - vērtējumu sasaisti ar receptēm;
 * - vērtējumu sasaisti ar lietotājiem;
 * - lietotāju piešķirto vērtējumu apstrādi;
 * - relāciju definēšanu Eloquent ORM sistēmā.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
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
        'recipe_id',
        'user_id',
        'rating'
    ];

    /**
     * Definē saistību starp vērtējumu un recepti.
     *
     * Katrs vērtējums pieder vienai receptei.
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Definē saistību starp vērtējumu un lietotāju.
     *
     * Katrs vērtējums pieder vienam lietotājam.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}