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
        'category',
        'image',
        'user_id',
    ];

    protected $casts = [
        'ingredients' => 'array',
        'instructions' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function avgRating()
    {
        return $this->ratings()->avg('rating') ?: 0;
    }

    public function getRatingCountAttribute()
    {
        return $this->ratings()->count();
    }
}
