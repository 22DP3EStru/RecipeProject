<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','description','ingredients','instructions',
        'prep_time','cook_time','servings','difficulty',
        'category','user_id','image_path'
    ];

    protected $casts = [
        'prep_time' => 'integer',
        'cook_time' => 'integer',
        'servings' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(\App\Models\User::class, 'favorites')->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(\App\Models\RecipeReview::class)->latest();
    }

}

