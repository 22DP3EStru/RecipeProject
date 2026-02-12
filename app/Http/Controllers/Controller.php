<?php // Sākas PHP kods

namespace App\Http\Controllers; // Šis ir galvenais kontrolieru namespace

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 
// Trait, kas ļauj izmantot autorizācijas funkcijas (pārbaudīt atļaujas)

use Illuminate\Foundation\Validation\ValidatesRequests; 
// Trait, kas ļauj izmantot validācijas metodes (piem., $request->validate())

use Illuminate\Routing\Controller as BaseController; 
// Laravel pamata Controller klase (pārsaukta par BaseController)

class Controller extends BaseController // Galvenais kontrolieris, no kura manto visi pārējie
{
    use AuthorizesRequests, ValidatesRequests; 
    // Iekļauj:
    // - autorizācijas iespējas (policies, gates)
    // - validācijas funkcionalitāti
}
