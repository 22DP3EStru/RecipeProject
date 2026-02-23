<?php // Sākas PHP kods

namespace App\Http\Controllers\Auth; // Šis kontrolieris atrodas Auth mapē

use App\Http\Controllers\Controller; // Pamata Controller klase
use Illuminate\Http\RedirectResponse; // Norāda, ka metode atgriezīs pāradresāciju
use Illuminate\Http\Request; // HTTP pieprasījums
use Illuminate\Support\Facades\Hash; // Paroļu šifrēšanai
use Illuminate\Validation\Rules\Password; // Paroles validācijas noteikumi

class PasswordController extends Controller // Kontrolieris paroles maiņai (kad lietotājs jau ir ielogots)
{
    public function update(Request $request): RedirectResponse // Metode, kas apstrādā paroles maiņas formu
    {
        $validated = $request->validateWithBag('updatePassword', [ 
        // Validē ievadītos datus un saglabā tos $validated mainīgajā
        // 'updatePassword' nozīmē, ka kļūdas būs šajā kļūdu grupā (error bag)

            'current_password' => ['required', 'current_password'], 
            // Esošā parole obligāta un tai jāsakrīt ar lietotāja īsto paroli

            'password' => ['required', Password::min(8), 'confirmed'], 
            // Jaunā parole obligāta, vismaz 8 simboli,
            // un jābūt password_confirmation laukam, kas sakrīt

        ], [
            // Šeit ir pielāgoti kļūdu ziņojumi latviešu valodā

            'current_password.required' => 'Pašreizējā parole ir obligāta.',
            'current_password.current_password' => 'Nepareiza pašreizējā parole.',
            'password.required' => 'Jaunā parole ir obligāta.',
            'password.min' => 'Parolei jābūt vismaz 8 simbolus garai.',
            'password.confirmed' => 'Paroles nesakrīt.',
        ]);

        $request->user()->update([ 
        // Atjauno pašreiz ielogotā lietotāja datus

            'password' => Hash::make($validated['password']), 
            // Saglabā jauno paroli šifrētā veidā (nevis kā tekstu)

        ]);

        return back()->with('status', 'password-updated'); 
        // Atgriežas atpakaļ uz to pašu lapu
        // un pievieno statusa ziņu, ka parole veiksmīgi nomainīta
    }
}
