<?php

/**
 * ProfileController kontrolieris nodrošina lietotāja profila pārvaldību
 * recepšu tīmekļa vietnē.
 *
 * Kontrolieris atbild par:
 * - lietotāja profila formas attēlošanu;
 * - lietotāja vārda un e-pasta adreses atjaunināšanu;
 * - profila attēla augšupielādi;
 * - profila attēla dzēšanu;
 * - lietotāja konta dzēšanu;
 * - lietotāja sesijas pārtraukšanu pēc konta dzēšanas.
 */

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Attēlo lietotāja profila rediģēšanas formu.
     */
    public function edit(Request $request): View
    {
        /**
         * Tiek iegūts pašreiz autentificētais lietotājs.
         */
        $user = $request->user();

        /**
         * Lietotāja dati tiek nodoti profila skatam kopā ar saistīto ierakstu skaitu:
         * receptēm, favorītiem un komentāriem.
         */
        return view('profile.edit', [
            'user' => $user->loadCount([
                'recipes',
                'favoriteRecipes',
                'comments',
            ]),
        ]);
    }

    /**
     * Atjaunina lietotāja profila informāciju.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /**
         * Tiek iegūts pašreiz autentificētais lietotājs
         * un validētie profila formas dati.
         */
        $user = $request->user();
        $validated = $request->validated();

        /**
         * Lietotāja vārds un e-pasta adrese tiek aizpildīta
         * ar validētajiem formas datiem.
         */
        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        /**
         * Ja e-pasta adrese ir mainīta, e-pasta verifikācijas datums tiek atiestatīts.
         */
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        /**
         * Ja lietotājs augšupielādē jaunu profila attēlu,
         * iepriekšējais attēls tiek dzēsts no publiskās glabātuves.
         */
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            /**
             * Jaunais profila attēls tiek saglabāts profile-photos mapē,
             * un tā ceļš tiek piesaistīts lietotāja ierakstam.
             */
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        /**
         * Ja lietotājs izvēlas noņemt profila attēlu,
         * esošais attēls tiek dzēsts no glabātuves.
         */
        if ($request->boolean('remove_profile_photo')) {
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            /**
             * Profila attēla ceļš tiek noņemts no lietotāja ieraksta.
             */
            $user->profile_photo = null;
        }

        /**
         * Atjauninātie lietotāja dati tiek saglabāti datubāzē.
         */
        $user->save();

        return Redirect::route('profile.edit')
            ->with('success', 'Profils veiksmīgi atjaunināts.');
    }

    /**
     * Dzēš lietotāja kontu.
     */
    public function destroy(Request $request): RedirectResponse
    {
        /**
         * Pirms konta dzēšanas tiek pārbaudīta lietotāja parole.
         */
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ], [
            'password.required' => 'Parole ir obligāta.',
            'password.current_password' => 'Nepareiza parole.',
        ]);

        /**
         * Tiek iegūts pašreiz autentificētais lietotājs.
         */
        $user = $request->user();

        /**
         * Ja lietotājam ir profila attēls, tas tiek dzēsts no publiskās glabātuves.
         */
        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        /**
         * Lietotājs tiek izrakstīts no sistēmas.
         */
        Auth::logout();

        /**
         * Lietotāja konts tiek dzēsts no datubāzes.
         */
        $user->delete();

        /**
         * Pēc konta dzēšanas sesija tiek anulēta
         * un CSRF marķieris tiek atjaunots.
         */
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Konts veiksmīgi dzēsts.');
    }
}