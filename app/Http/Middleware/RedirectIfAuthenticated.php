<?php

/**
 * RedirectIfAuthenticated middleware nodrošina jau autentificētu lietotāju
 * pārsūtīšanu uz sistēmas galveno paneli.
 *
 * Middleware atbild par:
 * - autentificēta lietotāja pārbaudi;
 * - piekļuves ierobežošanu autorizācijas lapām;
 * - automātisku pārsūtīšanu uz dashboard sadaļu;
 * - vairāku autentifikācijas guardu apstrādi.
 */

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Pārbauda, vai lietotājs jau ir autentificējies sistēmā.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        /**
         * Ja nav norādīts konkrēts autentifikācijas guards,
         * tiek izmantots noklusējuma guards.
         */
        $guards = empty($guards) ? [null] : $guards;

        /**
         * Tiek pārbaudīts katrs autentifikācijas guards.
         */
        foreach ($guards as $guard) {

            /**
             * Ja lietotājs jau ir autentificējies,
             * viņš tiek pārsūtīts uz dashboard sadaļu.
             */
            if (Auth::guard($guard)->check()) {
                return redirect('/dashboard');
            }
        }

        /**
         * Ja lietotājs nav autentificējies,
         * pieprasījums tiek nodots nākamajam sistēmas posmam.
         */
        return $next($request);
    }
}