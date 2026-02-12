<?php // Sākas PHP kods

namespace App\Http\Controllers\Auth; // Šis kontrolieris atrodas Auth mapē

use App\Http\Controllers\Controller; // Pamata Controller klase
use Illuminate\Http\RedirectResponse; // Norāda, ka var atgriezt pāradresāciju
use Illuminate\Http\Request; // HTTP pieprasījums
use Illuminate\View\View; // Norāda, ka var atgriezt skatu (lapu)

class EmailVerificationPromptController extends Controller // Kontrolieris, kas parāda e-pasta apstiprināšanas lapu
{
    /**
     * Display the email verification prompt.
     */

    public function __invoke(Request $request): RedirectResponse|View 
    // __invoke nozīmē, ka šo kontrolieri var izsaukt kā vienu funkciju
    // Tas atgriež vai nu pāradresāciju, vai skatu (lapu)
    {
        return $request->user()->hasVerifiedEmail() 
            // Pārbauda, vai lietotājs jau ir apstiprinājis savu e-pastu

                ? redirect()->intended(route('dashboard', absolute: false))
                // Ja e-pasts jau apstiprināts → pārsūta uz dashboard

                : view('auth.verify-email');
                // Ja e-pasts nav apstiprināts → parāda verify-email lapu
    }
}
