<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'ingredients',
        'instructions',
        'category',
        'difficulty',
        'servings',
        'prep_time',
        'cook_time',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function totalTime()
    {
        return ($this->prep_time ?? 0) + ($this->cook_time ?? 0);
    }
}
