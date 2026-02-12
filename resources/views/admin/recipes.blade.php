<x-app-layout> {{-- Izmanto aplikācijas pamata layout (Jetstream/Breeze) --}}
    <x-slot name="header"> {{-- Aizpilda layout header slotu --}}
        <h2 class="font-semibold text-xl text-black leading-tight"> {{-- Header virsraksta stils --}}
            {{ __('Recepšu pārvaldība - Vecmāmiņas Receptes') }} {{-- Lokalizējams virsraksts --}}
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
            display: flex; /* Flex layout */
            justify-content: space-between; /* Elementi abās pusēs */
            align-items: center; /* Vertikāli centrē */
            flex-wrap: wrap; /* Pārliekas jaunā rindā */
        } /* Beidzas nav-bar stils */

        .nav-brand { /* Navigācijas zīmols/logo */
            font-size: 24px; /* Izmērs */
            font-weight: bold; /* Trekns */
            color: #667eea; /* Krāsa */
            text-decoration: none; /* Noņem underline */
        } /* Beidzas nav-brand stils */

        .nav-links { /* Linku grupa */
            display: flex; /* Flex izkārtojums */
            gap: 20px; /* Atstarpe starp linkiem */
            flex-wrap: wrap; /* Atļauj pārkārtošanu */
        } /* Beidzas nav-links stils */

        .nav-links a { /* Katrs navigācijas links */
            color: #333; /* Teksta krāsa */
            text-decoration: none; /* Noņem underline */
            padding: 8px 16px; /* Iekšējā atstarpe */
            border-radius: 8px; /* Noapaļoti stūri */
            transition: all 0.3s ease; /* Animācija */
            font-weight: 500; /* Pus-trekns */
        } /* Beidzas nav-links a stils */

        .nav-links a:hover { /* Linka hover efekts */
            background: #667eea; /* Fons hover */
            color: white; /* Teksts balts hover */
            transform: translateY(-2px); /* Paceļ elementu */
        } /* Beidzas hover stils */

        .main-content { /* Galvenais satura bloks */
            background: rgba(255, 255, 255, 0.95); /* Puscaurspīdīgs balts fons */
            backdrop-filter: blur(10px); /* Blur efekts */
            border-radius: 20px; /* Noapaļoti stūri */
            padding: 40px; /* Iekšējā atstarpe */
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1); /* Ēna */
            border: 1px solid rgba(255, 255, 255, 0.2); /* Viegls border */
        } /* Beidzas main-content stils */

        .recipes-grid { /* Recepšu kartīšu režģis */
            display: grid; /* Grid */
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); /* Kolonnas pēc platuma */
            gap: 25px; /* Atstarpe starp kartēm */
            margin-top: 30px; /* Atstarpe virs režģa */
        } /* Beidzas recipes-grid stils */

        .recipe-card { /* Recepšu kartīte */
            background: white; /* Balts fons */
            border-radius: 15px; /* Noapaļoti stūri */
            padding: 25px; /* Iekšējā atstarpe */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); /* Ēna */
            transition: all 0.3s ease; /* Animācija */
            border: 1px solid rgba(255, 255, 255, 0.3); /* Viegls border */
        } /* Beidzas recipe-card stils */

        .recipe-card:hover { /* Hover efekts kartītei */
            transform: translateY(-5px); /* Paceļ karti */
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15); /* Pastiprina ēnu */
        } /* Beidzas recipe-card:hover */

        .btn { /* Pogu pamatstils */
            display: inline-block; /* Inline-block */
            padding: 10px 20px; /* Iekšējā atstarpe */
            border-radius: 8px; /* Noapaļoti stūri */
            text-decoration: none; /* No underline */
            font-weight: 600; /* Trekns */
            text-align: center; /* Centrē tekstu */
            transition: all 0.3s ease; /* Animācija */
            border: none; /* Noņem border */
            cursor: pointer; /* Pointer */
            font-size: 13px; /* Teksta izmērs */
            margin: 2px; /* Neliela atstarpe starp pogām */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Ēna */
        } /* Beidzas btn stils */

        .btn:hover { /* Hover efekts pogām */
            transform: translateY(-2px); /* Paceļ pogu */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15); /* Pastiprina ēnu */
        } /* Beidzas btn:hover */

        .btn-primary { /* Primārā poga */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Gradients */
            color: white; /* Balts teksts */
        } /* Beidzas btn-primary */

        .btn-danger { /* Bīstamā (dzēst) poga */
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%); /* Sarkans gradients */
            color: white; /* Balts teksts */
        } /* Beidzas btn-danger */

        .btn-success { /* Pozitīvā (rediģēt) poga */
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
            margin-bottom: 20px; /* Atstarpe zem paziņojuma */
            font-weight: 500; /* Pus-trekns */
        } /* Beidzas alert */

        .alert-success { /* Veiksmes paziņojums */
            background: linear-gradient(135deg, rgba(86, 171, 47, 0.1) 0%, rgba(168, 230, 207, 0.1) 100%); /* Gaiši zaļš gradients */
            color: #56ab2f; /* Zaļš teksts */
            border: 1px solid rgba(86, 171, 47, 0.2); /* Zaļgans border */
        } /* Beidzas alert-success */

        .stats-bar { /* Statistikas josla */
            display: flex; /* Flex */
            justify-content: space-around; /* Vienmērīgi sadala */
            background: rgba(102, 126, 234, 0.1); /* Gaiši violets fons */
            padding: 20px; /* Iekšējā atstarpe */
            border-radius: 15px; /* Noapaļoti stūri */
            margin-bottom: 30px; /* Atstarpe zem joslas */
            flex-wrap: wrap; /* Wrap uz mobilajiem */
        } /* Beidzas stats-bar */

        .stat-item { /* Viens statistikas elements */
            text-align: center; /* Centrē */
            margin: 10px; /* Atstarpe apkārt */
        } /* Beidzas stat-item */

        .stat-number { /* Statistikas skaitlis */
            font-size: 2rem; /* Liels izmērs */
            font-weight: bold; /* Trekns */
            color: #667eea; /* Zilvioleta krāsa */
        } /* Beidzas stat-number */

        .stat-label { /* Statistikas nosaukums */
            color: #666; /* Pelēks teksts */
            font-size: 14px; /* Mazāks izmērs */
        } /* Beidzas stat-label */

        @media (max-width: 768px) { /* Responsīvi noteikumi mazākiem ekrāniem */
            .header h1 { font-size: 2rem; } /* Mazāks virsraksts */
            .header p { font-size: 1rem; } /* Mazāks apraksts */
            .nav-bar { flex-direction: column; gap: 15px; } /* Navigācija kolonnā */
            .main-content { padding: 20px; } /* Mazāks padding */
            .recipes-grid { grid-template-columns: 1fr; } /* Viena kolonna */
            .stats-bar { flex-direction: column; } /* Statistika kolonnā */
        } /* Beidzas media query */
    </style> {{-- Beidzas CSS --}}

    <div class="py-12"> {{-- Vertikālais padding (Tailwind) --}}
        <div class="container"> {{-- Centrēts konteineris --}}
            <!-- Header --> {{-- Galvenes sadaļa --}}
            <div class="header"> {{-- Header bloks --}}
                <h1>🍽️ Recepšu pārvaldība</h1> {{-- Lapas virsraksts --}}
                <p>Pārvaldiet visas sistēmas receptes</p> {{-- Apraksts --}}
            </div> {{-- Beidzas header --}}

            <!-- Navigation --> {{-- Navigācijas josla --}}
            <nav class="nav-bar"> {{-- Navigācija --}}
                <a href="/dashboard" class="nav-brand">🍽️ Recepšu Aplikācija</a> {{-- Logo links uz dashboard --}}
                <div class="nav-links"> {{-- Linku grupa --}}
                    <a href="{{ route('admin.index') }}">🔧 Admin panelis</a> {{-- Links uz admin paneli --}}
                    <a href="{{ route('admin.users') }}">👥 Lietotāji</a> {{-- Links uz lietotāju pārvaldību --}}
                    <a href="{{ route('admin.recipes') }}">🍽️ Receptes</a> {{-- Links uz recepšu pārvaldību --}}
                    <a href="/dashboard">🏠 Vadības panelis</a> {{-- Links atpakaļ uz dashboard --}}
                </div> {{-- Beidzas linku grupa --}}
                <div style="display: flex; align-items: center; gap: 15px;"> {{-- Lietotāja info + logout rinda (inline stils) --}}
                    <span style="color: #666; font-weight: 500;">👤 {{ Auth::user()->name }}</span> {{-- Parāda pieslēgto lietotāju --}}
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;"> {{-- Logout forma --}}
                        @csrf {{-- CSRF aizsardzība --}}
                        <button type="submit" class="btn btn-danger" style="padding: 8px 16px; font-size: 12px;">Iziet</button> {{-- Logout poga --}}
                    </form> {{-- Beidzas logout forma --}}
                </div> {{-- Beidzas user/logout rinda --}}
            </nav> {{-- Beidzas navigācija --}}

            <!-- Main Content --> {{-- Galvenais saturs --}}
            <div class="main-content"> {{-- Satura kartīte --}}
                <!-- Breadcrumb --> {{-- Maizes drupačas navigācija --}}
                <div style="margin-bottom: 30px; padding: 15px; background: rgba(102, 126, 234, 0.1); border-radius: 10px;"> {{-- Breadcrumb konteineris --}}
                    <a href="{{ route('admin.index') }}" style="color: #667eea; text-decoration: none;">🔧 Admin panelis</a> {{-- Links uz admin sākumu --}}
                    <span style="color: #666;"> / </span> {{-- Atdalītājs --}}
                    <span style="color: #333; font-weight: 600;">🍽️ Recepšu pārvaldība</span> {{-- Aktīvā sadaļa --}}
                </div> {{-- Beidzas breadcrumb --}}

                <!-- Success Messages --> {{-- Veiksmes ziņojumi --}}
                @if(session('success')) {{-- Ja ir success ziņa --}}
                    <div class="alert alert-success"> {{-- Success alert bloks --}}
                        ✅ {{ session('success') }} {{-- Izvada success ziņu --}}
                    </div> {{-- Beidzas success alert --}}
                @endif {{-- Beidzas if success --}}

                <!-- Statistics --> {{-- Statistikas sadaļa --}}
                <div class="stats-bar"> {{-- Statistikas josla --}}
                    @php /* Blade PHP bloks */
                        $categories = \App\Models\Recipe::distinct('category')->pluck('category')->filter(); /* Unikālās kategorijas */
                        $difficulties = \App\Models\Recipe::distinct('difficulty')->pluck('difficulty')->filter(); /* Unikālās grūtības (šobrīd netiek izmantots) */
                    @endphp {{-- Beidzas php bloks --}}
                    <div class="stat-item"> {{-- Stat: kopā recepšu --}}
                        <div class="stat-number">{{ $recipes->total() }}</div> {{-- Kopējais recepšu skaits (paginācijai) --}}
                        <div class="stat-label">Kopā recepšu</div> {{-- Apraksts --}}
                    </div> {{-- Beidzas stat-item --}}
                    <div class="stat-item"> {{-- Stat: kategorijas --}}
                        <div class="stat-number">{{ $categories->count() }}</div> {{-- Kategoriju skaits --}}
                        <div class="stat-label">Kategorijas</div> {{-- Apraksts --}}
                    </div> {{-- Beidzas stat-item --}}
                    <div class="stat-item"> {{-- Stat: jaunas šonedēļ --}}
                        <div class="stat-number">{{ $recipes->where('created_at', '>=', now()->subDays(7))->count() }}</div> {{-- Skaits no kolekcijas pēdējās 7 dienās (piezīme: tikai pašreizējā lapa) --}}
                        <div class="stat-label">Jaunas šonedēļ</div> {{-- Apraksts --}}
                    </div> {{-- Beidzas stat-item --}}
                    <div class="stat-item"> {{-- Stat: aktīvi autori --}}
                        <div class="stat-number">{{ \App\Models\User::has('recipes')->count() }}</div> {{-- Lietotāji, kam ir vismaz 1 recepte --}}
                        <div class="stat-label">Aktīvi autori</div> {{-- Apraksts --}}
                    </div> {{-- Beidzas stat-item --}}
                </div> {{-- Beidzas stats-bar --}}

                <!-- Recipes Grid --> {{-- Recepšu saraksts --}}
                @if($recipes->count() > 0) {{-- Ja ir receptes --}}
                    <div class="recipes-grid"> {{-- Grid ar kartītēm --}}
                        @foreach($recipes as $recipe) {{-- Iterē cauri receptēm --}}
                            <div class="recipe-card"> {{-- Viena recepte kartītē --}}
                                <!-- Recipe Header --> {{-- Kartītes virsraksta daļa --}}
                                <div style="margin-bottom: 15px;"> {{-- Atstarpe zem header --}}
                                    <h3 style="color: #667eea; margin-bottom: 8px; font-size: 1.3rem;"> {{-- Receptes nosaukuma stils --}}
                                        {{ $recipe->title }} {{-- Receptes nosaukums --}}
                                    </h3> {{-- Aizver h3 --}}
                                    <p style="color: #666; line-height: 1.5; margin-bottom: 10px;"> {{-- Apraksta stils --}}
                                        {{ Str::limit($recipe->description, 100) }} {{-- Saīsina aprakstu līdz 100 simboliem --}}
                                    </p> {{-- Aizver p --}}
                                </div> {{-- Beidzas recipe header --}}

                                <!-- Recipe Meta --> {{-- Receptes metadati --}}
                                <div style="background: rgba(102, 126, 234, 0.05); padding: 15px; border-radius: 10px; margin-bottom: 15px;"> {{-- Meta bloks --}}
                                    <div style="display: flex; justify-content: space-between; font-size: 14px; margin-bottom: 8px;"> {{-- Rinda: autors --}}
                                        <span style="color: #666;">👨‍🍳 Autors:</span> {{-- Etiķete --}}
                                        <span style="font-weight: 600;">{{ $recipe->user->name }}</span> {{-- Autora vārds --}}
                                    </div> {{-- Beidzas autors rinda --}}
                                    <div style="display: flex; justify-content: space-between; font-size: 14px; margin-bottom: 8px;"> {{-- Rinda: kategorija --}}
                                        <span style="color: #666;">📂 Kategorija:</span> {{-- Etiķete --}}
                                        <span style="background: rgba(102, 126, 234, 0.1); color: #667eea; padding: 2px 8px; border-radius: 10px; font-size: 12px;"> {{-- Badge stils --}}
                                            {{ $recipe->category ?? 'Nav norādīta' }} {{-- Kategorija vai fallback --}}
                                        </span> {{-- Aizver badge --}}
                                    </div> {{-- Beidzas kategorija rinda --}}
                                    <div style="display: flex; justify-content: space-between; font-size: 14px; margin-bottom: 8px;"> {{-- Rinda: grūtība --}}
                                        <span style="color: #666;">📊 Grūtība:</span> {{-- Etiķete --}}
                                        <span style="background: rgba(255, 65, 108, 0.1); color: #ff416c; padding: 2px 8px; border-radius: 10px; font-size: 12px;"> {{-- Badge stils --}}
                                            {{ $recipe->difficulty ?? 'N/A' }} {{-- Grūtības līmenis vai fallback --}}
                                        </span> {{-- Aizver badge --}}
                                    </div> {{-- Beidzas grūtība rinda --}}
                                    <div style="display: flex; justify-content: space-between; font-size: 14px;"> {{-- Rinda: izveidots --}}
                                        <span style="color: #666;">📅 Izveidots:</span> {{-- Etiķete --}}
                                        <span>{{ $recipe->created_at->format('d.m.Y H:i') }}</span> {{-- Izveidošanas datums --}}
                                    </div> {{-- Beidzas datuma rinda --}}
                                </div> {{-- Beidzas meta bloks --}}

                                <!-- Recipe Stats --> {{-- Īsā statistika --}}
                                <div style="display: flex; justify-content: space-between; font-size: 13px; color: #999; margin-bottom: 20px;"> {{-- Stats rinda --}}
                                    <span>⏱️ {{ $recipe->prep_time ?? 'N/A' }} min</span> {{-- Pagatavošanas laiks --}}
                                    <span>👥 {{ $recipe->servings ?? 'N/A' }} porcijas</span> {{-- Porciju skaits --}}
                                    <span>🕒 {{ $recipe->created_at->diffForHumans() }}</span> {{-- Relatīvais laiks --}}
                                </div> {{-- Beidzas stats rinda --}}

                                <!-- Action Buttons --> {{-- Darbību pogas --}}
                                <div style="display: flex; gap: 8px; flex-wrap: wrap;"> {{-- Pogas rindā ar wrap --}}
                                    <!-- View Recipe --> {{-- Skatīt recepti --}}
                                    <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary"> {{-- Links uz receptes skatu --}}
                                        👁️ Skatīt {{-- Teksts --}}
                                    </a> {{-- Beidzas skatīt poga --}}

                                    <!-- Edit Recipe (if admin or owner) --> {{-- Rediģēt, ja ir tiesības --}}
                                    @if(Auth::user()->is_admin || $recipe->user_id === Auth::id()) {{-- Ja admins vai receptes īpašnieks --}}
                                        <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-success"> {{-- Links uz rediģēšanu --}}
                                            ✏️ Rediģēt {{-- Teksts --}}
                                        </a> {{-- Beidzas rediģēt poga --}}
                                    @endif {{-- Beidzas if rediģēšana --}}

                                    <!-- Delete Recipe --> {{-- Dzēst recepti --}}
                                    <form method="POST" action="{{ route('admin.recipes.destroy', $recipe) }}" style="display: inline;"> {{-- Dzēšanas forma --}}
                                        @csrf {{-- CSRF token --}}
                                        @method('DELETE') {{-- HTTP metodes spoofing uz DELETE --}}
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Vai tiešām dzēst šo recepti? Šī darbība ir neatgriezeniska!')"> {{-- Dzēšanas poga ar confirm --}}
                                            🗑️ Dzēst {{-- Teksts --}}
                                        </button> {{-- Beidzas dzēst poga --}}
                                    </form> {{-- Beidzas dzēšanas forma --}}

                                    <!-- View Author --> {{-- Skatīt autora receptes --}}
                                    <a href="/recipes?user={{ $recipe->user->id }}" class="btn btn-secondary"> {{-- Links uz filtru pēc autora --}}
                                        👤 Autora receptes {{-- Teksts --}}
                                    </a> {{-- Beidzas autora poga --}}
                                </div> {{-- Beidzas action buttons --}}
                            </div> {{-- Beidzas recipe-card --}}
                        @endforeach {{-- Beidzas foreach --}}
                    </div> {{-- Beidzas recipes-grid --}}

                    <!-- Pagination --> {{-- Lapu šķirošana --}}
                    <div style="margin-top: 40px; display: flex; justify-content: center;"> {{-- Centrē pagināciju --}}
                        {{ $recipes->links() }} {{-- Laravel paginācijas linki --}}
                    </div> {{-- Beidzas paginācijas bloks --}}
                @else {{-- Ja nav recepšu --}}
                    <!-- No Recipes --> {{-- Tukšuma stāvoklis --}}
                    <div style="text-align: center; padding: 60px 20px;"> {{-- Centrēts tukšuma saturs --}}
                        <div style="font-size: 4rem; margin-bottom: 20px; opacity: 0.5;">🍽️</div> {{-- Ikona --}}
                        <h3 style="color: #666; margin-bottom: 15px;">Nav recepšu</h3> {{-- Virsraksts --}}
                        <p style="color: #999;">Nav atrasta neviena recepte sistēmā.</p> {{-- Apraksts --}}
                    </div> {{-- Beidzas tukšuma bloks --}}
                @endif {{-- Beidzas if recipes count --}}

                <!-- Quick Actions --> {{-- Ātrās darbības --}}
                <div style="margin-top: 40px; padding: 30px; background: rgba(102, 126, 234, 0.05); border-radius: 15px;"> {{-- Quick actions konteineris --}}
                    <h3 style="text-align: center; color: #667eea; margin-bottom: 25px;">🚀 Ātras darbības</h3> {{-- Virsraksts --}}
                    <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;"> {{-- Pogas flex režīmā --}}
                        <a href="{{ route('admin.index') }}" class="btn btn-primary"> {{-- Links uz admin paneli --}}
                            🔧 Admin panelis {{-- Teksts --}}
                        </a> {{-- Beidzas poga --}}
                        <a href="{{ route('admin.users') }}" class="btn btn-success"> {{-- Links uz lietotājiem --}}
                            👥 Pārvaldīt lietotājus {{-- Teksts --}}
                        </a> {{-- Beidzas poga --}}
                        <a href="/recipes" class="btn btn-secondary"> {{-- Links uz visām receptēm --}}
                            🔍 Skatīt visas receptes {{-- Teksts --}}
                        </a> {{-- Beidzas poga --}}
                        <a href="/dashboard" class="btn btn-secondary"> {{-- Links uz dashboard --}}
                            🏠 Vadības panelis {{-- Teksts --}}
                        </a> {{-- Beidzas poga --}}
                    </div> {{-- Beidzas pogu rinda --}}
                </div> {{-- Beidzas quick actions --}}
            </div> {{-- Beidzas main-content --}}
        </div> {{-- Beidzas container --}}
    </div> {{-- Beidzas py-12 --}}
</x-app-layout> {{-- Aizver layout --}}
