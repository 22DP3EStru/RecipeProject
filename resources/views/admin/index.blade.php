<x-app-layout> {{-- Izmanto aplikācijas pamata layout (Jetstream/Breeze) --}}
    <x-slot name="header"> {{-- Aizpilda layout header slotu --}}
        <h2 class="font-semibold text-xl text-black leading-tight"> {{-- Virsraksts ar Tailwind stiliem --}}
            {{ __('Administrācijas panelis - Vecmāmiņas Receptes') }} {{-- Lokalizējams virsraksts --}}
        </h2> {{-- Aizver virsrakstu --}}
    </x-slot> {{-- Aizver header slotu --}}

    {{-- Iekšējie CSS stili šai lapai --}}
    <style>
        /* Dashboard Style Design */ /* Paneļa dizaina stili */
        * { /* Attiecas uz visiem elementiem */
            margin: 0; /* Noņem ārējās atstarpes */
            padding: 0; /* Noņem iekšējās atstarpes */
            box-sizing: border-box; /* Iekļauj padding/border elementa izmērā */
        } /* Beidzas universālais selektors */

        body { /* Lapas pamatstils */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fonts */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Fona gradients */
            min-height: 100vh; /* Minimālais augstums – pilns ekrāns */
            color: #333; /* Teksta krāsa */
        } /* Beidzas body stils */

        .container { /* Galvenais konteineris */
            max-width: 1200px; /* Maksimālais platums */
            margin: 0 auto; /* Centrē horizontāli */
            padding: 20px; /* Iekšējā atstarpe */
        } /* Beidzas container stils */

        .header { /* Header bloks */
            text-align: center; /* Centrē tekstu */
            color: white; /* Balts teksts */
            margin-bottom: 40px; /* Atstarpe zem header */
            padding: 40px 0; /* Vertikālais padding */
        } /* Beidzas header stils */

        .header h1 { /* Header virsraksts */
            font-size: 3rem; /* Virsraksta izmērs */
            margin-bottom: 15px; /* Atstarpe zem virsraksta */
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3); /* Teksta ēna */
        } /* Beidzas header h1 stils */

        .main-content { /* Galvenā satura kartīte */
            background: rgba(255, 255, 255, 0.95); /* Puscaurspīdīgs balts fons */
            backdrop-filter: blur(10px); /* Blur efekts */
            border-radius: 20px; /* Noapaļoti stūri */
            padding: 40px; /* Iekšējā atstarpe */
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1); /* Ēna */
            border: 1px solid rgba(255, 255, 255, 0.2); /* Viegls border */
        } /* Beidzas main-content stils */

        .stats-grid { /* Statistikas režģis */
            display: grid; /* Grid izkārtojums */
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Elastīgas kolonnas */
            gap: 20px; /* Atstarpe starp kartītēm */
            margin-bottom: 40px; /* Atstarpe zem grid */
        } /* Beidzas stats-grid stils */

        .stat-card { /* Statistikas kartīte */
            background: white; /* Balts fons */
            padding: 25px; /* Iekšējā atstarpe */
            border-radius: 15px; /* Noapaļoti stūri */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); /* Ēna */
            text-align: center; /* Centrē tekstu */
        } /* Beidzas stat-card stils */

        .btn { /* Pogas pamata stils */
            display: inline-block; /* Inline-block poga */
            padding: 12px 25px; /* Iekšējā atstarpe */
            border-radius: 10px; /* Noapaļoti stūri */
            text-decoration: none; /* Noņem underline linkiem */
            font-weight: 600; /* Treknāks teksts */
            text-align: center; /* Centrē tekstu */
            transition: all 0.3s ease; /* Animācija */
            border: none; /* Noņem border */
            cursor: pointer; /* Pointer kursors */
            font-size: 14px; /* Teksta izmērs */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Ēna */
        } /* Beidzas btn stils */

        .btn-primary { /* Primārā poga */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Gradients */
            color: white; /* Balts teksts */
        } /* Beidzas btn-primary stils */
    </style> {{-- Beidzas CSS --}}

    <div class="py-12"> {{-- Vertikālais padding (Tailwind) --}}
        <div class="container"> {{-- Lapai centrēts konteineris --}}
            <div class="header"> {{-- Header daļa --}}
                <h1>🔧 Administrācijas panelis</h1> {{-- Lapas virsraksts --}}
                <p>Pārvaldiet lietotājus un receptes</p> {{-- Apakšteksts --}}
            </div> {{-- Beidzas header --}}

            <div class="main-content"> {{-- Galvenais saturs --}}
                <div class="stats-grid"> {{-- Statistikas kartītes --}}
                    <div class="stat-card"> {{-- Kartīte: lietotāji --}}
                        <h3>👥 Lietotāji</h3> {{-- Kartītes virsraksts --}}
                        <p style="font-size: 2rem; color: #667eea; margin: 10px 0;">{{ $totalUsers }}</p> {{-- Izvada lietotāju skaitu --}}
                        <a href="{{ route('admin.users') }}" class="btn btn-primary">Pārvaldīt</a> {{-- Links uz admin.users --}}
                    </div> {{-- Beidzas kartīte: lietotāji --}}

                    <div class="stat-card"> {{-- Kartīte: receptes --}}
                        <h3>🍽️ Receptes</h3> {{-- Kartītes virsraksts --}}
                        <p style="font-size: 2rem; color: #667eea; margin: 10px 0;">{{ $totalRecipes }}</p> {{-- Izvada recepšu skaitu --}}
                        <a href="{{ route('admin.recipes') }}" class="btn btn-primary">Pārvaldīt</a> {{-- Links uz admin.recipes --}}
                    </div> {{-- Beidzas kartīte: receptes --}}

                    <div class="stat-card"> {{-- Kartīte: administratori --}}
                        <h3>🔧 Administratori</h3> {{-- Kartītes virsraksts --}}
                        <p style="font-size: 2rem; color: #667eea; margin: 10px 0;">{{ $totalAdmins }}</p> {{-- Izvada adminu skaitu --}}
                    </div> {{-- Beidzas kartīte: administratori --}}
                </div> {{-- Beidzas stats-grid --}}

                <a href="/dashboard" class="btn btn-primary">← Atpakaļ uz vadības paneli</a> {{-- Poga atpakaļ uz /dashboard --}}
            </div> {{-- Beidzas main-content --}}
        </div> {{-- Beidzas container --}}
    </div> {{-- Beidzas py-12 --}}
</x-app-layout> {{-- Beidzas layout --}}
