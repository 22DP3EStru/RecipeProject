<?php // Sākas PHP kods

namespace App\Http\Controllers; // Kontrolieris atrodas Controllers mapē

use App\Http\Requests\ProfileUpdateRequest; // Speciāla validācijas klase profila atjaunināšanai
use Illuminate\Http\RedirectResponse; // Metodes atgriezīs pāradresāciju
use Illuminate\Http\Request; // HTTP pieprasījums
use Illuminate\Support\Facades\Auth; // Autentifikācijas sistēma
use Illuminate\Support\Facades\Redirect; // Pāradresācijas klase
use Illuminate\View\View; // Norāda, ka metode var atgriezt skatu

class ProfileController extends Controller // Kontrolieris lietotāja profilam
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View // Parāda profila rediģēšanas lapu
    {
        return view('profile.edit', [
            'user' => $request->user(), // Padod skatam pašreiz ielogoto lietotāju
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse 
    // Atjaunina lietotāja profila informāciju
    {
        $request->user()->fill($request->validated()); 
        // Aizpilda lietotāja laukus ar validētajiem datiem no formas

        if ($request->user()->isDirty('email')) { 
        // Pārbauda, vai e-pasts tika mainīts

            $request->user()->email_verified_at = null; 
            // Ja e-pasts mainīts → noņem e-pasta apstiprinājumu
        }

        $request->user()->save(); 
        // Saglabā izmaiņas datubāzē

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated'); 
        // Pārsūta atpakaļ uz profila lapu ar paziņojumu
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse 
    // Dzēš lietotāja kontu
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'], 
            // Parole obligāta un tai jāsakrīt ar īsto paroli
        ], [
            'password.required' => 'Parole ir obligāta.',
            'password.current_password' => 'Nepareiza parole.',
        ]);

        $user = $request->user(); // Saglabā pašreiz ielogoto lietotāju

        Auth::logout(); // Izraksta lietotāju no sistēmas

        $user->delete(); // Dzēš lietotāju no datubāzes

        $request->session()->invalidate(); 
        // Dzēš visus sesijas datus

        $request->session()->regenerateToken(); 
        // Izveido jaunu drošības tokenu

        return Redirect::to('/'); 
        // Pārsūta uz sākumlapu
    }
}
