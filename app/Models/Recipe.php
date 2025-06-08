<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'ingredients', 'steps', 'image', 'user_id',
    ];

    /* ---------- Relācijas ---------- */
    public function categories()  { return $this->belongsToMany(Category::class); }
    public function favorites()   { return $this->hasMany(Favorite::class); }
    public function ratings()     { return $this->hasMany(Rating::class); }   // ja vēlāk pievienosi vērtējumus
    public function author()      { return $this->belongsTo(User::class, 'user_id'); }

    /* ---------- Mutatori ---------- */
    protected static function booted()
    {
        static::creating(function ($recipe) {
            $recipe->slug = Str::slug($recipe->title) . '-' . Str::random(6);
        });
    }
}