<?php // Sākas PHP kods

namespace App\Livewire\Actions; // Šī klase atrodas Livewire Actions mapē

use Illuminate\Support\Facades\Auth; // Autentifikācijas sistēma (logout funkcija)
use Illuminate\Support\Facades\Session; // Darbs ar sesiju

class Logout // Klase, kas atbild par lietotāja izrakstīšanu (logout)
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(): void 
    // __invoke nozīmē, ka šo klasi var izsaukt kā funkciju
    {
        Auth::guard('web')->logout(); 
        // Izraksta lietotāju no sistēmas (dzēš autentifikāciju)

        Session::invalidate(); 
        // Dzēš visus sesijas datus

        Session::regenerateToken(); 
        // Izveido jaunu CSRF tokenu drošības nolūkos
    }
}
