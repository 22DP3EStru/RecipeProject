<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    try {
        $this->validate();
        $this->form->authenticate();
        
        // Redirect based on user role
        if (Auth::user()->is_admin) {
            $this->redirect(route('\admin'), navigate: true);
        } else {
            $this->redirect(route('dashboard'), navigate: true);
        }
    } catch (\Exception $e) {
        $this->addError('form.email', trans('auth.failed'));
    }
};

?>

<div>
    <!-- Header -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-black">Sveicināti atpakaļ!</h2>
        <p class="text-black mt-2">Pieslēdzaties, lai apskatītu savas mīļākās receptes</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="space-y-6">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300 font-medium" />
            <x-text-input wire:model="form.email" id="email" 
                class="block mt-2 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 dark:bg-white-700 dark:text-white transition duration-200" 
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
                class="w-full bg-orange-600 hover:bg-orange-700 text-black font-semibold py-3 px-4 rounded-lg transition duration-200 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 relative"
                wire:loading.class="opacity-75 cursor-wait"
                wire:loading.attr="disabled">
                <span wire:loading.remove>{{ __('Pieslēgties Receptūrei') }}</span>
                <span wire:loading>
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ __('Pieslēdzas...') }}
                </span>
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
                    Izveidot Vecmāmiņas Receptes kontu
                </a>
            </p>
        </div>
    @endif
</div>
