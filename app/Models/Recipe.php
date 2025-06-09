<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    // Nosaku, ka šie lauki ir jākasē kā JSON masīvi
    protected $casts = [
        'title'       => 'array',
        'ingredients' => 'array',
        'steps'       => 'array',
    ];

    // Piektais valodas teksts
    public function getTitleAttribute($value)
    {
        $arr = json_decode($value, true);
        return $arr[app()->getLocale()] ?? $arr['lv'] ?? '';
    }
    public function getIngredientsAttribute($value)
    {
        $arr = json_decode($value, true);
        return $arr[app()->getLocale()] ?? $arr['lv'] ?? [];
    }
    public function getStepsAttribute($value)
    {
        $arr = json_decode($value, true);
        return $arr[app()->getLocale()] ?? $arr['lv'] ?? [];
    }
}
