<?php // Norāda, ka šis ir PHP fails

namespace App\Models; // Definē nosaukumvietu (namespace), kurā atrodas šis modelis

use Illuminate\Database\Eloquent\Factories\HasFactory; // Iekļauj HasFactory trait fabriku izmantošanai
use Illuminate\Database\Eloquent\Model; // Iekļauj Eloquent bāzes Model klasi

class Recipe extends Model // Definē Recipe modeli, kas paplašina Eloquent Model
{
    use HasFactory; // Pievieno HasFactory funkcionalitāti šim modelim

    protected $fillable = [ // Norāda laukus, kurus drīkst masveidā aizpildīt (mass assignment)
        'title','description','ingredients','instructions', // Pamatinformācija par recepti
        'prep_time','cook_time','servings','difficulty', // Laika un sarežģītības parametri
        'category','user_id','image_path' // Kategorija, autora ID un attēla ceļš
    ];

    protected $casts = [ // Nosaka automātisko datu tipu pārveidi (type casting)
        'prep_time' => 'integer', // Pārvērš sagatavošanas laiku par integer
        'cook_time' => 'integer', // Pārvērš gatavošanas laiku par integer
        'servings' => 'integer', // Pārvērš porciju skaitu par integer
        'created_at' => 'datetime', // Pārvērš izveides datumu par datetime objektu
        'updated_at' => 'datetime', // Pārvērš atjaunošanas datumu par datetime objektu
    ];

    public function user() // Definē attiecību ar User modeli (receptes autors)
    {
        return $this->belongsTo(User::class); // Norāda, ka recepte pieder vienam lietotājam (many-to-one)
    }

    public function favoritedByUsers() // Definē many-to-many attiecību ar lietotājiem caur favorites tabulu
    {
        return $this->belongsToMany(\App\Models\User::class, 'favorites')->withTimestamps(); // Norāda starptabulu 'favorites' un pievieno created_at/updated_at laukus pivot tabulai
    }

    public function reviews() // Definē attiecību ar RecipeReview modeli
    {
        return $this->hasMany(\App\Models\RecipeReview::class)->latest(); // Norāda, ka receptei var būt vairāki review, sakārtoti pēc jaunākā
    }

}
