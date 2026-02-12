<?php // Sākas PHP kods

namespace App\Http\Controllers\Auth; // Kontrolieris atrodas Auth mapē

use App\Http\Controllers\Controller; // Pamata Controller klase
use Illuminate\Foundation\Auth\VerifiesEmails; 
// Trait, kas satur visu gatavo e-pasta verifikācijas loģiku

class VerificationController extends Controller // Kontrolieris e-pasta apstiprināšanai
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | Šis ir Laravel paskaidrojošs komentārs.
    | Tas nozīmē, ka šis kontrolieris apstrādā e-pasta apstiprināšanu
    | un ļauj atkārtoti nosūtīt verifikācijas e-pastu.
    |
    */

    use VerifiesEmails; // Iekļauj Laravel iebūvēto e-pasta verifikācijas funkcionalitāti

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home'; 
    // Pēc veiksmīgas e-pasta apstiprināšanas lietotājs tiks pārsūtīts uz /home

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() // Konstruktors (izpildās, kad tiek izveidots kontrolieris)
    {
        $this->middleware('auth'); 
        // Šo kontrolieri var izmantot tikai ielogots lietotājs

        $this->middleware('signed')->only('verify'); 
        // Verify metodei jābūt ar drošu (parakstītu) URL,
        // lai nevarētu viltot verifikācijas linku

        $this->middleware('throttle:6,1')->only('verify', 'resend'); 
        // Ierobežo pieprasījumus:
        // max 6 reizes 1 minūtē (lai novērstu spam vai uzbrukumus)
    }
}
