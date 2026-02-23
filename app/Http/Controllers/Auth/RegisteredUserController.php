<?php // Sākas PHP kods

namespace App\Http\Controllers\Auth; // Šis kontrolieris atrodas Auth mapē

use App\Http\Controllers\Controller; // Pamata Controller klase
use App\Models\User; // User modelis (users tabula)
use Illuminate\Auth\Events\Registered; // Notikums, kas tiek izsaukts pēc reģistrācijas
use Illuminate\Http\RedirectResponse; // Norāda, ka metode atgriezīs pāradresāciju
use Illuminate\Http\Request; // HTTP pieprasījums
use Illuminate\Support\Facades\Auth; // Autentifikācijas sistēma
use Illuminate\Support\Facades\Hash; // Paroļu šifrēšanai
use Illuminate\Validation\Rules; // Papildu paroles validācijas noteikumi
use Illuminate\View\View; // Norāda, ka metode var atgriezt skatu

class RegisteredUserController extends Controller // Kontrolieris jaunā lietotāja reģistrācijai
{
    public function create(): View // Parāda reģistrācijas lapu
    {
        return view('auth.register'); // Atver register blade failu
    }

    public function store(Request $request): RedirectResponse 
    // Apstrādā reģistrācijas formu
    {
        $request->validate([ // Pārbauda ievadītos datus

            'name' => ['required', 'string', 'max:255'], 
            // Vārds obligāts, teksts, max 255 simboli

            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class], 
            // E-pasts obligāts, mazajiem burtiem,
            // pareizā formātā, max 255 simboli,
            // un nedrīkst jau eksistēt users tabulā

            'password' => [
                'required', 
                'string', 
                'min:8', 
                'regex:/[A-Z]/', 
                'regex:/[a-z]/', 
                'regex:/[0-9]/', 
                'confirmed', 
                Rules\Password::defaults()
            ],
            // Parole obligāta
            // vismaz 8 simboli
            // jābūt vismaz 1 lielajam burtam
            // vismaz 1 mazajam burtam
            // vismaz 1 ciparam
            // jābūt password_confirmation laukam
            // un jāatbilst Laravel noklusējuma drošības noteikumiem
        ]);

        $user = User::create([ // Izveido jaunu lietotāju datubāzē
            'name' => $request->name, // Saglabā vārdu
            'email' => $request->email, // Saglabā e-pastu
            'password' => Hash::make($request->password), 
            // Saglabā paroli šifrētā veidā (nevis kā tekstu)
        ]);

        event(new Registered($user)); 
        // Izsauc notikumu, ka lietotājs ir reģistrējies
        // (piemēram, var tikt nosūtīts verifikācijas e-pasts)

        Auth::login($user); 
        // Automātiski ielogo lietotāju pēc reģistrācijas

        return redirect()->route('profile.edit'); 
        // Pēc reģistrācijas pārsūta uz profila rediģēšanas lapu
    }
}
