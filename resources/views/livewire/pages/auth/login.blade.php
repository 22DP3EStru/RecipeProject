<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    // Check if user is admin and redirect accordingly
    if (auth()->user()->is_admin) {
        $this->redirectIntended(default: route('admin.index', absolute: false), navigate: true);
    } else {
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
};

?>

<div>
    <!-- Header -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Sveicināti atpakaļ!</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Pieslēdzaties, lai apskatītu savas mīļākās receptes</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="space-y-6">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300 font-medium" />
            <x-text-input wire:model="form.email" id="email" 
                class="block mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white transition duration-200" 
                type="email" 
                name="email" 
                required 
                autofocus 
                autocomplete="username" 
                placeholder="Enter your email address" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300 font-medium" />
            <x-text-input wire:model="form.password" id="password" 
                class="block mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:text-white transition duration-200"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
                placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" 
                    class="rounded border-gray-300 dark:border-gray-600 text-orange-600 shadow-sm focus:ring-orange-500 dark:bg-gray-700 dark:focus:ring-orange-500" 
                    name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Atcerēties mani') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium transition duration-200" 
                   href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Aizmirsi paroli?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" 
                class="w-full bg-orange-600 hover:bg-orange-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                {{ __('Pieslēgties Receptūrei') }}
            </button>
        </div>
    </form>

    <!-- Register Link -->
    @if (Route::has('register'))
        <div class="mt-6 text-center pt-6 border-t border-gray-200 dark:border-gray-600">
            <p class="text-gray-600 dark:text-gray-400">
                Nav vēl konts? 
                <a href="{{ route('register') }}" wire:navigate 
                   class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium transition duration-200">
                    Izveidot Receptūres kontu
                </a>
            </p>
        </div>
    @endif
</div>
