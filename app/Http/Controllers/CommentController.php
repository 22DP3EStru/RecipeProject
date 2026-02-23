<?php // Sākas PHP kods

namespace App\Http\Controllers; // Kontrolieris atrodas Controllers mapē

use App\Models\Comment; // Comment modelis (comments tabula)
use Illuminate\Http\Request; // HTTP pieprasījums (formu dati)
use Illuminate\Support\Facades\Auth; // Autentifikācija (lai dabūtu ielogotā lietotāja ID)

class CommentController extends Controller // Kontrolieris komentāru pievienošanai
{
    public function store(Request $request) { // Metode, kas apstrādā komentāra pievienošanu

        $data = $request->validate([ 
            // Pārbauda, vai ievadītie dati ir korekti

            'body' => 'required|string', 
            // Komentāra teksts obligāts un jābūt tekstam

            'recipe_id' => 'required|exists:recipes,id', 
            // recipe_id obligāts un jāeksistē recipes tabulā (id kolonnā)
        ]);

        $data['user_id'] = Auth::id(); 
        // Pievieno user_id — tas būs pašreiz ielogotā lietotāja ID

        Comment::create($data); 
        // Izveido jaunu komentāru datubāzē

        return back()->with('success', 'Komentārs pievienots!'); 
        // Atgriežas atpakaļ uz iepriekšējo lapu ar paziņojumu
    }
}
