<?php // Norāda, ka šis ir PHP fails

namespace App\Models; // Definē nosaukumvietu (namespace), kurā atrodas šis modelis

use Illuminate\Database\Eloquent\Factories\HasFactory; // Iekļauj HasFactory trait, lai varētu izmantot modeļa fabriku (factory)
use Illuminate\Database\Eloquent\Model; // Iekļauj bāzes Model klasi no Eloquent ORM

class Comment extends Model // Definē Comment modeli, kas paplašina Eloquent Model klasi
{
    use HasFactory; // Pievieno HasFactory funkcionalitāti šim modelim

    protected $fillable = ['body', 'user_id', 'recipe_id']; // Norāda laukus, kurus drīkst masveidā aizpildīt (mass assignment)

    public function user() { // Definē attiecību ar User modeli
        return $this->belongsTo(User::class); // Norāda, ka komentārs pieder vienam lietotājam (many-to-one)
    }

    public function recipe() { // Definē attiecību ar Recipe modeli
        return $this->belongsTo(Recipe::class); // Norāda, ka komentārs pieder vienai receptei (many-to-one)
    }
}
