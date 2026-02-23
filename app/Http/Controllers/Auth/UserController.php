<?php // Sākas PHP kods

namespace App\Http\Controllers; // Šis kontrolieris atrodas Controllers mapē

use Illuminate\Http\Request; // HTTP pieprasījums (šajā failā gan netiek izmantots)
use App\Models\User; // User modelis (users tabula)
use Illuminate\Support\Facades\Auth; // Autentifikācijas sistēma (lai dabūtu ielogoto lietotāju)

class UserController extends Controller // Kontrolieris lietotāju darbībām
{
    public function destroy(User $user) // Metode lietotāja dzēšanai (saņem konkrēto lietotāju no route)
    {
        if (Auth::user() && Auth::user()->id === $user->id) { 
        // Pārbauda:
        // 1) Vai kāds ir ielogojies
        // 2) Vai mēģina dzēst pats sevi

            return back()->with('error', 'You cannot delete your own account.'); 
            // Ja mēģina dzēst pats sevi → atgriežas atpakaļ ar kļūdas ziņu
        }

        $user->delete(); // Dzēš lietotāju no datubāzes

        return back()->with('success', 'User deleted successfully.'); 
        // Atgriežas atpakaļ ar paziņojumu, ka lietotājs veiksmīgi izdzēsts
    }
}

