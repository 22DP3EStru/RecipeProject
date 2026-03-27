@extends('layouts.app')
@section('title', 'Administrācijas panelis')

@section('content')

    {{-- Alerts --}}
    @if(session('success'))
        <div class="card" style="border-left: 6px solid #56ab2f;">
            <div style="font-weight: 700; color: #2f855a;">✅ {{ session('success') }}</div>
        </div>
    @endif

    @if(session('error'))
        <div class="card" style="border-left: 6px solid #f5576c;">
            <div style="font-weight: 700; color: #c53030;">❌ {{ session('error') }}</div>
        </div>
    @endif

    {{-- Stats --}}
    <div class="card">
        <h3 class="card-title">📊 Kopsavilkums</h3>

        <div class="stats-grid">
            <div class="stat-box">
                <span class="stat-number">{{ $usersCount }}</span>
                <span class="stat-label">Kopā lietotāji</span>
            </div>

            <div class="stat-box">
                <span class="stat-number">{{ $recipesCount }}</span>
                <span class="stat-label">Kopā receptes</span>
            </div>

            <div class="stat-box">
                <span class="stat-number">{{ $adminsCount }}</span>
                <span class="stat-label">Admini</span>
            </div>

            <div class="stat-box">
                <span class="stat-number">{{ $todayRecipesCount ?? 0 }}</span>
                <span class="stat-label">Šodienas receptes</span>
            </div>
        </div>

        <div class="grid grid-2" style="margin-top: 16px;">
            <a class="btn btn-primary" href="{{ route('admin.users') }}">Pārvaldīt lietotājus</a>
            <a class="btn btn-success" href="{{ route('admin.recipes') }}">Pārvaldīt receptes</a>
        </div>
    </div>
    <div style="margin: 12px 0 20px 0; display:flex; gap:10px; flex-wrap:wrap;">
    <a href="{{ route('pdf.admin.statistics') }}"
       style="display:inline-block; padding:10px 14px; background:#fff; color:#333; border:1px solid #ccc; border-radius:8px; text-decoration:none; font-size:14px; font-weight:600;">
        Statistikas PDF
    </a>

    <a href="{{ route('pdf.popular.recipes') }}"
       style="display:inline-block; padding:10px 14px; background:#fff; color:#333; border:1px solid #ccc; border-radius:8px; text-decoration:none; font-size:14px; font-weight:600;">
        Populārākās receptes PDF
    </a>
</div>
    {{-- Latest activity --}}
    <div class="grid grid-2">
        <div class="card">
            <h3 class="card-title">👤 Jaunākie lietotāji</h3>

            @forelse($latestUsers as $user)
                <div style="display:flex; justify-content:space-between; gap:16px; padding:12px 0; border-bottom:1px solid rgba(0,0,0,0.06);">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <div style="height:42px; width:42px; border-radius:50%; background: rgba(102,126,234,0.15); display:flex; align-items:center; justify-content:center; font-weight:900; color:#667eea;">
                            {{ strtoupper(substr($user->name ?? '—', 0, 1)) }}
                        </div>

                        <div>
                            <div style="font-weight: 900;">{{ $user->name ?? '—' }}</div>
                            <div style="opacity:.75; font-size:14px;">{{ $user->email }}</div>

                            @if($user->is_admin)
                                <span style="display:inline-block; margin-top:6px; font-size:12px; padding:4px 10px; border-radius:999px; background: rgba(245,87,108,0.14); color:#f5576c; font-weight:900;">
                                    Admin
                                </span>
                            @endif
                        </div>
                    </div>

                    <div style="opacity:.7; font-size:14px; white-space:nowrap;">
                        {{ $user->created_at->diffForHumans() }}
                    </div>
                </div>
            @empty
                <div style="opacity:.75;">Nav lietotāju.</div>
            @endforelse
        </div>

        <div class="card">
            <h3 class="card-title">🍽️ Jaunākās receptes</h3>

            @forelse($latestRecipes as $recipe)
                <div style="display:flex; justify-content:space-between; gap:16px; padding:12px 0; border-bottom:1px solid rgba(0,0,0,0.06);">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <div style="height:42px; width:42px; border-radius:12px; background: rgba(240,147,251,0.18); display:flex; align-items:center; justify-content:center;">
                            🍽️
                        </div>

                        <div>
                            <div style="font-weight: 900;">{{ $recipe->title }}</div>
                            <div style="opacity:.75; font-size:14px;">
                                Autors: {{ optional($recipe->user)->name ?? '—' }}
                            </div>
                        </div>
                    </div>

                    <div style="opacity:.7; font-size:14px; white-space:nowrap;">
                        {{ $recipe->created_at->diffForHumans() }}
                    </div>
                </div>
            @empty
                <div style="opacity:.75;">Nav recepšu.</div>
            @endforelse
        </div>
    </div>

    {{-- Quick actions --}}
    <div class="card">
        <h3 class="card-title">⚡ Ātrās darbības</h3>

        <div class="grid grid-2" style="margin-top: 10px;">
            <a class="btn btn-primary" href="{{ route('admin.users') }}">Manage Users</a>
            <a class="btn btn-success" href="{{ route('admin.recipes') }}">Manage Recipes</a>
        </div>
    </div>

@endsection