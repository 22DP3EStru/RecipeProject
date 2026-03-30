<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'ingredients',
        'instructions',
        'prep_time',
        'cook_time',
        'servings',
        'difficulty',
        'category',
        'user_id',
        'image_path',
        'video_path',
        'views',
    ];

    protected $casts = [
        'prep_time' => 'integer',
        'cook_time' => 'integer',
        'servings' => 'integer',
        'views' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ingredientsItems()
    {
        return $this->hasMany(\App\Models\RecipeIngredient::class, 'recipe_id');
    }

    public function ingredients()
    {
        return $this->ingredientsItems();
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(\App\Models\User::class, 'favorites')->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(\App\Models\RecipeReview::class)->latest();
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : null;
    }

    public function getVideoUrlAttribute()
    {
        return $this->video_path
            ? asset('storage/' . $this->video_path)
            : null;
    }
}