<nav class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600 flex items-center">
            🍳 <span class="ml-2 hidden sm:inline">Receptes</span>
        </a>

        {{-- Meklēšana --}}
        <form action="{{ route('recipes.index') }}" method="get"
              class="hidden md:flex flex-1 mx-6 max-w-lg">
            <input name="q" value="{{ request('q') }}" placeholder="Meklēt recepti…"
                   class="flex-1 rounded-l-lg border border-gray-300 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-r-lg hover:bg-indigo-700 transition">OK</button>
        </form>

        {{-- Lietotājs / Pieteikšanās --}}
        <div class="flex items-center space-x-4">
            @auth
                <a href="{{ route('favorites') }}" class="hover:text-indigo-600 text-sm">❤️ Favorīti</a>
                <a href="{{ route('profile.edit') }}" class="hover:text-indigo-600 text-sm font-medium">{{ Auth::user()->name }}</a>
            @else
                <a href="{{ route('login') }}"
                   class="py-2 px-4 rounded-lg bg-indigo-600 text-white text-sm hover:bg-indigo-700 transition">
                    Ienākt
                </a>
                <a href="{{ route('register') }}"
                   class="py-2 px-4 rounded-lg bg-gray-100 text-sm hover:bg-gray-200 transition">
                    Reģistrēties
                </a>
            @endauth
        </div>
    </div>
</nav>
