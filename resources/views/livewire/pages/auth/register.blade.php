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
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(route('dashboard', absolute: false), navigate: true);
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
            <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 dark:text-gray-300 font-medium" />
            <x-text-input wire:model="name" id="name" 
                class="block mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white transition duration-200" 
                type="text" 
                name="name" 
                required 
                autofocus 
                autocomplete="name" 
                placeholder="Enter your full name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300 font-medium" />
            <x-text-input wire:model="email" id="email" 
                class="block mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white transition duration-200" 
                type="email" 
                name="email" 
                required 
                autocomplete="username" 
                placeholder="Enter your email address" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300 font-medium" />
            <x-text-input wire:model="password" id="password" 
                class="block mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white transition duration-200"
                type="password"
                name="password"
                required 
                autocomplete="new-password" 
                placeholder="Create a secure password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 dark:text-gray-300 font-medium" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" 
                class="block mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white transition duration-200"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password" 
                placeholder="Confirm your password" />
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
                class="w-full bg-orange-600 hover:bg-orange-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                {{ __('Izveidot manu Receptūres kontu') }}
            </button>
        </div>
    </form>

    <!-- Login Link -->
    <div class="mt-6 text-center pt-6 border-t border-gray-200 dark:border-gray-600">
        <p class="text-gray-600 dark:text-gray-400">
            Vai jau eksistē konts? 
            <a href="{{ route('login') }}" wire:navigate 
               class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium transition duration-200">
                Pieslēgties Receptūrei
            </a>
        </p>
    </div>
</div>
