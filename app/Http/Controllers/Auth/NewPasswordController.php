<?php // Sākas PHP kods

namespace App\Http\Controllers\Auth; // Šis kontrolieris atrodas Auth mapē

use App\Http\Controllers\Controller; // Pamata Controller klase
use App\Models\User; // Lietotāja modelis (tabula users)
use Illuminate\Auth\Events\PasswordReset; // Notikums, kas tiek izsaukts pēc paroles maiņas
use Illuminate\Http\RedirectResponse; // Norāda, ka metode var atgriezt pāradresāciju
use Illuminate\Http\Request; // HTTP pieprasījums
use Illuminate\Support\Facades\Hash; // Paroļu šifrēšanai
use Illuminate\Support\Facades\Password; // Laravel paroles atiestatīšanas sistēma
use Illuminate\Support\Str; // String palīgfunkcijas (piemēram, random)
use Illuminate\Validation\Rules; // Paroles validācijas noteikumi
use Illuminate\View\View; // Norāda, ka metode var atgriezt skatu

class NewPasswordController extends Controller // Kontrolieris paroles atiestatīšanai
{
    public function create(Request $request): View // Parāda paroles maiņas lapu
    {
        return view('auth.reset-password', ['request' => $request]); 
        // Atver reset-password blade failu un padod request datus
    }

    public function store(Request $request): RedirectResponse 
    // Apstrādā jaunas paroles iesniegšanu
    {
        $request->validate([ // Pārbauda ievadītos datus
            'token' => ['required'], // Token ir obligāts (no e-pasta linka)
            'email' => ['required', 'email'], // E-pasts obligāts un pareizā formātā
            'password' => ['required', 'confirmed', Rules\Password::defaults()], 
            // Parole obligāta, jāatbilst confirmation laukam un Laravel noteikumiem
        ]);

        $status = Password::reset( 
        // Mēģina atiestatīt lietotāja paroli

            $request->only('email', 'password', 'password_confirmation', 'token'), 
            // Ņem tikai nepieciešamos laukus

            function (User $user) use ($request) { 
            // Funkcija, kas izpildās, ja token un dati ir pareizi

                $user->forceFill([ 
                // Aizpilda lietotāja datus

                    'password' => Hash::make($request->password), 
                    // Saglabā paroli šifrētā veidā

                    'remember_token' => Str::random(60), 
                    // Izveido jaunu remember token drošības nolūkos

                ])->save(); 
                // Saglabā izmaiņas datubāzē

                event(new PasswordReset($user)); 
                // Izsauc notikumu, ka parole ir mainīta
            }
        );

        return $status == Password::PASSWORD_RESET
        // Pārbauda, vai parole tika veiksmīgi atiestatīta

            ? redirect()->route('login')->with('status', __($status))
            // Ja veiksmīgi → pārsūta uz login ar statusa ziņu

            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
            // Ja kļūda → atgriežas atpakaļ ar kļūdas ziņojumu
    }
}
