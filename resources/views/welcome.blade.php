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
        <div class="bg-gradient-to-br from-orange-50 to-red-50 text-gray-800">
            <div class="relative min-h-screen flex flex-col">
                <!-- Navigation Header -->
                <header class="relative z-10 px-6 py-4 lg:px-8">
                    <nav class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <svg class="h-8 w-8 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                            </svg>
                            <h1 class="text-2xl font-bold text-gray-900">RecipeHub</h1>
                        </div>
                        @if (Route::has('login'))
                            <livewire:welcome.navigation />
                        @endif
                    </nav>
                </header>

                <!-- Hero Section -->
                <main class="flex-1 flex items-center justify-center px-6 py-12">
                    <div class="max-w-4xl mx-auto text-center">
                        <h2 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
                            Atklāj Gardas 
                            <span class="text-orange-600">Receptes</span>
                        </h2>
                        <p class="text-xl md:text-2xl text-gray-600 mb-8 max-w-2xl mx-auto">
                            Receptes, kas iedvesmo un atvieglo gatavošanu ikdienā. Atklāj tūkstošiem gardu ēdienu no visas pasaules.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="/recipes" class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300 shadow-lg">
                                Skatīt Receptes
                            </a>
                            <a href="/categories" class="bg-white hover:bg-gray-50 text-gray-900 px-8 py-3 rounded-lg font-semibold transition duration-300 shadow-lg border border-gray-200">
                                Skatīt Kategorijas
                            </a>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- Featured Recipes Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">Jaunākās receptes</h3>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Atklāj mūsu jaunākās un populārākās receptes, ko dalījušies mūsu kopienas dalībnieki
                    </p>
                </div>
                
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($featuredRecipes as $recipe)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="relative">
                                @if($recipe->image)
                                    <img src="{{ Storage::url($recipe->image) }}" alt="{{ $recipe->title }}" 
                                         class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <span class="absolute top-2 left-2 bg-orange-500 text-white px-2 py-1 rounded text-sm">
                                    {{ $recipe->category->name }}
                                </span>
                            </div>
                            
                            <div class="p-4">
                                <a href="{{ route('recipes.show', $recipe) }}">
                                    <h3 class="font-bold text-lg mb-2 hover:text-orange-500 transition-colors">
                                        {{ $recipe->title }}
                                    </h3>
                                </a>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                    {{ Str::limit($recipe->description, 100) }}
                                </p>
                                <div class="flex justify-between items-center text-sm text-gray-500">
                                    <span>{{ $recipe->user->name }}</span>
                                    <span>{{ $recipe->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-12">
                    <a href="{{ route('recipes.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-semibold transition duration-300">
                        Skatīt visas receptes
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">Receptes kategorijas</h3>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Atrod savas iemīļotās receptes, pārlūkojot mūsu plašo kategoriju klāstu
                    </p>
                </div>
                
                <div class="grid gap-6 md:grid-cols-3 lg:grid-cols-5">
                    @foreach($categories as $category)
                        <a href="{{ route('categories.show', $category) }}" 
                           class="bg-white rounded-lg p-6 text-center hover:shadow-lg transition-shadow group">
                            <div class="w-16 h-16 mx-auto mb-4 bg-orange-100 rounded-full flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-900 group-hover:text-orange-600 transition-colors">{{ $category->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $category->recipes->count() }} receptes</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center">
                    <div class="flex items-center justify-center space-x-2 mb-4">
                        <svg class="h-8 w-8 text-orange-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                        </svg>
                        <span class="text-lg font-semibold">RecipeHub</span>
                    </div>
                    <p class="text-gray-400 text-sm">
                        © 2025 RecipeHub. Izveidots ar ❤️ pārtikas mīļotājiem visur.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>
                            <a href="/categories" class="bg-white hover:bg-gray-50 text-gray-900 px-8 py-3 rounded-lg font-semibold transition duration-300 shadow-lg border border-gray-200">
                                Skatīt Kategorijas
                            </a>
                        </div>
                    </div>
                </main>

                <!-- Features Section -->
                <section class="relative z-10 px-6 py-16 lg:px-8">
                    <div class="max-w-7xl mx-auto">
                        <div class="text-center mb-12">
                            <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Kāpēc izvēlēties Receptūri?</h3>
                            <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                                Mēs piedāvājam plašu receptes kolekciju, kas ir viegli pieejama un pielāgojama ikvienam. Neatkarīgi no tā, vai esi iesācējs virtuvē vai pieredzējis šefpavārs, mūsu platforma ir radīta, lai iedvesmotu un atvieglotu gatavošanu.
                            </p>
                        </div>
                        
                        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                            <!-- Feature 1: Recipe Collection -->
                            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                                <div class="flex items-center justify-center w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg mb-4">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Plaša recepšu kolekcija</h4>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Atklāj tūkstošiem receptes no visas pasaules, kas piemērotas ikvienam gaumei un diētai.
                                </p>
                            </div>

                            <!-- Feature 2: Easy Search -->
                            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                                <div class="flex items-center justify-center w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg mb-4">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Gudrā meklēšana</h4>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Meklē receptes pēc sastāvdaļām, gatavošanas laika vai diētas prasībām, lai atrastu ideālo ēdienu savām vēlmēm.
                                </p>
                            </div>

                            <!-- Feature 3: Community -->
                            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                                <div class="flex items-center justify-center w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg mb-4">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Kopienas vadīts</h4>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Pievienojies mūsu aktīvajai kopienai, lai dalītos ar savām receptēm, komentāriem un ieteikumiem. Mēs mīlam redzēt, kā tu gatavo!
                                </p>
                            </div>

                            <!-- Feature 4: Save Favorites -->
                            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                                <div class="flex items-center justify-center w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Saglabā iemīļotās receptes</h4>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Izveido savu personīgo receptes kolekciju, lai ātri piekļūtu saviem mīļākajiem ēdieniem un dalītos ar draugiem.
                                </p>
                            </div>

                            <!-- Feature 5: Step-by-Step -->
                            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                                <div class="flex items-center justify-center w-12 h-12 bg-red-100 dark:bg-red-900 rounded-lg mb-4">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Detalizētas instrukcijas</h4>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Katrs solis ir skaidri izskaidrots ar ilustrācijām un video, lai tu varētu viegli sekot līdzi un pagatavot gardus ēdienus.
                                </p>
                            </div>

                            <!-- Feature 6: Mobile Friendly -->
                            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                                <div class="flex items-center justify-center w-12 h-12 bg-indigo-100 dark:bg-indigo-900 rounded-lg mb-4">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a1 1 0 001-1V4a1 1 0 00-1-1H8a1 1 0 00-1 1v16a1 1 0 001 1z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Telefonu draudzīga</h4>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Gatavo ar pārliecību, izmantojot mūsu mobilajām ierīcēm pielāgoto vietni, kas ļauj viegli piekļūt receptēm jebkurā laikā un vietā.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Popular Categories Preview -->
                <section class="relative z-10 px-6 py-16 lg:px-8 bg-white/50 dark:bg-gray-800/50">
                    <div class="max-w-7xl mx-auto">
                        <div class="text-center mb-12">
                            <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Populāras Kategorijas</h3>
                            <p class="text-gray-600 dark:text-gray-300">
                                Atklāj receptes pēc saviem mīļākajiem virtuves tipiem un pēc gatavošanas stila.
                            </p>
                        </div>
                        
                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                            <a href="/categories/italian" class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                                <div class="aspect-square bg-gradient-to-br from-red-400 to-red-600 p-8 flex items-center justify-center">
                                    <span class="text-2xl font-bold text-white group-hover:scale-110 transition duration-300">🍝</span>
                                </div>
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end p-4">
                                    <h4 class="text-white font-semibold text-lg">Itālijas virtuve</h4>
                                </div>
                            </a>
                            
                            <a href="/categories/asian" class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                                <div class="aspect-square bg-gradient-to-br from-orange-400 to-red-500 p-8 flex items-center justify-center">
                                    <span class="text-2xl font-bold text-white group-hover:scale-110 transition duration-300">🍜</span>
                                </div>
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end p-4">
                                    <h4 class="text-white font-semibold text-lg">Āzijas virtuve</h4>
                                </div>
                            </a>
                            
                            <a href="/categories/desserts" class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                                <div class="aspect-square bg-gradient-to-br from-pink-400 to-purple-500 p-8 flex items-center justify-center">
                                    <span class="text-2xl font-bold text-white group-hover:scale-110 transition duration-300">🍰</span>
                                </div>
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end p-4">
                                    <h4 class="text-white font-semibold text-lg">Deserti</h4>
                                </div>
                            </a>
                            
                            <a href="/categories/healthy" class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                                <div class="aspect-square bg-gradient-to-br from-green-400 to-green-600 p-8 flex items-center justify-center">
                                    <span class="text-2xl font-bold text-white group-hover:scale-110 transition duration-300">🥗</span>
                                </div>
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end p-4">
                                    <h4 class="text-white font-semibold text-lg">Veselīgi</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Footer -->
                <footer class="relative z-10 py-8 text-center text-sm text-gray-600 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700">
                    <div class="max-w-7xl mx-auto px-6">
                        <p class="mt-2">© 2025 Receptūre. Made with ❤️ for food lovers everywhere.</p>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
