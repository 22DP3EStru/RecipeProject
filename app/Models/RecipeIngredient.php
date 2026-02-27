<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    protected $fillable = [
        'recipe_id',
        'name',
        'quantity',
        'unit'
    ];

    public function recipe()
    {
        return $this->belongsTo(\App\Models\Recipe::class);
    }
}