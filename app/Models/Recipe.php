<?php // Norāda, ka šis ir PHP fails

namespace App\Models; // Definē nosaukumvietu (namespace), kurā atrodas šis modelis

use Illuminate\Database\Eloquent\Factories\HasFactory; // Iekļauj HasFactory trait fabriku izmantošanai
use Illuminate\Database\Eloquent\Model; // Iekļauj Eloquent bāzes Model klasi

class Recipe extends Model // Definē Recipe modeli, kas paplašina Eloquent Model
{
    use HasFactory; // Pievieno HasFactory funkcionalitāti šim modelim

    protected $fillable = [ // Norāda laukus, kurus drīkst masveidā aizpildīt (mass assignment)
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

        // ✅ MEDIA (JAUNIE LAUKI)
        'image_path',
        'image_url',
        'video_path',
        'video_url',
    ];

    protected $casts = [ // Nosaka automātisko datu tipu pārveidi (type casting)
        'prep_time' => 'integer',
        'cook_time' => 'integer',
        'servings' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user() // Definē attiecību ar User modeli (receptes autors)
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

    public function favoritedByUsers() // Definē many-to-many attiecību ar lietotājiem caur favorites tabulu
    {
        return $this->belongsToMany(\App\Models\User::class, 'favorites')->withTimestamps();
    }

    public function reviews() // Definē attiecību ar RecipeReview modeli
    {
        return $this->hasMany(\App\Models\RecipeReview::class)->latest();
    }

    /*
    |--------------------------------------------------------------------------
    | MEDIA HELPER METHODS (optional but useful)
    |--------------------------------------------------------------------------
    */

    public function getImageUrlAttribute()
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : null;
    }

    public function getVideoUrlAttribute()
    {
        if ($this->video_path) {
            return asset('storage/' . $this->video_path);
        }

        return $this->attributes['video_url'] ?? null;
    }
}