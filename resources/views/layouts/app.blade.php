<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'RecipeBook') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('recipes.index') }}" class="text-xl font-bold">RecipeBook</a>
            <div class="space-x-4">
                @auth
                    <a href="{{ route('recipes.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">New Recipe</a>
                @endauth
            </div>
        </div>
    </nav>
    <main class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
