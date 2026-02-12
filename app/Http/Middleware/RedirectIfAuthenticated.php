<?php // Sākas PHP kods

namespace App\Http\Middleware; // Šis fails atrodas Middleware mapē

use App\Providers\RouteServiceProvider; // (Šajā failā netiek izmantots, bet parasti satur redirect ceļus)
use Closure; // Closure tips (nākamā darbība ķēdē)
use Illuminate\Http\Request; // HTTP pieprasījums
use Illuminate\Support\Facades\Auth; // Autentifikācijas sistēma
use Symfony\Component\HttpFoundation\Response; // Atgriežamais atbildes tips

class RedirectIfAuthenticated // Middleware, kas pārsūta jau ielogotus lietotājus
{
    /**
     * Handle an incoming request.
     */

    public function handle(Request $request, Closure $next, string ...$guards): Response 
    // Šī metode tiek izsaukta pirms piekļuves konkrētai route
    {
        $guards = empty($guards) ? [null] : $guards; 
        // Ja nav norādīti guardi, izmanto noklusējuma (null)

        foreach ($guards as $guard) { // Pārbauda katru guard tipu
            if (Auth::guard($guard)->check()) { 
            // Ja lietotājs ir ielogots ar šo guard

                return redirect('/dashboard'); 
                // Pārsūta uz dashboard (tātad login lapa nav pieejama ielogotiem)
            }
        }

        return $next($request); 
        // Ja lietotājs nav ielogots → atļauj turpināt uz pieprasīto lapu
    }
}

