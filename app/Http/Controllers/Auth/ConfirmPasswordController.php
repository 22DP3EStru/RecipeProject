<?php // Sākas PHP kods

namespace App\Http\Controllers\Auth; // Šis kontrolieris atrodas Auth mapē

use App\Http\Controllers\Controller; // Pamata Controller klase
use Illuminate\Foundation\Auth\ConfirmsPasswords; // Trait, kas satur gatavu paroles apstiprināšanas loģiku

class ConfirmPasswordController extends Controller // Kontrolieris paroles apstiprināšanai
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | Šis ir paskaidrojošs komentārs no Laravel.
    | Tas saka, ka šis kontrolieris izmanto gatavu funkcionalitāti (trait),
    | lai apstrādātu paroles apstiprināšanu.
    |
    */

    use ConfirmsPasswords; // Iekļauj gatavo Laravel loģiku paroles apstiprināšanai

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = '/home'; 
    // Ja nav konkrētas lapas, uz kuru pārsūtīt,
    // lietotājs tiks aizvests uz /home

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() // Klases konstruktors (izpildās, kad objekts tiek izveidots)
    {
        $this->middleware('auth'); 
        // Nodrošina, ka šo kontrolieri var izmantot tikai ielogots lietotājs
    }
}
