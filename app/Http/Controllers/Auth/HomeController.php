<?php // Sākas PHP kods

namespace App\Http\Controllers; // Šis kontrolieris atrodas Controllers mapē

use Illuminate\Http\Request; // HTTP pieprasījuma klase (šajā failā gan netiek izmantota)

class HomeController extends Controller // Kontrolieris, kas atbild par home lapu
{
    public function index() // Metode, kas tiek izsaukta, kad atver home lapu
    {
        return view('home'); // Atgriež home blade failu (resources/views/home.blade.php)
    }
}
