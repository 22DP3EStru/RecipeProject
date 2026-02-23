<?php // Sākas PHP kods

namespace App\Http\Middleware; // Šis fails atrodas Middleware mapē

use Closure; // Closure tips (funkcija, kas tiek padota kā nākamais solis)
use Illuminate\Http\Request; // HTTP pieprasījums
use Illuminate\Support\Facades\Auth; // Autentifikācijas sistēma

class AdminMiddleware // Middleware, kas pārbauda vai lietotājs ir administrators
{
    public function handle(Request $request, Closure $next) 
    // handle metode tiek izpildīta pirms piekļuves konkrētai route
    {
        if (!Auth::check()) { 
        // Ja lietotājs nav ielogojies

            return redirect()->route('login'); 
            // Pārsūta uz login lapu
        }

        if (!Auth::user()->is_admin) { 
        // Ja lietotājs ir ielogojies, bet nav administrators

            abort(403, 'Access denied. Admin privileges required.'); 
            // Aptur izpildi un parāda 403 kļūdu (nav atļauts)
        }

        return $next($request); 
        // Ja viss ir kārtībā (ielogots un admins),
        // turpina pie nākamā soļa (atļauj piekļuvi)
    }
}
