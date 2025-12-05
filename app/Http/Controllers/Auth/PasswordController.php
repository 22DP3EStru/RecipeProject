<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::min(8), 'confirmed'],
        ], [
            'current_password.required' => 'PaÅreizÄ“jÄ parole ir obligÄta.',
            'current_password.current_password' => 'Nepareiza paÅreizÄ“jÄ parole.',
            'password.required' => 'JaunÄ parole ir obligÄta.',
            'password.min' => 'Parolei jÄbÅ«t vismaz 8 simbolus garai.',
            'password.confirmed' => 'Paroles nesakrÄ«t.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}

