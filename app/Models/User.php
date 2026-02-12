<?php // Norāda, ka šis ir PHP fails

namespace App\Models; // Definē nosaukumvietu (namespace), kurā atrodas šis modelis

use Illuminate\Database\Eloquent\Factories\HasFactory; // Iekļauj HasFactory trait fabriku izmantošanai
use Illuminate\Foundation\Auth\User as Authenticatable; // Iekļauj autentificējamu lietotāja bāzes klasi
use Illuminate\Notifications\Notifiable; // Iekļauj Notifiable trait paziņojumu (notifications) atbalstam

class User extends Authenticatable // Definē User modeli, kas paplašina Authenticatable klasi (paredzēts autentifikācijai)
{
    use HasFactory, Notifiable; // Pievieno fabriku un paziņojumu funkcionalitāti

    protected $fillable = [ // Norāda laukus, kurus drīkst masveidā aizpildīt (mass assignment)
        'name', // Lietotāja vārds
        'email', // Lietotāja e-pasts
        'password', // Lietotāja parole
        'is_admin', // Norāda, vai lietotājs ir administrators
    ];

    protected $hidden = [ // Norāda laukus, kas netiks iekļauti serializācijā (piem., JSON atbildēs)
        'password', // Slēpj paroli
        'remember_token', // Slēpj atcerēšanās tokenu
    ];

    protected function casts(): array // Definē automātisko datu tipu pārveidi (type casting)
    {
        return [
            'email_verified_at' => 'datetime', // Pārvērš e-pasta apstiprināšanas laiku par datetime objektu
            'password' => 'hashed', // Automātiski hešo paroli saglabāšanas brīdī
            'is_admin' => 'boolean', // Pārvērš is_admin lauku par boolean tipu
        ];
    }

    public function recipes() // Definē attiecību ar Recipe modeli
    {
        return $this->hasMany(Recipe::class); // Norāda, ka lietotājam var būt vairākas receptes (one-to-many)
    }

    public function favoriteRecipes() // Definē many-to-many attiecību ar Recipe modeli caur favorites tabulu
    {
        return $this->belongsToMany(\App\Models\Recipe::class, 'favorites')->withTimestamps(); // Norāda starptabulu 'favorites' un pievieno timestamp laukus pivot tabulai
    }
}

