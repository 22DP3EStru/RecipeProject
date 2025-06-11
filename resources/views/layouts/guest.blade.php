<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RecipeHub') }} - {{ $title ?? 'Authentication' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50">
            <div class="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-6">
                <!-- Logo/Brand -->
                <div class="mb-8">
                    <a href="/" wire:navigate class="flex items-center space-x-2">
                        <!-- Recipe Icon -->
                        <svg class="h-12 w-12 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-900">RecipeHub</h1>
                    </a>
                </div>

                <!-- Auth Card -->
                <div class="w-full sm:max-w-md bg-white shadow-lg rounded-2xl border border-gray-200 overflow-hidden">
                    <div class="px-8 py-8">
                        {{ $slot }}
                    </div>
                </div>
                
                <!-- Footer Link -->
                <div class="mt-6 text-center">
                    <a href="/" wire:navigate class="text-sm text-gray-600 hover:text-orange-600 transition duration-200">
                        ← Back to RecipeHub
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
