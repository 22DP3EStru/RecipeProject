<!DOCTYPE html>
<html lang="lv" class="h-full">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Receptes') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
</head>
<body class="min-h-full bg-gray-50 text-gray-800">
<nav class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 flex justify-between h-16">
        <a href="{{ route('home') }}" class="flex items-center font-bold">🍳 Receptes</a>

        {{-- meklēšana --}}
        <form action="{{ route('recipes.index') }}" method="get" class="hidden md:flex space-x-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Meklēt..."
                   class="rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">OK</button>
        </form>

        <div class="flex items-center space-x-4">
            @auth
                <a href="{{ route('favorites') }}" class="hover:text-indigo-600">Favorīti</a>
                <a href="{{ route('profile.edit') }}" class="hover:text-indigo-600">{{ Auth::user()->name }}</a>
            @else
                <a href="{{ route('login') }}" class="hover:text-indigo-600">Ienākt</a>
                <a href="{{ route('register') }}" class="hover:text-indigo-600">Reģistrēties</a>
            @endauth
        </div>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-4 py-8">
    @if (session('status'))
        <div class="mb-6 p-4 bg-green-100 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    @yield('content')
</main>

@vite('resources/js/app.js')
</body>
</html>
