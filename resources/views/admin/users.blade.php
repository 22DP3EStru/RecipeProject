<x-app-layout> {{-- Izmanto aplikācijas pamata layout (Jetstream/Breeze) --}}
    <x-slot name="header"> {{-- Aizpilda layout header slotu --}}
        <h2 class="font-semibold text-xl text-black leading-tight"> {{-- Header virsraksta stils --}}
            {{ __('Lietotāju pārvaldība - Vecmāmiņas Receptes') }} {{-- Lokalizējams virsraksts --}}
        </h2> {{-- Aizver virsrakstu --}}
    </x-slot> {{-- Aizver header slotu --}}

    {{-- Iekšējie CSS stili šai lapai --}}
    <style>
        * { /* Attiecas uz visiem elementiem */
            margin: 0; /* Noņem ārējās atstarpes */
            padding: 0; /* Noņem iekšējās atstarpes */
            box-sizing: border-box; /* Iekļauj padding/border elementa izmērā */
        } /* Beidzas universālais selektors */

        body { /* Lapas pamatstils */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fonts */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Fona gradients */
            min-height: 100vh; /* Minimālais augstums – pilns ekrāns */
            color: #333; /* Teksta pamatkrāsa */
        } /* Beidzas body stils */

        .container { /* Galvenais konteineris */
            max-width: 1200px; /* Maksimālais platums */
            margin: 0 auto; /* Centrē horizontāli */
            padding: 20px; /* Iekšējā atstarpe */
        } /* Beidzas container stils */

        .header { /* Galvenes bloks */
            text-align: center; /* Centrē tekstu */
            color: white; /* Balts teksts */
            margin-bottom: 40px; /* Atstarpe zem galvenes */
            padding: 40px 0; /* Vertikālais padding */
        } /* Beidzas header stils */

        .header h1 { /* Galvenes virsraksts */
            font-size: 3rem; /* Virsraksta izmērs */
            margin-bottom: 15px; /* Atstarpe zem virsraksta */
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3); /* Teksta ēna */
        } /* Beidzas header h1 stils */

        .header p { /* Galvenes apraksta teksts */
            font-size: 1.3rem; /* Teksta izmērs */
            opacity: 0.9; /* Nedaudz caurspīdīgs */
        } /* Beidzas header p stils */

        .nav-bar { /* Navigācijas josla */
            background: rgba(255, 255, 255, 0.95); /* Puscaurspīdīgs balts fons */
            backdrop-filter: blur(10px); /* Blur efekts */
            border-radius: 15px; /* Noapaļoti stūri */
            padding: 20px; /* Iekšējā atstarpe */
            margin-bottom: 30px; /* Atstarpe zem navigācijas */
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); /* Ēna */
            display: flex; /* Flex izkārtojums */
            justify-content: space-between; /* Elementi abās pusēs */
            align-items: center; /* Vertikāli centrē */
            flex-wrap: wrap; /* Wrap uz jaunām rindām */
        } /* Beidzas nav-bar stils */

        .nav-brand { /* Logo/brand links */
            font-size: 24px; /* Izmērs */
            font-weight: bold; /* Trekns */
            color: #667eea; /* Krāsa */
            text-decoration: none; /* Noņem underline */
        } /* Beidzas nav-brand stils */

        .nav-links { /* Linku grupa */
            display: flex; /* Flex */
            gap: 20px; /* Atstarpe starp linkiem */
            flex-wrap: wrap; /* Wrap */
        } /* Beidzas nav-links stils */

        .nav-links a { /* Linki */
            color: #333; /* Teksta krāsa */
            text-decoration: none; /* No underline */
            padding: 8px 16px; /* Iekšējā atstarpe */
            border-radius: 8px; /* Noapaļoti stūri */
            transition: all 0.3s ease; /* Animācija */
            font-weight: 500; /* Pus-trekns */
        } /* Beidzas nav-links a */

        .nav-links a:hover { /* Hover efekts */
            background: #667eea; /* Fons */
            color: white; /* Teksts */
            transform: translateY(-2px); /* Paceļ */
        } /* Beidzas hover */

        .main-content { /* Galvenā satura kartīte */
            background: rgba(255, 255, 255, 0.95); /* Fons */
            backdrop-filter: blur(10px); /* Blur */
            border-radius: 20px; /* Noapaļoti stūri */
            padding: 40px; /* Iekšējā atstarpe */
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1); /* Ēna */
            border: 1px solid rgba(255, 255, 255, 0.2); /* Border */
        } /* Beidzas main-content */

        .users-grid { /* Lietotāju kartīšu režģis */
            display: grid; /* Grid */
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); /* Kolonnas pēc platuma */
            gap: 25px; /* Atstarpe */
            margin-top: 30px; /* Atstarpe virs */
        } /* Beidzas users-grid */

        .user-card { /* Lietotāja kartīte */
            background: white; /* Balts fons */
            border-radius: 15px; /* Noapaļoti stūri */
            padding: 25px; /* Iekšējā atstarpe */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); /* Ēna */
            transition: all 0.3s ease; /* Animācija */
            border: 1px solid rgba(255, 255, 255, 0.3); /* Viegls border */
        } /* Beidzas user-card */

        .user-card:hover { /* Hover efekts kartītei */
            transform: translateY(-5px); /* Paceļ */
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15); /* Pastiprina ēnu */
        } /* Beidzas user-card:hover */

        .admin-badge { /* Admin atzīme */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Gradients */
            color: white; /* Balts teksts */
            padding: 5px 12px; /* Iekšējā atstarpe */
            border-radius: 15px; /* Noapaļoti stūri */
            font-size: 12px; /* Teksta izmērs */
            font-weight: 600; /* Trekns */
            display: inline-block; /* Inline blokā */
            margin-bottom: 10px; /* Atstarpe zem */
        } /* Beidzas admin-badge */

        .user-badge { /* Parastā lietotāja atzīme */
            background: rgba(86, 171, 47, 0.1); /* Gaiši zaļš fons */
            color: #56ab2f; /* Zaļš teksts */
            padding: 5px 12px; /* Iekšējā atstarpe */
            border-radius: 15px; /* Noapaļoti stūri */
            font-size: 12px; /* Teksta izmērs */
            font-weight: 600; /* Trekns */
            display: inline-block; /* Inline blokā */
            margin-bottom: 10px; /* Atstarpe zem */
        } /* Beidzas user-badge */

        .btn { /* Pogu pamatstils */
            display: inline-block; /* Inline-block */
            padding: 10px 20px; /* Iekšējā atstarpe */
            border-radius: 8px; /* Noapaļoti stūri */
            text-decoration: none; /* No underline */
            font-weight: 600; /* Trekns */
            text-align: center; /* Centrē tekstu */
            transition: all 0.3s ease; /* Animācija */
            border: none; /* No border */
            cursor: pointer; /* Pointer */
            font-size: 13px; /* Teksta izmērs */
            margin: 2px; /* Atstarpe starp pogām */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Ēna */
        } /* Beidzas btn */

        .btn:hover { /* Hover efekts pogām */
            transform: translateY(-2px); /* Paceļ */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15); /* Pastiprina ēnu */
        } /* Beidzas btn:hover */

        .btn-primary { /* Primārā poga */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Gradients */
            color: white; /* Balts teksts */
        } /* Beidzas btn-primary */

        .btn-danger { /* Dzēšanas poga */
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%); /* Sarkans gradients */
            color: white; /* Balts teksts */
        } /* Beidzas btn-danger */

        .btn-warning { /* Brīdinājuma poga */
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); /* Rozā gradients */
            color: white; /* Balts teksts */
        } /* Beidzas btn-warning */

        .btn-success { /* Pozitīvā poga */
            background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%); /* Zaļš gradients */
            color: white; /* Balts teksts */
        } /* Beidzas btn-success */

        .btn-secondary { /* Sekundārā poga */
            background: #6c757d; /* Pelēks fons */
            color: white; /* Balts teksts */
        } /* Beidzas btn-secondary */

        .alert { /* Paziņojuma bloks */
            padding: 15px 20px; /* Iekšējā atstarpe */
            border-radius: 10px; /* Noapaļoti stūri */
            margin-bottom: 20px; /* Atstarpe zem */
            font-weight: 500; /* Pus-trekns */
        } /* Beidzas alert */

        .alert-success { /* Success paziņojums */
            background: linear-gradient(135deg, rgba(86, 171, 47, 0.1) 0%, rgba(168, 230, 207, 0.1) 100%); /* Gaiši zaļš gradients */
            color: #56ab2f; /* Zaļš teksts */
            border: 1px solid rgba(86, 171, 47, 0.2); /* Border */
        } /* Beidzas alert-success */

        .alert-error { /* Error paziņojums */
            background: linear-gradient(135deg, rgba(255, 65, 108, 0.1) 0%, rgba(255, 75, 43, 0.1) 100%); /* Gaiši sarkans gradients */
            color: #ff416c; /* Sarkans teksts */
            border: 1px solid rgba(255, 65, 108, 0.2); /* Border */
        } /* Beidzas alert-error */

        .stats-bar { /* Statistikas josla */
            display: flex; /* Flex */
            justify-content: space-around; /* Izlīdzina */
            background: rgba(102, 126, 234, 0.1); /* Gaiši violets fons */
            padding: 20px; /* Iekšējā atstarpe */
            border-radius: 15px; /* Noapaļoti stūri */
            margin-bottom: 30px; /* Atstarpe zem */
            flex-wrap: wrap; /* Wrap */
        } /* Beidzas stats-bar */

        .stat-item { /* Statistikas elements */
            text-align: center; /* Centrē */
            margin: 10px; /* Atstarpe */
        } /* Beidzas stat-item */

        .stat-number { /* Statistikas skaitlis */
            font-size: 2rem; /* Liels izmērs */
            font-weight: bold; /* Trekns */
            color: #667eea; /* Krāsa */
        } /* Beidzas stat-number */

        .stat-label { /* Statistikas nosaukums */
            color: #666; /* Pelēks */
            font-size: 14px; /* Teksta izmērs */
        } /* Beidzas stat-label */

        @media (max-width: 768px) { /* Responsīvs dizains */
            .header h1 { font-size: 2rem; } /* Mazāks virsraksts */
            .header p { font-size: 1rem; } /* Mazāks apraksts */
            .nav-bar { flex-direction: column; gap: 15px; } /* Navigācija kolonnā */
            .main-content { padding: 20px; } /* Mazāks padding */
            .users-grid { grid-template-columns: 1fr; } /* Viena kolonna */
            .stats-bar { flex-direction: column; } /* Statistika kolonnā */
        } /* Beidzas media query */
    </style> {{-- Beidzas CSS --}}

    <div class="py-12"> {{-- Vertikālais padding (Tailwind) --}}
        <div class="container"> {{-- Centrēts konteineris --}}
            <!-- Header --> {{-- Galvenes sadaļa --}}
            <div class="header"> {{-- Header bloks --}}
                <h1>👥 Lietotāju pārvaldība</h1> {{-- Lapas virsraksts --}}
                <p>Pārvaldiet visus sistēmas lietotājus</p> {{-- Apraksts --}}
            </div> {{-- Beidzas header --}}

            <!-- Navigation --> {{-- Navigācijas josla --}}
            <nav class="nav-bar"> {{-- Navigācija --}}
                <a href="/dashboard" class="nav-brand">🍽️ Recepšu Aplikācija</a> {{-- Logo links uz dashboard --}}
                <div class="nav-links"> {{-- Linku grupa --}}
                    <a href="{{ route('admin.index') }}">🔧 Admin panelis</a> {{-- Links uz admin paneli --}}
                    <a href="{{ route('admin.users') }}">👥 Lietotāji</a> {{-- Links uz lietotājiem --}}
                    <a href="{{ route('admin.recipes') }}">🍽️ Receptes</a> {{-- Links uz receptēm --}}
                    <a href="/dashboard">🏠 Vadības panelis</a> {{-- Links uz dashboard --}}
                </div> {{-- Beidzas linki --}}
                <div style="display: flex; align-items: center; gap: 15px;"> {{-- User info + logout --}}
                    <span style="color: #666; font-weight: 500;">👤 {{ Auth::user()->name }}</span> {{-- Lietotāja vārds --}}
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;"> {{-- Logout forma --}}
                        @csrf {{-- CSRF --}}
                        <button type="submit" class="btn btn-danger" style="padding: 8px 16px; font-size: 12px;">Iziet</button> {{-- Logout poga --}}
                    </form> {{-- Beidzas forma --}}
                </div> {{-- Beidzas user/logout --}}
            </nav> {{-- Beidzas nav --}}

            <!-- Main Content --> {{-- Galvenais saturs --}}
            <div class="main-content"> {{-- Satura kartīte --}}
                <!-- Breadcrumb --> {{-- Maizes drupačas --}}
                <div style="margin-bottom: 30px; padding: 15px; background: rgba(102, 126, 234, 0.1); border-radius: 10px;"> {{-- Breadcrumb konteineris --}}
                    <a href="{{ route('admin.index') }}" style="color: #667eea; text-decoration: none;">🔧 Admin panelis</a> {{-- Links uz admin sākumu --}}
                    <span style="color: #666;"> / </span> {{-- Atdalītājs --}}
                    <span style="color: #333; font-weight: 600;">👥 Lietotāju pārvaldība</span> {{-- Aktīvā sadaļa --}}
                </div> {{-- Beidzas breadcrumb --}}

                <!-- Success/Error Messages --> {{-- Ziņojumi --}}
                @if(session('success')) {{-- Ja success --}}
                    <div class="alert alert-success"> {{-- Success alert --}}
                        ✅ {{ session('success') }} {{-- Izvada tekstu --}}
                    </div> {{-- Beidzas --}}
                @endif {{-- Beidzas if --}}

                @if(session('error')) {{-- Ja error --}}
                    <div class="alert alert-error"> {{-- Error alert --}}
                        ❌ {{ session('error') }} {{-- Izvada tekstu --}}
                    </div> {{-- Beidzas --}}
                @endif {{-- Beidzas if --}}

                <!-- Statistics --> {{-- Statistika --}}
                <div class="stats-bar"> {{-- Statistikas josla --}}
                    <div class="stat-item"> {{-- Stat: kopā --}}
                        <div class="stat-number">{{ $users->total() }}</div> {{-- Kopējais lietotāju skaits (paginācijai) --}}
                        <div class="stat-label">Kopā lietotāju</div> {{-- Apraksts --}}
                    </div> {{-- Beidzas --}}
                    <div class="stat-item"> {{-- Stat: admini --}}
                        <div class="stat-number">{{ $users->where('is_admin', true)->count() }}</div> {{-- Adminu skaits (piezīme: tikai pašreizējā lapa) --}}
                        <div class="stat-label">Administratori</div> {{-- Apraksts --}}
                    </div> {{-- Beidzas --}}
                    <div class="stat-item"> {{-- Stat: parastie --}}
                        <div class="stat-number">{{ $users->where('is_admin', false)->count() }}</div> {{-- Parasto lietotāju skaits (piezīme: tikai pašreizējā lapa) --}}
                        <div class="stat-label">Parastie lietotāji</div> {{-- Apraksts --}}
                    </div> {{-- Beidzas --}}
                    <div class="stat-item"> {{-- Stat: jauni šonedēļ --}}
                        <div class="stat-number">{{ $users->where('created_at', '>=', now()->subDays(7))->count() }}</div> {{-- Jauni (piezīme: tikai pašreizējā lapa) --}}
                        <div class="stat-label">Jauni šonedēļ</div> {{-- Apraksts --}}
                    </div> {{-- Beidzas --}}
                </div> {{-- Beidzas stats-bar --}}

                <!-- Users Grid --> {{-- Lietotāju saraksts --}}
                @if($users->count() > 0) {{-- Ja ir lietotāji --}}
                    <div class="users-grid"> {{-- Grid --}}
                        @foreach($users as $user) {{-- Cikls caur lietotājiem --}}
                            <div class="user-card"> {{-- Lietotāja kartīte --}}
                                <!-- User Badge --> {{-- Loma badge --}}
                                @if($user->is_admin) {{-- Ja admins --}}
                                    <div class="admin-badge">🔧 Administrators</div> {{-- Admin atzīme --}}
                                @else {{-- Citādi --}}
                                    <div class="user-badge">👤 Lietotājs</div> {{-- Lietotāja atzīme --}}
                                @endif {{-- Beidzas if badge --}}

                                <!-- User Info --> {{-- Lietotāja pamatinfo --}}
                                <div style="margin-bottom: 20px;"> {{-- Atstarpe zem info --}}
                                    <h3 style="color: #667eea; margin-bottom: 8px; font-size: 1.3rem;"> {{-- Vārda stils --}}
                                        {{ $user->name }} {{-- Lietotāja vārds --}}
                                    </h3> {{-- Aizver h3 --}}
                                    <p style="color: #666; margin-bottom: 8px;"> {{-- E-pasta stils --}}
                                        📧 {{ $user->email }} {{-- Lietotāja e-pasts --}}
                                    </p> {{-- Aizver p --}}
                                    <div style="display: flex; justify-content: space-between; font-size: 14px; color: #999;"> {{-- Meta rinda --}}
                                        <span>📅 Reģ: {{ $user->created_at->format('d.m.Y') }}</span> {{-- Reģistrācijas datums --}}
                                        <span>🍽️ {{ $user->recipes->count() }} receptes</span> {{-- Recepšu skaits (attiecības count) --}}
                                    </div> {{-- Aizver meta rindu --}}
                                </div> {{-- Beidzas user info --}}

                                <!-- User Stats --> {{-- Papildu statistika --}}
                                <div style="background: rgba(102, 126, 234, 0.05); padding: 15px; border-radius: 10px; margin-bottom: 20px;"> {{-- Stats bloks --}}
                                    <div style="display: flex; justify-content: space-between; font-size: 13px;"> {{-- Rinda: email verified --}}
                                        <span>📧 E-pasts apstiprināts:</span> {{-- Etiķete --}}
                                        <span style="color: {{ $user->email_verified_at ? '#56ab2f' : '#ff416c' }};"> {{-- Krāsa atkarībā no statusa --}}
                                            {{ $user->email_verified_at ? '✅ Jā' : '❌ Nē' }} {{-- Jā/Nē --}}
                                        </span> {{-- Aizver statusu --}}
                                    </div> {{-- Beidzas email verified rinda --}}
                                    <div style="display: flex; justify-content: space-between; font-size: 13px; margin-top: 8px;"> {{-- Rinda: pēdējā aktivitāte --}}
                                        <span>🕒 Pēdējā aktivitāte:</span> {{-- Etiķete --}}
                                        <span>{{ $user->updated_at->diffForHumans() }}</span> {{-- Relatīvais laiks --}}
                                    </div> {{-- Beidzas aktivitātes rinda --}}
                                </div> {{-- Beidzas user stats --}}

                                <!-- Action Buttons --> {{-- Darbības pogas --}}
                                <div style="display: flex; gap: 8px; flex-wrap: wrap;"> {{-- Pogas flex režīmā --}}
                                    <!-- Toggle Admin Status --> {{-- Mainīt admin statusu --}}
                                    @if($user->id !== Auth::id()) {{-- Ja tas nav pašreizējais lietotājs --}}
                                        <form method="POST" action="{{ route('admin.users.toggle-admin', $user) }}" style="display: inline;"> {{-- Forma statusa maiņai --}}
                                            @csrf {{-- CSRF --}}
                                            @method('PATCH') {{-- PATCH metode --}}
                                            <button type="submit" class="btn {{ $user->is_admin ? 'btn-warning' : 'btn-success' }}" onclick="return confirm('Vai tiešām mainīt lietotāja statusu?')"> {{-- Poga ar apstiprinājumu --}}
                                                {{ $user->is_admin ? '🔻 Noņemt admin' : '🔺 Padarīt par admin' }} {{-- Teksts atkarīgs no statusa --}}
                                            </button> {{-- Aizver pogu --}}
                                        </form> {{-- Aizver formu --}}

                                        <!-- Delete User --> {{-- Dzēst lietotāju --}}
                                        @if(!$user->is_admin) {{-- Dzēst drīkst tikai ne-adminus --}}
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display: inline;"> {{-- Dzēšanas forma --}}
                                                @csrf {{-- CSRF --}}
                                                @method('DELETE') {{-- DELETE metode --}}
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Vai tiešām dzēst šo lietotāju? Šī darbība ir neatgriezeniska!')"> {{-- Poga ar confirm --}}
                                                    🗑️ Dzēst {{-- Teksts --}}
                                                </button> {{-- Aizver pogu --}}
                                            </form> {{-- Aizver formu --}}
                                        @endif {{-- Beidzas if delete --}}
                                    @else {{-- Ja tas ir pats lietotājs --}}
                                        <span class="btn btn-secondary" style="cursor: not-allowed; opacity: 0.6;"> {{-- Nespējama poga --}}
                                            👑 Jūs pats {{-- Norāda ka pats sevi nevar mainīt --}}
                                        </span> {{-- Aizver span --}}
                                    @endif {{-- Beidzas if self check --}}

                                    <!-- View User Recipes --> {{-- Skatīt lietotāja receptes --}}
                                    @if($user->recipes->count() > 0) {{-- Ja ir receptes --}}
                                        <a href="/recipes?user={{ $user->id }}" class="btn btn-primary"> {{-- Links uz receptēm pēc lietotāja --}}
                                            👁️ Skatīt receptes ({{ $user->recipes->count() }}) {{-- Teksts ar skaitu --}}
                                        </a> {{-- Aizver linku --}}
                                    @endif {{-- Beidzas if recipes count --}}
                                </div> {{-- Beidzas action buttons --}}
                            </div> {{-- Beidzas user-card --}}
                        @endforeach {{-- Beidzas foreach --}}
                    </div> {{-- Beidzas users-grid --}}

                    <!-- Pagination --> {{-- Lapu šķirošana --}}
                    <div style="margin-top: 40px; display: flex; justify-content: center;"> {{-- Centrē pagināciju --}}
                        {{ $users->links() }} {{-- Laravel paginācijas linki --}}
                    </div> {{-- Beidzas paginācijas bloks --}}
                @else {{-- Ja nav lietotāju --}}
                    <!-- No Users --> {{-- Tukšuma stāvoklis --}}
                    <div style="text-align: center; padding: 60px 20px;"> {{-- Tukšuma konteineris --}}
                        <div style="font-size: 4rem; margin-bottom: 20px; opacity: 0.5;">👥</div> {{-- Ikona --}}
                        <h3 style="color: #666; margin-bottom: 15px;">Nav lietotāju</h3> {{-- Virsraksts --}}
                        <p style="color: #999;">Nav atrasts neviens lietotājs sistēmā.</p> {{-- Teksts --}}
                    </div> {{-- Beidzas tukšuma bloks --}}
                @endif {{-- Beidzas if users count --}}

                <!-- Quick Actions --> {{-- Ātrās darbības --}}
                <div style="margin-top: 40px; padding: 30px; background: rgba(102, 126, 234, 0.05); border-radius: 15px;"> {{-- Quick actions konteineris --}}
                    <h3 style="text-align: center; color: #667eea; margin-bottom: 25px;">🚀 Ātras darbības</h3> {{-- Virsraksts --}}
                    <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;"> {{-- Pogas --}}
                        <a href="{{ route('admin.index') }}" class="btn btn-primary"> {{-- Links uz admin paneli --}}
                            🔧 Admin panelis {{-- Teksts --}}
                        </a> {{-- Beidzas link --}}
                        <a href="{{ route('admin.recipes') }}" class="btn btn-success"> {{-- Links uz recepšu pārvaldību --}}
                            🍽️ Pārvaldīt receptes {{-- Teksts --}}
                        </a> {{-- Beidzas link --}}
                        <a href="/dashboard" class="btn btn-secondary"> {{-- Links uz dashboard --}}
                            🏠 Vadības panelis {{-- Teksts --}}
                        </a> {{-- Beidzas link --}}
                    </div> {{-- Beidzas pogu rinda --}}
                </div> {{-- Beidzas quick actions --}}
            </div> {{-- Beidzas main-content --}}
        </div> {{-- Beidzas container --}}
    </div> {{-- Beidzas py-12 --}}
</x-app-layout> {{-- Aizver layout --}}
