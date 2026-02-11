<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Vecmāmiņas Receptes - Receptes')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                    </svg>
                    <h1 class="text-2xl font-bold text-black">Vecmāmiņas Receptes</h1>
                </a>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 max-w-lg mx-8">
                    <form action="{{ route('recipes.search') }}" method="GET" class="w-full">
                        <div class="relative">
                            <input type="text" name="q" placeholder="Meklēt receptes..." 
                                   value="{{ request('q') }}"
                                   class="form-input pl-10">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-6">
                    <!-- Receptes Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-black hover:text-orange-600 font-medium transition duration-200">
                            Receptes
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                            <a href="{{ route('recipes.index') }}" class="block px-4 py-2 text-black hover:bg-gray-50 hover:text-orange-600 rounded-t-lg">
                                Visas receptes
                            </a>
                            <a href="{{ route('recipes.index', ['sort' => 'popular']) }}" class="block px-4 py-2 text-black hover:bg-gray-50 hover:text-orange-600">
                                Populārākās receptes
                            </a>
                            <a href="{{ route('recipes.index', ['sort' => 'latest']) }}" class="block px-4 py-2 text-black hover:bg-gray-50 hover:text-orange-600 rounded-b-lg">
                                Jaunākās receptes
                            </a>
                        </div>
                    </div>
                    
                    <!-- Categories Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-black hover:text-orange-600 font-medium transition duration-200">
                            Kategorijas
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                            <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-black hover:bg-gray-50 hover:text-orange-600 rounded-t-lg font-medium">
                                Visas kategorijas
                            </a>
                            @foreach(\App\Models\Category::all() as $category)
                                <a href="{{ route('categories.show', $category) }}" 
                                   class="block px-4 py-2 text-black hover:bg-gray-50 hover:text-orange-600 {{ $loop->last ? 'rounded-b-lg' : '' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                    @auth
                        <a href="{{ route('recipes.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200 shadow-sm">
                            Pievienot recepti
                        </a>
                        
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-orange-600 font-medium transition duration-200">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <div x-show="open" @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-black hover:bg-gray-50 hover:text-orange-600 rounded-t-lg">
                                    Rediģēt profilu
                                </a>
                                <a href="{{ route('profile.favorites') }}" class="block px-4 py-2 text-black hover:bg-gray-50 hover:text-orange-600">
                                    Iemīļotās receptes
                                </a>
                                <a href="{{ route('profile.recipes') }}" class="block px-4 py-2 text-black hover:bg-gray-50 hover:text-orange-600">
                                    Manas receptes
                                </a>
                                @if(Auth::user()->is_admin)
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <a href="{{ route('/admin') }}" class="block px-4 py-2 text-purple-700 hover:bg-purple-50 hover:text-purple-800 font-medium">
                                        Admin Dashboard
                                    </a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-black hover:bg-gray-50 hover:text-orange-600 rounded-b-lg">
                                        Atslēgties
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-black hover:text-orange-600 font-medium transition duration-200">
                            Pieslēgties
                        </a>
                        <a href="{{ route('register') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200 shadow-sm">
                            Reģistrēties
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-black hover:text-orange-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>                <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden mt-4 pb-4 border-t border-gray-200 pt-4 hidden">
                <!-- Mobile Search -->
                <form action="{{ route('recipes.search') }}" method="GET" class="mb-4">
                    <div class="relative">
                        <input type="text" name="q" placeholder="Meklēt receptes..." 
                               value="{{ request('q') }}"
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </form>
                
                <div class="space-y-2">
                    <!-- Receptes Section -->
                    <div class="border-b border-gray-100 pb-2 mb-2">
                        <div class="font-medium text-black mb-2">Receptes</div>
                        <div class="ml-4 space-y-1">
                            <a href="{{ route('recipes.index') }}" class="block text-black hover:text-orange-600">
                                Visas receptes
                            </a>
                            <a href="{{ route('recipes.index', ['sort' => 'popular']) }}" class="block text-black hover:text-orange-600">
                                Populārākās receptes
                            </a>
                            <a href="{{ route('recipes.index', ['sort' => 'latest']) }}" class="block text-black hover:text-orange-600">
                                Jaunākās receptes
                            </a>
                        </div>
                    </div>
                    
                    <!-- Kategorijas Section -->
                    <div class="border-b border-gray-100 pb-2 mb-2">
                        <div class="font-medium text-black mb-2">Kategorijas</div>
                        <div class="ml-4 space-y-1">
                            <a href="{{ route('categories.index') }}" class="block text-black hover:text-orange-600">
                                Visas kategorijas
                            </a>
                            @foreach(\App\Models\Category::take(5)->get() as $category)
                                <a href="{{ route('categories.show', $category) }}" class="block text-black hover:text-orange-600">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                            <a href="{{ route('categories.index') }}" class="block text-orange-600 hover:text-orange-700 italic">
                                Skatīt visas...
                            </a>
                        </div>
                    </div>
                    
                    @auth
                        <a href="{{ route('recipes.create') }}" class="block bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium text-center">
                            Pievienot recepti
                        </a>
                        <a href="{{ route('profile.edit') }}" class="block text-black hover:text-orange-600 font-medium">
                            Rediģēt profilu
                        </a>
                        <a href="{{ route('profile.favorites') }}" class="block text-black hover:text-orange-600 font-medium">
                            Iemīļotās receptes
                        </a>
                        <a href="{{ route('profile.recipes') }}" class="block text-black hover:text-orange-600 font-medium">
                            Manas receptes
                        </a>
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('\admin') }}" class="block text-black hover:text-orange-600 font-medium">
                                Admin Dashboard
                            </a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit" class="text-left text-black hover:text-orange-600 font-medium">
                                Atslēgties
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block text-black hover:text-orange-600 font-medium">
                            Pieslēgties
                        </a>
                        <a href="{{ route('register') }}" class="block bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium text-center">
                            Reģistrēties
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen bg-white">
        <div class="max-w-7xl mx-auto px-6 py-8">
            <!-- Flash Messages -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-800 rounded-lg border border-green-200">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 text-red-800 rounded-lg border border-red-200">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-6 py-8">
            <div class="text-center">
                <div class="flex items-center justify-center space-x-2 mb-4">
                    <svg class="h-6 w-6 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                    </svg>
                    <span class="text-lg font-semibold">Vecmāmiņas Receptes</span>
                </div>                    <p class="text-black text-sm">
                    © 2025 RecipeHub. Made with ❤️ for food lovers everywhere.
                </p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu JavaScript -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
