<?php // Sākas PHP kods

namespace App\Http\Controllers\Auth; // Šis kontrolieris atrodas Auth mapē

use App\Http\Controllers\Controller; // Pamata Controller klase
use Illuminate\Http\RedirectResponse; // Norāda, ka metode atgriezīs pāradresāciju
use Illuminate\Http\Request; // HTTP pieprasījums
use Illuminate\Support\Facades\Password; // Laravel paroles atiestatīšanas sistēma
use Illuminate\View\View; // Norāda, ka metode var atgriezt skatu

class PasswordResetLinkController extends Controller // Kontrolieris paroles atiestatīšanas linka nosūtīšanai
{
    public function create(): View // Parāda "aizmirsu paroli" lapu
    {
        return view('auth.forgot-password'); // Atver forgot-password blade failu
    }

    public function store(Request $request): RedirectResponse 
    // Apstrādā formu, kad lietotājs ievada savu e-pastu
    {
        $request->validate([ // Pārbauda ievadīto e-pastu
            'email' => ['required', 'email'], 
            // E-pasts obligāts un pareizā formātā
        ]);

        $status = Password::sendResetLink(
        // Mēģina nosūtīt paroles atiestatīšanas linku uz e-pastu

            $request->only('email') 
            // Ņem tikai e-pasta lauku no formas
        );

        return $status == Password::RESET_LINK_SENT
        // Pārbauda, vai links tika veiksmīgi nosūtīts

            ? back()->with('status', __($status))
            // Ja veiksmīgi → atgriežas atpakaļ ar statusa ziņu

            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
            // Ja kļūda → atgriežas atpakaļ ar kļūdas ziņojumu
    }
}
