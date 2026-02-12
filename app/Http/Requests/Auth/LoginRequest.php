<?php // Sākas PHP kods

namespace App\Http\Requests\Auth; // Šī klase atrodas Requests/Auth mapē (speciāla login formai)

use Illuminate\Auth\Events\Lockout; // Notikums, kas notiek, ja lietotājs pārāk daudz reižu mēģina ielogoties
use Illuminate\Foundation\Http\FormRequest; // Laravel forma ar iebūvētu validāciju
use Illuminate\Support\Facades\Auth; // Auth sistēma (login mēģinājums)
use Illuminate\Support\Facades\RateLimiter; // Aizsardzība pret pārāk daudziem login mēģinājumiem
use Illuminate\Support\Str; // Teksta palīgfunkcijas
use Illuminate\Validation\ValidationException; // Kļūda, ko met ārā, ja login neizdodas / ir limits

class LoginRequest extends FormRequest // Speciāls Request tieši login procesam
{
    public function authorize(): bool // Vai drīkst izmantot šo request
    {
        return true; // Šeit vienmēr atļauj (jebkurš drīkst mēģināt logoties)
    }

    public function rules(): array // Validācijas noteikumi login formai
    {
        return [
            'email' => ['required', 'string', 'email'], // E-pasts obligāts, teksts, pareizā e-pasta formā
            'password' => ['required', 'string'], // Parole obligāta un teksts
        ];
    }

    public function authenticate(): void // Mēģina ielogot lietotāju ar ievadīto epastu/paroli
    {
        $this->ensureIsNotRateLimited(); 
        // Pārbauda, vai nav pārsniegts login mēģinājumu limits (anti-spam/anti-bruteforce)

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
        // Mēģina ielogoties:
        // - ņem tikai email un password no formas
        // - "remember" ir checkbox (ja atzīmēts, lietotājs paliek ielogots ilgāk)
        // Ja neizdodas → ieiet šajā blokā

            RateLimiter::hit($this->throttleKey()); 
            // Pieraksta neveiksmīgu mēģinājumu (palielina skaitītāju)

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'), 
                // Parāda kļūdu: nepareizs e-pasts/parole
            ]);
        }

        RateLimiter::clear($this->throttleKey()); 
        // Ja login izdevās → notīra neveiksmīgo mēģinājumu skaitītāju
    }

    public function ensureIsNotRateLimited(): void // Pārbauda, vai nav par daudz mēģinājumu
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) { 
        // Ja nav pārsniegts limits (max 5 mēģinājumi) → turpina
            return; // Vienkārši iziet ārā (viss ok)
        }

        event(new Lockout($this)); 
        // Ja limits pārsniegts → izsauc Lockout notikumu (sistēma var to logot u.c.)

        $seconds = RateLimiter::availableIn($this->throttleKey()); 
        // Noskaidro, cik sekundes vēl jāgaida līdz atļaus mēģināt atkal

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [ 
                // Parāda kļūdu, ka par daudz mēģinājumu (jāpagaida)
                'seconds' => $seconds, // Cik sekundes jāgaida
                'minutes' => ceil($seconds / 60), // Cik minūtes (noapaļo uz augšu)
            ]),
        ]);
    }

    public function throttleKey(): string // Izveido unikālu atslēgu login mēģinājumu limitam
    {
        return Str::transliterate( 
        // Pārtaisa tekstu “drošā” formā (bez īpašām zīmēm)
            Str::lower($this->string('email')).'|'.$this->ip()
            // Uztaisa atslēgu no: (email mazajiem burtiem) + (lietotāja IP adrese)
            // Tātad limits darbojas uz konkrētu email+IP kombināciju
        );
    }
}
