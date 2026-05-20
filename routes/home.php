<?php

/*
|--------------------------------------------------------------------------
| Tīmekļa maršruti
|--------------------------------------------------------------------------
|
| Šajā failā tiek definēti galvenie publiskie maršruti recepšu vietnei.
| Maršruti nosaka, kura adrese atver konkrētu kontrolieri vai skatu.
|
*/

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Sākumlapa
|--------------------------------------------------------------------------
|
| Galvenā sākumlapa izmanto WelcomeController, lai parādītu publisko
| ievada lapu ar platformas informāciju un jaunāko saturu.
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Recepšu maršruti
|--------------------------------------------------------------------------
|
| Šie maršruti ļauj lietotājiem pārlūkot visas receptes un atvērt
| konkrētas receptes detalizēto skatu.
|
*/

// Parāda visu recepšu sarakstu.
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');

// Parāda vienas konkrētas receptes lapu.
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

/*
|--------------------------------------------------------------------------
| Kategoriju maršruti
|--------------------------------------------------------------------------
|
| Šie maršruti paredzēti recepšu pārlūkošanai pēc kategorijām.
|
*/

// Parāda visu pieejamo kategoriju sarakstu.
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Parāda konkrētas kategorijas receptes.
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

/*
|--------------------------------------------------------------------------
| Meklēšana
|--------------------------------------------------------------------------
|
| Meklēšanas maršruts ļauj lietotājam atrast receptes pēc ievadītajiem
| meklēšanas parametriem.
|
*/

// Apstrādā recepšu meklēšanas pieprasījumu.
Route::get('/search', [RecipeController::class, 'search'])->name('recipes.search');

/*
|--------------------------------------------------------------------------
| Vecie testa maršruti
|--------------------------------------------------------------------------
|
| Zemāk esošie maršruti dublē jau definētos sākumlapas un recepšu
| maršrutus. Ja projektā tiek izmantoti kontrolieri, šos dublikātus
| labāk dzēst, lai nerastos neskaidrības par to, kurš maršruts tiek lietots.
|
*/

// Dublē sākumlapas maršrutu un tieši atgriež welcome skatu.
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dublē recepšu saraksta maršrutu un tieši iegūst receptes no modeļa.
Route::get('/recipes', function () {
    $recipes = App\Models\Recipe::with('user')->latest()->paginate(12);
    return view('recipes.index', compact('recipes'));
})->name('recipes.index');