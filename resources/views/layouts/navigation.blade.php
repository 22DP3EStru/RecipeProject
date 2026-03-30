<nav x-data="{ open: false }" class="site-nav">
    <style>
        .site-nav {
            background: rgba(255, 253, 249, 0.92);
            border: 1px solid #ddcfc0;
            box-shadow: 0 12px 30px rgba(79, 59, 42, 0.06);
            margin-bottom: 26px;
        }

        .site-nav-inner {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 18px;
        }

        .site-nav-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 74px;
            gap: 16px;
        }

        .site-nav-left {
            display: flex;
            align-items: center;
            gap: 18px;
            min-width: 0;
        }

        .site-logo-wrap {
            display: flex;
            align-items: center;
        }

        .site-logo-link {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: #7a5a43;
            gap: 10px;
        }

        .site-logo-text {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.8rem;
            font-weight: 500;
            letter-spacing: 0.02em;
            color: #7a5a43;
        }

        .desktop-links {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .desktop-links a,
        .mobile-links a,
        .mobile-settings a {
            text-decoration: none;
        }

        .site-link {
            display: inline-flex;
            align-items: center;
            padding: 10px 14px;
            color: #2f241d;
            font-size: 14px;
            font-weight: 600;
            border: 1px solid transparent;
            transition: 0.2s ease;
        }

        .site-link:hover {
            background: #f6efe7;
            border-color: #ddcfc0;
            color: #7a5a43;
        }

        .site-link-active {
            background: #f0e4d5;
            border-color: #ddcfc0;
            color: #7a5a43;
        }

        .site-nav-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-trigger {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border: 1px solid #ddcfc0;
            background: #fffdf9;
            color: #2f241d;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .user-trigger:hover {
            background: #f6efe7;
        }

        .hamburger-wrap {
            display: none;
            align-items: center;
        }

        .hamburger-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border: 1px solid #ddcfc0;
            background: #fffdf9;
            color: #7b6d61;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .hamburger-btn:hover {
            background: #f6efe7;
            color: #7a5a43;
        }

        .mobile-panel {
            border-top: 1px solid #ddcfc0;
            background: rgba(255, 253, 249, 0.96);
        }

        .mobile-links,
        .mobile-settings {
            padding: 12px 18px;
            display: grid;
            gap: 6px;
        }

        .mobile-user {
            padding: 14px 18px 8px;
            border-top: 1px solid #ddcfc0;
            color: #7b6d61;
        }

        .mobile-user-name {
            font-weight: 700;
            color: #2f241d;
            margin-bottom: 4px;
        }

        .mobile-user-email {
            font-size: 13px;
        }

        .desktop-only {
            display: flex;
        }

        @media (max-width: 900px) {
            .desktop-links,
            .site-nav-right {
                display: none;
            }

            .hamburger-wrap {
                display: flex;
            }

            .site-logo-text {
                font-size: 1.55rem;
            }
        }
    </style>
<link rel="icon" href="{{ asset('favicon.ico') }}">
    <div class="site-nav-inner">
        <div class="site-nav-row">
            <div class="site-nav-left">
                <div class="site-logo-wrap">
                    <a href="{{ route('dashboard') }}" class="site-logo-link">
                        <x-application-logo class="block h-9 w-auto fill-current" style="color:#7a5a43;" />
                        <span class="site-logo-text">Vecmāmiņas Receptes</span>
                    </a>
                </div>

                <div class="desktop-links">
                    <x-nav-link
                        :href="route('dashboard')"
                        :active="request()->routeIs('dashboard')"
                        class="{{ request()->routeIs('dashboard') ? 'site-link site-link-active' : 'site-link' }}">
                        Vadības panelis
                    </x-nav-link>

                    <x-nav-link
                        :href="route('recipes.index')"
                        :active="request()->routeIs('recipes.*')"
                        class="{{ request()->routeIs('recipes.*') ? 'site-link site-link-active' : 'site-link' }}">
                        Receptes
                    </x-nav-link>

                    <x-nav-link
                        :href="route('categories.index')"
                        :active="request()->routeIs('categories.*')"
                        class="{{ request()->routeIs('categories.*') ? 'site-link site-link-active' : 'site-link' }}">
                        Kategorijas
                    </x-nav-link>

                    @if(Auth::check() && Auth::user()->is_admin)
                        <x-nav-link
                            :href="route('admin.index')"
                            :active="request()->routeIs('admin.*')"
                            class="{{ request()->routeIs('admin.*') ? 'site-link site-link-active' : 'site-link' }}">
                            Administrācija
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="site-nav-right">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="user-trigger">
                            <div>{{ Auth::user()->name }}</div>
                            <div>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profils
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Iziet
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="hamburger-wrap">
                <button @click="open = ! open" class="hamburger-btn">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="mobile-panel hidden">
        <div class="mobile-links">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="site-link">
                Vadības panelis
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('recipes.index')" :active="request()->routeIs('recipes.*')" class="site-link">
                Receptes
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" class="site-link">
                Kategorijas
            </x-responsive-nav-link>

            @if(Auth::check() && Auth::user()->is_admin)
                <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.*')" class="site-link">
                    Administrācija
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="mobile-user">
            <div class="mobile-user-name">{{ Auth::user()->name }}</div>
            <div class="mobile-user-email">{{ Auth::user()->email }}</div>
        </div>

        <div class="mobile-settings">
            <x-responsive-nav-link :href="route('profile.edit')" class="site-link">
                Profils
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link
                    :href="route('logout')"
                    class="site-link"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    Iziet
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>