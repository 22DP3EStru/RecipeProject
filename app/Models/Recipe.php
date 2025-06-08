<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Category;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image_path',
        'prep_time',
        'cook_time',
        'servings',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $recipe): void {
            $recipe->slug = Str::slug($recipe->title);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class)->orderBy('order');
    }

    public function steps()
    {
        return $this->hasMany(Step::class)->orderBy('order');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating(): float
    {
        return round($this->ratings()->avg('rating') ?? 0, 1);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
