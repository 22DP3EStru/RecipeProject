<?php // Norāda, ka šis ir PHP fails

namespace App\Models; // Definē nosaukumvietu (namespace), kurā atrodas šis modelis

use Illuminate\Database\Eloquent\Factories\HasFactory; // Iekļauj HasFactory trait, lai varētu izmantot fabriku (factory)
use Illuminate\Database\Eloquent\Model; // Iekļauj Eloquent bāzes Model klasi

class Rating extends Model // Definē Rating modeli, kas paplašina Eloquent Model
{
    use HasFactory; // Pievieno HasFactory funkcionalitāti šim modelim

    protected $fillable = ['recipe_id', 'user_id', 'rating']; // Norāda laukus, kurus drīkst masveidā aizpildīt (mass assignment)

    public function recipe() // Definē attiecību ar Recipe modeli
    {
        return $this->belongsTo(Recipe::class); // Norāda, ka vērtējums pieder vienai receptei (many-to-one)
    }

    public function user() // Definē attiecību ar User modeli
    {
        return $this->belongsTo(User::class); // Norāda, ka vērtējums pieder vienam lietotājam (many-to-one)
    }
}

