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
            'current_password.required' => 'Pašreizējā parole ir obligāta.',
            'current_password.current_password' => 'Nepareiza pašreizējā parole.',
            'password.required' => 'Jaunā parole ir obligāta.',
            'password.min' => 'Parolei jābūt vismaz 8 simbolus garai.',
            'password.confirmed' => 'Paroles nesakrīt.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
