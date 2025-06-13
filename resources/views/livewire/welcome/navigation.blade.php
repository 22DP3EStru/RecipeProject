<nav class="-mx-3 flex flex-1 justify-end">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="rounded-lg px-4 py-2 text-gray-700 bg-black/80 backdrop-blur-sm border border-gray-200 font-medium transition hover:bg-white hover:text-gray-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500 dark:text-gray-200 dark:bg-gray-800/80 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-black shadow-sm"
        >
            Dashboard
        </a>
    @else
        <a
            href="{{ route('login') }}"
            class="rounded-lg px-4 py-2 text-black-700 bg-white/80 backdrop-blur-sm border border-gray-200 font-medium transition hover:bg-white hover:text-black-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500 dark:text-black-200 dark:bg-grey-800/80 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-black shadow-sm mr-2"
        >
            Log in
        </a>

        @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="rounded-lg px-4 py-2 text-black-700 bg-white/80 backdrop-blur-sm border border-gray-200 font-medium transition hover:bg-white hover:text-black-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500 dark:text-black-200 dark:bg-grey-800/80 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-black shadow-sm mr-2"
            >
                Register
            </a>
        @endif
    @endauth

    <!-- Navigation Links -->
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>

        <!-- Replace any admin route with simple URL -->
        @if(Auth::check() && Auth::user()->is_admin)
            <x-nav-link href="/admin" :active="request()->is('admin*')">
                {{ __('Admin Panel') }}
            </x-nav-link>
        @endif
    </div>
</nav>
