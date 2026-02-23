<?php // Sākas PHP kods

namespace App\Http\Controllers\Auth; // Norāda, ka šis kontrolieris atrodas Auth mapē

use App\Http\Controllers\Controller; // Pamata Controller klase
use Illuminate\Http\RedirectResponse; // Norāda, ka metode var atgriezt pāradresāciju
use Illuminate\Http\Request; // Parasts HTTP pieprasījums
use Illuminate\Support\Facades\Auth; // Laravel autentifikācijas sistēma
use Illuminate\Validation\ValidationException; // Klase kļūdu izmešanai validācijas gadījumā
use Illuminate\View\View; // Norāda, ka metode var atgriezt skatu (lapu)

class ConfirmablePasswordController extends Controller // Kontrolieris paroles apstiprināšanai
{
    public function show(): View // Parāda paroles apstiprināšanas lapu
    {
        return view('auth.confirm-password'); // Atver confirm-password blade failu
    }

    public function store(Request $request): RedirectResponse // Apstrādā paroles apstiprināšanas formu
    {
        if (! Auth::guard('web')->validate([ // Pārbauda, vai ievadītā parole ir pareiza
            'email' => $request->user()->email, // Ņem pašreiz ielogotā lietotāja e-pastu
            'password' => $request->password, // Ņem ievadīto paroli no formas
        ])) { // Ja parole NAV pareiza

            throw ValidationException::withMessages([ // Izmet validācijas kļūdu
                'password' => __('auth.password'), // Parāda kļūdas ziņojumu par nepareizu paroli
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time()); 
        // Saglabā sesijā laiku, kad parole tika apstiprināta
        // (lai sistēma zinātu, ka lietotājs tikko apstiprināja paroli)

        return redirect()->intended(route('dashboard', absolute: false)); 
        // Pārsūta lietotāju uz dashboard vai iepriekš mēģināto lapu
    }
}
