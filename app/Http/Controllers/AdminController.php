<?php // Sākas PHP kods

namespace App\Http\Controllers; // Kontrolieris atrodas Controllers mapē

use App\Models\User; // User modelis (users tabula)
use App\Models\Recipe; // Recipe modelis (recipes tabula)
use Illuminate\Http\Request; // HTTP pieprasījums (šajā failā netiek izmantots tieši)

class AdminController extends Controller // Kontrolieris administratora funkcijām
{
    public function index() // Admin paneļa galvenā lapa
    {
        $totalUsers = User::count(); // Saskaita visus lietotājus
        $totalRecipes = Recipe::count(); // Saskaita visas receptes
        $totalAdmins = User::where('is_admin', true)->count(); // Saskaita visus administratorus
        $recentUsers = User::latest()->take(5)->get(); // Paņem 5 jaunākos lietotājus
        $recentRecipes = Recipe::with('user')->latest()->take(5)->get(); 
        // Paņem 5 jaunākās receptes kopā ar autoru (user)

        return view('admin.index', compact(
            'totalUsers',
            'totalRecipes', 
            'totalAdmins',
            'recentUsers',
            'recentRecipes'
        )); 
        // Atver admin.index lapu un nodod tai visus šos datus
    }

    public function users() // Lapa ar visiem lietotājiem
    {
        $users = User::latest()->paginate(15); 
        // Paņem lietotājus pa 15 vienā lapā (ar pagination)

        return view('admin.users', compact('users')); 
        // Atver admin.users skatu
    }

    public function recipes() // Lapa ar visām receptēm
    {
        $recipes = Recipe::with('user')->latest()->paginate(15); 
        // Paņem receptes ar autoru informāciju, 15 vienā lapā

        return view('admin.recipes', compact('recipes')); 
        // Atver admin.recipes skatu
    }

    public function deleteUser(User $user) // Dzēš konkrētu lietotāju
    {
        if ($user->is_admin) { 
        // Pārbauda, vai lietotājs ir administrators

            return back()->with('error', 'Nevar dzēst administratora kontu!'); 
            // Ja ir admins → neatļauj dzēst un parāda kļūdu
        }
        
        $user->delete(); // Dzēš lietotāju no datubāzes

        return back()->with('success', 'Lietotājs veiksmīgi dzēsts!'); 
        // Atgriežas atpakaļ ar paziņojumu
    }

    public function deleteRecipe(Recipe $recipe) // Dzēš konkrētu recepti
    {
        $recipe->delete(); // Dzēš recepti no datubāzes

        return back()->with('success', 'Recepte veiksmīgi dzēsta!'); 
        // Atgriežas atpakaļ ar paziņojumu
    }

    public function toggleAdmin(User $user) // Maina lietotāja administratora statusu
    {
        $user->update(['is_admin' => !$user->is_admin]); 
        // Ja bija admins → noņem admin tiesības
        // Ja nebija → piešķir admin tiesības
        
        $message = $user->is_admin 
            ? 'Lietotājs ir padarīts par administratoru!' 
            : 'Administratora tiesības noņemtas!'; 
        // Sagatavo paziņojuma tekstu atkarībā no jaunā statusa
        
        return back()->with('success', $message); 
        // Atgriežas atpakaļ ar paziņojumu
    }
}
