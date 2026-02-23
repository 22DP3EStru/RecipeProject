<?php // Sākas PHP kods

namespace App\Http\Controllers\Auth; // Šis kontrolieris atrodas Auth mapē

use App\Http\Controllers\Controller; // Pamata Controller klase
use Illuminate\Foundation\Auth\AuthenticatesUsers; 
// Trait, kas satur visu gatavo login loģiku (paroles pārbaude, sesija utt.)

class LoginController extends Controller // Kontrolieris, kas atbild par login
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Šis ir Laravel paskaidrojošs komentārs.
    | Tas saka, ka kontrolieris apstrādā lietotāju autentifikāciju
    | un izmanto gatavu trait ar visu nepieciešamo funkcionalitāti.
    |
    */

    use AuthenticatesUsers; 
    // Iekļauj Laravel gatavo login funkcionalitāti

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard'; 
    // Pēc veiksmīgas login lietotājs tiks aizvests uz /dashboard

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() // Konstruktors (izpildās, kad tiek izveidots kontrolieris)
    {
        $this->middleware('guest')->except('logout');
        // Šis kontrolieris pieejams tikai neielogotiem lietotājiem
        // Izņēmums ir logout metode

        $this->middleware('auth')->only('logout');
        // Logout metodi drīkst izsaukt tikai ielogots lietotājs
    }
}
