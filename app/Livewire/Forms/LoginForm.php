<?php // Sākas PHP kods

namespace App\Livewire\Forms; // Šī klase atrodas Livewire Forms mapē

use Illuminate\Auth\Events\Lockout; // Notikums, kas notiek, ja pārsniegts login mēģinājumu limits
use Illuminate\Support\Facades\Auth; // Autentifikācijas sistēma (login mēģinājums)
use Illuminate\Support\Facades\RateLimiter; // Aizsardzība pret pārāk daudziem login mēģinājumiem
use Illuminate\Support\Str; // Teksta palīgfunkcijas
use Illuminate\Validation\ValidationException; // Kļūda, ko izmet validācijas gadījumā
use Livewire\Attributes\Validate; // Livewire validācijas atribūts
use Livewire\Form; // Livewire form klase

class LoginForm extends Form // Livewire forma login procesam
{
    #[Validate('required|string|email')] // Validācija: obligāts, teksts, pareizs e-pasts
    public string $email = ''; // Publiskais lauks e-pastam

    #[Validate('required|string')] // Validācija: obligāta parole
    public string $password = ''; // Publiskais lauks parolei

    #[Validate('boolean')] // Validācija: true/false
    public bool $remember = false; // "Remember me" checkbox

    public function authenticate(): void // Mēģina ielogot lietotāju
    {
        $this->ensureIsNotRateLimited(); // Pārbauda, vai nav pārsniegts login limits
        
        try { // Mēģina login procesu
            if (! Auth::attempt($this->only(['email', 'password']), $this->remember)) {
                // Ja login neizdodas (nepareizs e-pasts/parole)

                RateLimiter::hit($this->throttleKey()); 
                // Palielina neveiksmīgo mēģinājumu skaitu

                throw ValidationException::withMessages([
                    'form.email' => trans('auth.failed'), 
                    // Parāda kļūdu par nepareizu login
                ]);
            }
            
            RateLimiter::clear($this->throttleKey()); 
            // Ja login veiksmīgs → notīra neveiksmīgo mēģinājumu skaitītāju
            
            session()->regenerate(); 
            // Izveido jaunu sesiju drošības nolūkos
        } catch (\Exception $e) {
            // Ja notiek jebkāda kļūda

            throw ValidationException::withMessages([
                'form.email' => trans('auth.failed'), 
                // Parāda login kļūdu
            ]);
        }
    }

    protected function ensureIsNotRateLimited(): void // Pārbauda login mēģinājumu limitu
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            // Ja nav pārsniegti 5 mēģinājumi
            return; // Turpina normāli
        }

        event(new Lockout(request())); 
        // Ja pārsniegts limits → izsauc Lockout notikumu

        $seconds = RateLimiter::availableIn($this->throttleKey()); 
        // Noskaidro, cik sekundes vēl jāgaida

        throw ValidationException::withMessages([
            'form.email' => trans('auth.throttle', [
                'seconds' => $seconds, // Cik sekundes jāgaida
                'minutes' => ceil($seconds / 60), // Cik minūtes (noapaļots)
            ]),
        ]);
    }

    protected function throttleKey(): string // Izveido unikālu atslēgu login limitam
    {
        return Str::transliterate(
            Str::lower($this->email).'|'.request()->ip()
            // Izveido kombināciju no email (mazajiem burtiem) + IP adreses
            // Tas nozīmē, ka limits darbojas konkrētam email + IP
        );
    }
}
