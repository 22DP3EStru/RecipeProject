<?php // Sākas PHP kods

namespace App\Http\Controllers\Auth; // Šis fails atrodas Auth kontrolieru mapē

use App\Http\Controllers\Controller; // Pamata Controller klase, no kuras šī klase manto funkcijas
use App\Http\Requests\Auth\LoginRequest; // Speciāla klase login validācijai (pārbauda epastu/paroli)
use Illuminate\Http\RedirectResponse; // Norāda, ka metode var atgriezt pāradresāciju
use Illuminate\Http\Request; // Parasts HTTP pieprasījums
use Illuminate\Support\Facades\Auth; // Laravel autentifikācijas sistēma (login/logout)
use Illuminate\View\View; // Norāda, ka metode var atgriezt skatu (lapu)

class AuthenticatedSessionController extends Controller // Kontrolieris, kas atbild par login un logout
{
    public function create(): View // Metode, kas parāda login lapu
    {
        return view('auth.login'); // Atver login blade failu
    }

    public function store(LoginRequest $request): RedirectResponse // Metode, kas apstrādā login formu
    {
        $request->authenticate(); // Pārbauda, vai epasts un parole ir pareizi

        $request->session()->regenerate(); // Izveido jaunu sesiju drošības nolūkos

        return redirect()->intended( // Pārsūta lietotāju pēc login
            Auth::user()->is_admin // Pārbauda, vai lietotājs ir administrators
                ? route('admin.index', absolute: false) // Ja admins → iet uz admin paneli
                : route('dashboard', absolute: false) // Ja nav admins → iet uz dashboard
        );
    }

    public function destroy(Request $request): RedirectResponse // Metode, kas izraksta lietotāju
    {
        Auth::guard('web')->logout(); // Izraksta lietotāju no sistēmas

        $request->session()->invalidate(); // Dzēš sesijas datus
        $request->session()->regenerateToken(); // Izveido jaunu drošības tokenu

        return redirect('/'); // Pārsūta uz sākumlapu
    }
}
