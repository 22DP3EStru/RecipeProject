<?php

/*
|--------------------------------------------------------------------------
| Tīmekļa maršruti
|--------------------------------------------------------------------------
|
| Šajā failā tiek definēti visi galvenie tīmekļa maršruti.
| Katrs maršruts nosaka, kura adrese izsauc konkrētu kontrolieri,
| skatu vai darbību lietotāja pieprasījuma apstrādei.
|
*/

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Publiskās lapas
|--------------------------------------------------------------------------
|
| Šīs lapas ir pieejamas visiem apmeklētājiem, arī bez pieslēgšanās.
| Tajās ietilpst sākumlapa, kontaktu lapa un pāradresācija no /home.
|
*/

// Parāda sākumlapas skatu.
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Parāda kontaktu lapu.
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// /home adrese tiek pāradresēta uz lietotāja vadības paneli.
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');

/*
|--------------------------------------------------------------------------
| Vadības panelis
|--------------------------------------------------------------------------
|
| Vadības panelis ir pieejams tikai pieslēgtiem lietotājiem.
| Tajā lietotājs redz savu statistiku, ātrās darbības un savas receptes.
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Publiskā recepšu pārlūkošana
|--------------------------------------------------------------------------
|
| Recepšu saraksts ir publiski pieejams, lai apmeklētāji varētu
| apskatīt receptes arī bez lietotāja konta.
|
*/

// Parāda visu recepšu sarakstu.
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');

/*
|--------------------------------------------------------------------------
| Receptes PDF un drukas skati
|--------------------------------------------------------------------------
|
| Šie maršruti pieejami tikai pieslēgtiem lietotājiem.
| Tie ļauj lejupielādēt recepti PDF formātā vai atvērt drukai piemērotu skatu.
|
*/

Route::middleware(['auth'])->group(function () {
    // Lejupielādē konkrētas receptes PDF failu.
    Route::get('/recipes/{recipe}/pdf', [RecipeController::class, 'downloadPdf'])
        ->name('recipes.pdf');

    // Parāda receptes drukas versiju.
    Route::get('/recipes/{recipe}/print', [RecipeController::class, 'printView'])
        ->name('recipes.print');
});

/*
|--------------------------------------------------------------------------
| Pieslēgta lietotāja maršruti
|--------------------------------------------------------------------------
|
| Šajā grupā atrodas maršruti, kuriem nepieciešama autorizācija.
| Tie saistīti ar kategorijām, profilu, recepšu pārvaldību, komentāriem,
| favorītiem, vērtējumiem un administrācijas funkcijām.
|
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Kategorijas
    |--------------------------------------------------------------------------
    |
    | Kategoriju sadaļa ļauj pieslēgtiem lietotājiem apskatīt kategoriju
    | sarakstu un atvērt konkrētas kategorijas receptes.
    |
    */

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    /*
    |--------------------------------------------------------------------------
    | Profils
    |--------------------------------------------------------------------------
    |
    | Profila maršruti paredzēti lietotāja datu apskatei, labošanai,
    | paroles maiņai, konta dzēšanai un lietotāja recepšu skatīšanai.
    |
    */

    // Atver profila rediģēšanas lapu.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Saglabā profila informācijas izmaiņas.
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Dzēš lietotāja profilu.
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Atjaunina lietotāja paroli.
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    // Parāda pašreizējā lietotāja izveidotās receptes.
    Route::get('/profile/recipes', [RecipeController::class, 'userRecipes'])->name('profile.recipes');

    /*
    |--------------------------------------------------------------------------
    | Recepšu pārvaldība
    |--------------------------------------------------------------------------
    |
    | Receptes izveide, labošana un dzēšana ir pieejama tikai verificētiem
    | lietotājiem, lai ierobežotu nepārbaudītu kontu darbības.
    |
    */

    // Atver jaunas receptes izveides formu.
    Route::get('/recipes/create', [RecipeController::class, 'create'])
        ->middleware('verified')
        ->name('recipes.create');

    // Saglabā jaunu recepti datubāzē.
    Route::post('/recipes', [RecipeController::class, 'store'])
        ->middleware('verified')
        ->name('recipes.store');

    // Atver esošas receptes rediģēšanas formu.
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])
        ->middleware('verified')
        ->name('recipes.edit');

    // Saglabā visas receptes izmaiņas.
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])
        ->middleware('verified')
        ->name('recipes.update');

    // Saglabā daļējas receptes izmaiņas.
    Route::patch('/recipes/{recipe}', [RecipeController::class, 'update'])
        ->middleware('verified')
        ->name('recipes.patch');

    // Dzēš konkrētu recepti.
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])
        ->middleware('verified')
        ->name('recipes.destroy');

    /*
    |--------------------------------------------------------------------------
    | Komentāri
    |--------------------------------------------------------------------------
    |
    | Komentārus var pievienot tikai verificēti lietotāji.
    | Tas attiecas gan uz galvenajiem komentāriem, gan atbildēm.
    |
    */

    Route::post('/comments', [CommentController::class, 'store'])
        ->middleware('verified')
        ->name('comments.store');

    /*
    |--------------------------------------------------------------------------
    | Favorīti
    |--------------------------------------------------------------------------
    |
    | Favorītu maršruti ļauj lietotājam saglabāt receptes un vēlāk
    | apskatīt tās savā favorītu sarakstā.
    |
    */

    // Pievieno vai noņem recepti no favorītiem.
    Route::post('/recipes/{recipe}/favorite', [FavoriteController::class, 'toggle'])
        ->middleware('verified')
        ->name('recipes.favorite.toggle');

    // Parāda lietotāja favorītu sarakstu.
    Route::get('/profile/favorites', [FavoriteController::class, 'index'])
        ->middleware('verified')
        ->name('profile.favorites');

    /*
    |--------------------------------------------------------------------------
    | Vērtējumi
    |--------------------------------------------------------------------------
    |
    | Vērtējumu maršruti ļauj lietotājam pievienot vai dzēst savu
    | vērtējumu konkrētai receptei.
    |
    */

    // Saglabā vai atjaunina lietotāja vērtējumu receptei.
    Route::post('/recipes/{recipe}/reviews', [RecipeReviewController::class, 'store'])
        ->middleware('verified')
        ->name('recipes.reviews.store');

    // Dzēš lietotāja vērtējumu receptei.
    Route::delete('/recipes/{recipe}/reviews', [RecipeReviewController::class, 'destroy'])
        ->middleware('verified')
        ->name('recipes.reviews.destroy');

    /*
    |--------------------------------------------------------------------------
    | Administrācija
    |--------------------------------------------------------------------------
    |
    | Administrācijas maršruti ir pieejami tikai lietotājiem ar admin tiesībām.
    | Šeit var pārvaldīt lietotājus, receptes un administrācijas paneli.
    |
    */

    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        // Atver administrācijas sākumlapu.
        Route::get('/', [AdminController::class, 'index'])->name('index');

        // Parāda lietotāju pārvaldības lapu.
        Route::get('/users', [AdminController::class, 'users'])->name('users');

        // Ieslēdz vai izslēdz administratora tiesības konkrētam lietotājam.
        Route::patch('/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('users.toggle-admin');

        // Dzēš konkrētu lietotāju.
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

        // Parāda recepšu pārvaldības lapu.
        Route::get('/recipes', [AdminController::class, 'recipes'])->name('recipes');

        // Dzēš konkrētu recepti administrācijas sadaļā.
        Route::delete('/recipes/{recipe}', [AdminController::class, 'destroyRecipe'])->name('recipes.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Receptes detalizētais skats
|--------------------------------------------------------------------------
|
| Šim maršrutam jāatrodas pēc create, edit un citiem specifiskākiem
| recepšu maršrutiem, lai Laravel nepārprastu šīs adreses kā receptes ID.
|
*/

// Parāda vienas konkrētas receptes detalizēto lapu.
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

/*
|--------------------------------------------------------------------------
| PDF maršruti
|--------------------------------------------------------------------------
|
| Šajā sadaļā apkopoti visi PDF eksporta maršruti.
| Tie sagatavo pilnas receptes, sastāvdaļu, soļu, kategoriju,
| lietotāja profila un statistikas PDF dokumentus.
|
*/

Route::prefix('pdf')->name('pdf.')->group(function () {
    // Izveido pilnu receptes PDF.
    Route::get('/recipe/{recipe}/full', [PdfController::class, 'recipeFull'])->name('recipe.full');

    // Izveido tikai receptes sastāvdaļu PDF.
    Route::get('/recipe/{recipe}/ingredients', [PdfController::class, 'recipeIngredients'])->name('recipe.ingredients');

    // Izveido tikai receptes pagatavošanas soļu PDF.
    Route::get('/recipe/{recipe}/steps', [PdfController::class, 'recipeSteps'])->name('recipe.steps');

    // Izveido konkrētas kategorijas recepšu PDF pēc kategorijas nosaukuma.
    Route::get('/category-name/{categoryName}/recipes', [PdfController::class, 'categoryRecipesByName'])
        ->name('category.recipes.byname');

    // Izveido lietotāja profila PDF.
    Route::get('/user/{user}/profile', [PdfController::class, 'userProfile'])->name('user.profile');

    // Izveido populārāko recepšu PDF.
    Route::get('/popular-recipes', [PdfController::class, 'popularRecipes'])->name('popular.recipes');

    // Izveido administrācijas statistikas PDF.
    Route::get('/admin-statistics', [PdfController::class, 'adminStatistics'])->name('admin.statistics');

    // Izveido filtrēto recepšu rezultātu PDF.
    Route::get('/filtered-recipes', [PdfController::class, 'filteredRecipes'])->name('filtered.recipes');
});

/*
|--------------------------------------------------------------------------
| Autentifikācijas maršruti
|--------------------------------------------------------------------------
|
| Šeit tiek pieslēgti Laravel autentifikācijas maršruti, piemēram,
| pieslēgšanās, reģistrācija, paroles atjaunošana un e-pasta verifikācija.
|
*/

require __DIR__ . '/auth.php';