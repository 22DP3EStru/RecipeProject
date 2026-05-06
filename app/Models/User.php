<?php

/**
 * User modelis nodrošina darbu ar lietotāju datiem datubāzē
 * un autentifikācijas sistēmā.
 *
 * Modelis atbild par:
 * - lietotāju datu glabāšanu;
 * - autentifikācijas funkcionalitāti;
 * - e-pasta verifikāciju;
 * - administratora statusa glabāšanu;
 * - profila attēla glabāšanu;
 * - lietotāja relācijām ar receptēm, favorītiem un komentāriem;
 * - paziņojumu nosūtīšanu lietotājiem.
 */

namespace App\Models;

use App\Notifications\CustomVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /**
     * Tiek pievienota factory funkcionalitāte
     * un Laravel paziņojumu sistēmas atbalsts.
     */
    use HasFactory, Notifiable;

    /**
     * Lauki, kurus atļauts masveidā aizpildīt,
     * izmantojot create() vai update() metodes.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'profile_photo',
    ];

    /**
     * Lauki, kuri netiek attēloti masīvos vai JSON atbildēs.
     *
     * Tas palīdz aizsargāt sensitīvus lietotāja datus.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tiek definēta automātiska datu tipu pārveidošana.
     *
     * email_verified_at tiek pārveidots datetime tipā,
     * parole automātiski tiek šifrēta,
     * savukārt is_admin tiek pārveidots boolean tipā.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Definē saistību starp lietotāju un receptēm.
     *
     * Vienam lietotājam var būt vairākas receptes.
     */
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    /**
     * Definē daudzi-preti-daudzi saistību starp lietotāju un favorītu receptēm.
     *
     * Vienam lietotājam var būt vairākas favorītu receptes.
     */
    public function favoriteRecipes()
    {
        return $this->belongsToMany(Recipe::class, 'favorites')
            ->withTimestamps();
    }

    /**
     * Definē saistību starp lietotāju un komentāriem.
     *
     * Vienam lietotājam var būt vairāki komentāri.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Nosūta lietotājam e-pasta verifikācijas paziņojumu.
     *
     * Tiek izmantota pielāgota verifikācijas paziņojuma klase.
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new CustomVerifyEmail());
    }
}