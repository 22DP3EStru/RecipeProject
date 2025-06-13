<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RecipeHub - Atklāj pārsteidzošas receptes</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white">
        <!-- Navigation Header - Fixed at the top -->
        <header class="fixed top-0 left-0 right-0 w-full z-50 bg-white/95 backdrop-blur-sm border-b border-gray-100 shadow-sm">
            <nav class="max-w-7xl mx-auto px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="absolute inset-0 bg-orange-100 rounded-full transform rotate-45"></div>
                            <svg class="h-10 w-10 text-orange-600 relative" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">RecipeHub</h1>
                            <p class="text-xs text-gray-500">Tavs kulinārijas ceļvedis</p>
                        </div>
                    </div>
                    @if (Route::has('login'))
                        <livewire:welcome.navigation />
                    @endif
                </div>
            </nav>
        </header>

        <!-- Add padding to the top of the first section to account for fixed header -->
        <!-- Hero Section -->
        <section class="relative min-h-screen pt-20 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-50 to-red-50 opacity-70"></div>
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1zbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAxOGMxLjY1NyAwIDMgMS4zNDMgMyAzdjI0YzAgMS42NTctMS4zNDMgMy0zIDMtMS42NTcgMC0zLTEuMzQzLTMtM1YyMWMwLTEuNjU3IDEuMzQzLTMgMy0zeiIgZmlsbD0icmdiYSgyNDksIDExNSwgMjIsIDAuMikiLz48cGF0aCBkPSJNMzkgMjFjMC0xLjY1Ny0xLjM0My0zLTMtM3MtMyAxLjM0My0zIDN2MjRjMCAxLjY1NyAxLjM0MyAzIDMgM3MzLTEuMzQzIDMtM1YyMXoiIGZpbGw9InJnYmEoMjQ5LCAxMTUsIDIyLCAwLjIpIiB0cmFuc2Zvcm09InJvdGF0ZSg2MCAzMCAzMCkiLz48L2c+PC9zdmc+')] opacity-40"></div>
            </div>

            <!-- Hero Content - Improved vertical centering -->
            <div class="absolute inset-0 flex items-center justify-center z-10">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <!-- Centered content -->
                    <div class="flex justify-center items-center">
                        <div class="text-center max-w-3xl">
                            <h2 class="text-5xl lg:text-6xl font-bold leading-tight mb-6">
                                Atklāj <br>
                                <span class="bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
                                    Gardākās Receptes
                                </span>
                            </h2>
                            <p class="text-xl text-gray-700 mb-8 max-w-xl mx-auto">
                                Receptes, kas iedvesmo un atvieglo gatavošanu ikdienā. Atklāj tūkstošiem gardu ēdienu no visas pasaules.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-10">
                                <a href="/recipes" class="group relative px-8 py-4 bg-orange-600 text-white font-semibold rounded-xl overflow-hidden shadow-xl transition-all duration-300 hover:shadow-orange-300/30 hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-r from-orange-600 to-red-600 transition-transform duration-300 group-hover:scale-110"></div>
                                    <span class="relative flex items-center justify-center">
                                        Skatīt Receptes
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </span>
                                </a>
                                <a href="/categories" class="px-8 py-4 bg-white text-gray-900 font-semibold rounded-xl shadow-lg border border-gray-200 transition-all duration-300 hover:shadow-xl hover:scale-105">
                                    Skatīt Kategorijas
                                </a>
                            </div>
                            
                            <!-- Centered "Uzzināt vairāk" button -->
                            <div class="flex justify-center mt-8">
                                <button onclick="document.getElementById('features').scrollIntoView({ behavior: 'smooth' })" 
                                        class="group flex flex-col items-center">
                                    <span class="text-sm text-gray-500 mb-2">Uzzināt vairāk</span>
                                    <div class="w-8 h-8 rounded-full bg-white shadow-lg flex items-center justify-center animate-bounce">
                                        <svg class="w-4 h-4 text-orange-600 group-hover:text-orange-700 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-24 bg-white relative">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl font-bold mb-4">
                        Kāpēc izvēlēties 
                        <span class="bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
                            Receptūri
                        </span>
                    </h2>
                    <p class="text-gray-600">
                        Mēs piedāvājam visu nepieciešamo, lai padarītu jūsu kulinārijas piedzīvojumu aizraujošu un vienkāršu
                    </p>
                </div>

                <!-- Feature Cards Grid -->
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl p-8 hover:shadow-lg transition-shadow duration-300">
                        <div class="bg-white rounded-xl w-14 h-14 flex items-center justify-center mb-6 shadow-sm">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Vienkārša Lietošana</h3>
                        <p class="text-gray-600">
                            Intuitīvs dizains un lietotājiem draudzīga saskarne, lai atvieglotu jūsu gatavošanas pieredzi. 
                            Viegli atrast un sekot receptēm.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl p-8 hover:shadow-lg transition-shadow duration-300">
                        <div class="bg-white rounded-xl w-14 h-14 flex items-center justify-center mb-6 shadow-sm">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Aktīva Kopiena</h3>
                        <p class="text-gray-600">
                            Dalieties ar savām receptēm, idejas un padomiem ar citiem pavāriem. Veidojiet kontaktus un 
                            iedvesmojieties no citiem.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl p-8 hover:shadow-lg transition-shadow duration-300">
                        <div class="bg-white rounded-xl w-14 h-14 flex items-center justify-center mb-6 shadow-sm">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Detalizētas Receptes</h3>
                        <p class="text-gray-600">
                            Skaidri aprakstītas sastāvdaļas un soli pa solam instrukcijas. Padomi un triki no 
                            pieredzējušiem pavāriem.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative py-24 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-600 to-red-600"></div>
            <div class="absolute inset-0 bg-grid-white/[0.2] bg-grid"></div>
            
            <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold text-white mb-6">
                    Gatavs sākt savu kulinārijas piedzīvojumu?
                </h2>
                <p class="text-xl text-orange-50 mb-12 max-w-2xl mx-auto">
                    Pievienojies mūsu kopienai un atklāj jaunu recepti katru dienu. Sāciet savu garšas ceļojumu jau šodien!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ route('dashboard') }}" 
                           class="px-8 py-4 bg-white text-orange-600 font-semibold rounded-xl shadow-lg transition-all duration-300 hover:shadow-orange-500/25 hover:scale-105">
                            Mans profils
                        </a>
                    @else
                        <a href="{{ route('register') }}" 
                           class="px-8 py-4 bg-white text-orange-600 font-semibold rounded-xl shadow-lg transition-all duration-300 hover:shadow-orange-500/25 hover:scale-105">
                            Reģistrēties
                        </a>
                        <a href="{{ route('login') }}" 
                           class="px-8 py-4 bg-orange-500 text-white font-semibold rounded-xl shadow-lg border border-orange-400 transition-all duration-300 hover:shadow-orange-500/25 hover:scale-105">
                            Pieslēgties
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Popular Recipes Section -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl font-bold mb-4">
                        Populārākās Receptes
                    </h2>
                    <p class="text-gray-600">
                        Atklājiet mūsu lietotāju visvairāk novērtētās receptes. Iedvesmojieties un pievienojieties gatavošanai!
                    </p>
                </div>

                <!-- Recipes Grid -->
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($popularRecipes as $recipe)
                        <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl p-6 hover:shadow-lg transition-shadow duration-300">
                            <h3 class="text-xl font-semibold mb-2">{{ $recipe->title }}</h3>
                            <p class="text-gray-700 mb-4">{{ $recipe->description }}</p>
                            <p class="text-sm text-gray-500 mb-2">Kategorija: {{ $recipe->category ?? 'Bez kategorijas' }}</p>
                            <p class="text-sm text-gray-500 mb-2">Autors: {{ optional($recipe->user)->name ?? 'Nepazīstams lietotājs' }}</p>
                            <p class="text-sm text-gray-500">Vērtējums: {{ number_format($recipe->ratings_avg_rating ?? 0, 1) }}/5</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-100 py-12">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex flex-col items-center justify-center space-y-4">
                    <div class="flex items-center space-x-2">
                        <svg class="h-8 w-8 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                        </svg>
                        <span class="text-xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
                            RecipeHub
                        </span>
                    </div>
                    <p class="text-sm text-gray-500">© 2025 RecipeHub. Visas tiesības aizsargātas.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
