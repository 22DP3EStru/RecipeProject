<?php

/**
 * Category modelis nodrošina darbu ar recepšu kategoriju datiem datubāzē.
 *
 * Modelis atbild par:
 * - kategoriju datu glabāšanu;
 * - kategoriju nosaukumu un slug vērtību apstrādi;
 * - saistības uzturēšanu starp kategorijām un receptēm;
 * - kategoriju ierakstu izmantošanu Eloquent ORM sistēmā.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
        'name',
        'slug'
    ];

    /**
     * Definē saistību starp kategoriju un receptēm.
     *
     * Vienai kategorijai var būt vairākas receptes.
     */
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}