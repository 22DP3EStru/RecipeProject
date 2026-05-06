<?php

/**
 * RecipeIngredient modelis nodrošina darbu ar recepšu sastāvdaļu datiem datubāzē.
 *
 * Modelis atbild par:
 * - receptes sastāvdaļu glabāšanu;
 * - sastāvdaļu sasaisti ar receptēm;
 * - sastāvdaļu daudzuma un mērvienību apstrādi;
 * - datu tipu pārveidošanu;
 * - relāciju definēšanu Eloquent ORM sistēmā.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    /**
     * Tiek pievienota factory funkcionalitāte,
     * kas ļauj ģenerēt testa datus un izmantot model factories.
     */
    use HasFactory;

    /**
     * Tiek definēts datubāzes tabulas nosaukums,
     * kuru izmanto šis modelis.
     */
    protected $table = 'recipe_ingredients';

    /**
     * Lauki, kurus atļauts masveidā aizpildīt,
     * izmantojot create() vai update() metodes.
     */
    protected $fillable = [
        'recipe_id',
        'name',
        'quantity',
        'unit',
    ];

    /**
     * Tiek definēta automātiska datu tipu pārveidošana.
     *
     * quantity lauks automātiski tiek pārveidots float tipā.
     */
    protected $casts = [
        'quantity' => 'float',
    ];

    /**
     * Definē saistību starp sastāvdaļu un recepti.
     *
     * Katra sastāvdaļa pieder vienai receptei.
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}