<?php

/**
 * Recipe modelis nodrošina darbu ar recepšu datiem datubāzē.
 *
 * Modelis atbild par:
 * - recepšu informācijas glabāšanu;
 * - recepšu sasaisti ar lietotājiem;
 * - sastāvdaļu, komentāru un vērtējumu relācijām;
 * - favorītu sistēmas relācijām;
 * - datu tipu pārveidošanu;
 * - papildu aprēķināto atribūtu nodrošināšanu.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /**
     * Tiek pievienota factory funkcionalitāte,
     * kas ļauj ģenerēt testa datus un izmantot model factories.
     */
    use HasFactory;

    /**
     * Lauki, kurus atļauts masveidā aizpildīt,
     * izmantojot create() vai update() metodes.
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'instructions',
        'prep_time',
        'cook_time',
        'servings',
        'difficulty',
        'category',
        'ingredients',
        'image_path',
        'video_path',
        'views',
    ];

    /**
     * Tiek definēta automātiska datu tipu pārveidošana.
     *
     * Norādītie lauki automātiski tiek pārvērsti integer tipā.
     */
    protected $casts = [
        'prep_time' => 'integer',
        'cook_time' => 'integer',
        'servings'  => 'integer',
        'views'     => 'integer',
    ];

    /**
     * Definē saistību starp recepti un lietotāju.
     *
     * Katra recepte pieder vienam lietotājam.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Definē saistību starp recepti un sastāvdaļām.
     *
     * Vienai receptei var būt vairākas sastāvdaļas.
     */
    public function ingredientsItems()
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    /**
     * Definē saistību starp recepti un vērtējumiem.
     *
     * Vienai receptei var būt vairāki lietotāju vērtējumi.
     */
    public function reviews()
    {
        return $this->hasMany(RecipeReview::class);
    }

    /**
     * Definē saistību starp recepti un komentāriem.
     *
     * Vienai receptei var būt vairāki komentāri.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Definē daudzi-preti-daudzi saistību starp receptēm un lietotājiem,
     * kuri recepti pievienojuši favorītiem.
     */
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    /**
     * Aprēķina receptes kopējo pagatavošanas laiku.
     *
     * Kopējais laiks sastāv no sagatavošanas laika
     * un gatavošanas laika summas.
     */
    public function getTotalTimeAttribute()
    {
        return (int) ($this->prep_time ?? 0) + (int) ($this->cook_time ?? 0);
    }
}