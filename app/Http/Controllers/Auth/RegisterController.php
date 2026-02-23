<?php // Sākas PHP kods

namespace App\Http\Controllers\Auth; // Šis kontrolieris atrodas Auth mapē

use App\Http\Controllers\Controller; // Pamata Controller klase
use App\Models\User; // User modelis (tabula users)
use Illuminate\Foundation\Auth\RegistersUsers; 
// Trait, kas satur gatavo reģistrācijas loģiku
use Illuminate\Support\Facades\Hash; // Paroļu šifrēšanai
use Illuminate\Support\Facades\Validator; // Datu validācijai

class RegisterController extends Controller // Kontrolieris lietotāju reģistrācijai
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Šis kontrolieris apstrādā jaunu lietotāju reģistrāciju.
    | Tas izmanto Laravel iebūvētu trait, lai nebūtu jāraksta visa loģika pašam.
    |
    */

    use RegistersUsers; // Iekļauj gatavo Laravel reģistrācijas funkcionalitāti

    protected $redirectTo = '/dashboard'; 
    // Pēc veiksmīgas reģistrācijas lietotājs tiks aizvests uz /dashboard

    public function __construct() // Konstruktors
    {
        $this->middleware('guest'); 
        // Reģistrēties drīkst tikai neielogoti lietotāji
    }

    protected function validator(array $data) 
    // Funkcija, kas pārbauda reģistrācijas formā ievadītos datus
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'], 
            // Vārds obligāts, teksts, max 255 simboli

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], 
            // E-pasts obligāts, pareizā formātā, unikāls (nedrīkst jau eksistēt users tabulā)

            'password' => ['required', 'string', 'min:8', 'confirmed'], 
            // Parole obligāta, vismaz 8 simboli,
            // un jābūt password_confirmation laukam, kas sakrīt
        ], [
            // Šeit ir pielāgoti kļūdu ziņojumi latviešu valodā

            'name.required' => 'Vārds ir obligāts lauks.',
            'name.string' => 'Vārdam jābūt teksta formātā.',
            'name.max' => 'Vārds nedrīkst būt garāks par 255 simboliem.',
            'email.required' => 'E-pasta adrese ir obligāta.',
            'email.email' => 'E-pasta adresei jābūt derīgā formātā.',
            'email.unique' => 'Šī e-pasta adrese jau ir reģistrēta.',
            'password.required' => 'Parole ir obligāta.',
            'password.min' => 'Parolei jābūt vismaz 8 simbolus garai.',
            'password.confirmed' => 'Paroles nesakrīt.',
        ]);
    }

    protected function create(array $data) 
    // Funkcija, kas izveido jaunu lietotāju datubāzē
    {
        return User::create([
            'name' => $data['name'], // Saglabā vārdu
            'email' => $data['email'], // Saglabā e-pastu
            'password' => Hash::make($data['password']), 
            // Saglabā paroli šifrētā veidā (nekad kā tekstu)
        ]);
    }
}
