<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'min:8', 'confirmed'],
]);

$messages = [
    'name.required' => 'Lūdzu ievadiet savu vārdu.',
    'name.max' => 'Vārds nedrīkst būt garāks par 255 simboliem.',
    'email.required' => 'Lūdzu ievadiet savu e-pasta adresi.',
    'email.email' => 'Lūdzu ievadiet derīgu e-pasta adresi.',
    'email.unique' => 'Šāda e-pasta adrese jau ir reģistrēta.',
    'password.required' => 'Lūdzu izveidojiet paroli.',
    'password.min' => 'Parolei jābūt vismaz 8 simbolus garai.',
    'password.confirmed' => 'Paroles nesakrīt.',
];

$register = function () {
    try {
        $validated = $this->validate();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $this->redirect('/dashboard', navigate: true);
    } catch (\Exception $e) {
        $this->addError('email', 'Registration failed. Please try again.');
    }
};

?>

<div>
    <!-- Header -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Pievienojies Receptūrei!</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Izveido kontu, lai sāktu dalīties un atklātu daudz jaunu recepšu.</p>
    </div>

    <form wire:submit="register" class="space-y-6">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Vārds, Uzvārds')" class="text-gray-700 dark:text-gray-300 font-medium" />
            <x-text-input wire:model="name" id="name" 
                class="block mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white transition duration-200" 
                type="text" 
                name="name" 
                required 
                autofocus 
                autocomplete="name" 
                placeholder="Ievadiet savu vārdu un uzvārdu" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-pasta adrese')" class="text-gray-700 dark:text-gray-300 font-medium" />
            <x-text-input wire:model="email" id="email" 
                class="block mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white transition duration-200" 
                type="email" 
                name="email" 
                required 
                autocomplete="username" 
                placeholder="Ievadiet savu e-pasta adresi" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Parole')" class="text-gray-700 dark:text-gray-300 font-medium" />
            <x-text-input wire:model="password" id="password" 
                class="block mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white transition duration-200"
                type="password"
                name="password"
                required 
                autocomplete="new-password" 
                placeholder="Izveidojiet drošu paroli" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Apstiprināt paroli')" class="text-gray-700 dark:text-gray-300 font-medium" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" 
                class="block mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white transition duration-200"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password" 
                placeholder="Ievadiet paroli vēlreiz" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms Agreement -->
        <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 rounded-lg p-4">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Izzveidojot kontu, jūs piekrītat mūsu 
                <a href="#" class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium">Pakalpojumu sniegšanas noteikumiem</a> 
                un 
                <a href="#" class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium">Privātuma politikai</a>.
            </p>
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" 
                class="w-full bg-orange-600 hover:bg-orange-700 text-black font-semibold py-3 px-4 rounded-lg transition duration-200 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 relative"
                wire:loading.class="opacity-75 cursor-wait"
                wire:loading.attr="disabled">
                <div class="flex items-center justify-center">
                    <span wire:loading.remove>
                        {{ __('Izveidot kontu') }}
                    </span>
                    <span wire:loading class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ __('Reģistrē kontu...') }}
                    </span>
                </div>
            </button>
        </div>
    </form>

    <!-- Login Link -->
    <div class="mt-6 text-center pt-6 border-t border-gray-200 dark:border-gray-600">
        <p class="text-gray-600 dark:text-gray-400">
            Vai jau eksistē konts? 
            <a href="{{ route('login') }}" wire:navigate 
               class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium transition duration-200">
                Pieslēgties RecipeHub
            </a>
        </p>
    </div>
</div>
