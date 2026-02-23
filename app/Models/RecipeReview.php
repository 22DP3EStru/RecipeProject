<?php // Norāda, ka šis ir PHP fails

namespace App\Models; // Definē nosaukumvietu (namespace), kurā atrodas šis modelis

use Illuminate\Database\Eloquent\Model; // Iekļauj Eloquent bāzes Model klasi

class RecipeReview extends Model // Definē RecipeReview modeli, kas paplašina Eloquent Model
{
    protected $fillable = ['recipe_id', 'user_id', 'rating', 'comment']; // Norāda laukus, kurus drīkst masveidā aizpildīt (mass assignment)

    public function recipe() // Definē attiecību ar Recipe modeli
    {
        return $this->belongsTo(Recipe::class); // Norāda, ka atsauksme pieder vienai receptei (many-to-one)
    }

    public function user() // Definē attiecību ar User modeli
    {
        return $this->belongsTo(User::class); // Norāda, ka atsauksme pieder vienam lietotājam (many-to-one)
    }
}
