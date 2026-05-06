<?php

/**
 * AdminMiddleware middleware nodrošina administratora piekļuves kontroli
 * recepšu tīmekļa vietnē.
 *
 * Middleware atbild par:
 * - lietotāja autentifikācijas pārbaudi;
 * - administratora tiesību pārbaudi;
 * - neatļautas piekļuves bloķēšanu;
 * - lietotāja pārsūtīšanu uz autorizācijas lapu;
 * - administratora sadaļu aizsardzību.
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Pārbauda, vai lietotājs ir autentificēts administrators.
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * Ja lietotājs nav ielogojies sistēmā,
         * viņš tiek pārsūtīts uz autorizācijas lapu.
         */
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /**
         * Ja lietotājs ir autentificēts,
         * bet viņam nav administratora tiesību,
         * tiek parādīta 403 piekļuves kļūda.
         */
        if (!Auth::user()->is_admin) {
            abort(403, 'Access denied. Admin privileges required.');
        }

        /**
         * Ja visas pārbaudes ir veiksmīgas,
         * pieprasījums tiek nodots nākamajam sistēmas posmam.
         */
        return $next($request);
    }
}