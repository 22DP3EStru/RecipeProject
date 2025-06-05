<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'TastyClone - Delicious Recipes')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <nav class="bg-white shadow-sm border-b sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <div class="h-8 w-8 bg-orange-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">T</span>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">TastyClone</span>
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-orange-500 font-medium">Home</a>
                    <a href="{{ route('recipes.index') }}" class="text-gray-700 hover:text-orange-500 font-medium">Recipes</a>
                    <a href="{{ route('recipes.categories') }}" class="text-gray-700 hover:text-orange-500 font-medium">Categories</a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <div class="relative">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-orange-500">
                                <span>{{ auth()->user()->name }}</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-orange-500">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-500">Login</a>
                        <a href="{{ route('register') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white py-12 mt-16">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 TastyClone. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
