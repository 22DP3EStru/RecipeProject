<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptes</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-2xl font-bold text-red-500">Receptes.lv</a>
        <div>
            @auth
                <a href="{{ route('recipes.create') }}" class="mr-4 text-sm text-gray-700 hover:text-red-500">Pievienot recepti</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="text-sm text-gray-700 hover:text-red-500">Atslēgties</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mr-4 text-sm text-gray-700 hover:text-red-500">Pieslēgties</a>
                <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:text-red-500">Reģistrēties</a>
            @endauth
        </div>
    </nav>

    <main class="p-6 max-w-7xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
