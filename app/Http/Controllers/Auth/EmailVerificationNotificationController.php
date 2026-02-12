<?php // Sākas PHP kods

namespace App\Http\Controllers\Auth; // Šis kontrolieris atrodas Auth mapē

use App\Http\Controllers\Controller; // Pamata Controller klase
use Illuminate\Http\RedirectResponse; // Norāda, ka metode atgriezīs pāradresāciju
use Illuminate\Http\Request; // Parasts HTTP pieprasījums

class EmailVerificationNotificationController extends Controller // Kontrolieris e-pasta verifikācijas nosūtīšanai
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse // Metode, kas nosūta verifikācijas e-pastu
    {
        if ($request->user()->hasVerifiedEmail()) { 
            // Pārbauda, vai lietotājs jau ir apstiprinājis savu e-pastu

            return redirect()->intended(route('dashboard', absolute: false));
            // Ja e-pasts jau apstiprināts → pārsūta uz dashboard
        }

        $request->user()->sendEmailVerificationNotification(); 
        // Nosūta lietotājam e-pastu ar verifikācijas linku

        return back()->with('status', 'verification-link-sent'); 
        // Atgriežas atpakaļ uz iepriekšējo lapu
        // un pievieno statusa ziņu, ka links ir nosūtīts
    }
}
