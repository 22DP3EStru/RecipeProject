<?php // Sākas PHP kods

namespace App\Http\Controllers\Auth; // Kontrolieris atrodas Auth mapē

use App\Http\Controllers\Controller; // Pamata Controller klase
use Illuminate\Auth\Events\Verified; // Notikums, kas tiek izsaukts pēc veiksmīgas e-pasta apstiprināšanas
use Illuminate\Foundation\Auth\EmailVerificationRequest; 
// Speciāls pieprasījums e-pasta verifikācijai (pārbauda parakstu un drošību)
use Illuminate\Http\RedirectResponse; // Metode atgriezīs pāradresāciju

class VerifyEmailController extends Controller // Kontrolieris e-pasta apstiprināšanai
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse 
    // __invoke nozīmē, ka šim kontrolierim ir tikai viena darbība
    {
        if ($request->user()->hasVerifiedEmail()) { 
        // Pārbauda, vai lietotāja e-pasts jau ir apstiprināts

            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
            // Ja jau apstiprināts → pārsūta uz dashboard ar parametru verified=1
        }

        if ($request->user()->markEmailAsVerified()) { 
        // Ja vēl nav apstiprināts → mēģina atzīmēt e-pastu kā apstiprinātu datubāzē

            event(new Verified($request->user())); 
            // Izsauc notikumu, ka e-pasts ir apstiprināts
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        // Pēc apstiprināšanas pārsūta uz dashboard ar parametru verified=1
    }
}
