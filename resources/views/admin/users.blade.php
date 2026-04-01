@extends('layouts.app')

@section('content')
    <style>
        :root {
            --page-bg: #efe7dc;
            --section-bg: #f8f3ed;
            --card-bg: #fffdf9;
            --soft-bg: #f2ebe2;
            --line: #ddcfc0;
            --text: #2f241d;
            --muted: #7b6d61;
            --accent: #7a5a43;
            --accent-soft: #ebe0d2;
            --success-bg: #e8eee2;
            --success-text: #667652;
            --danger-bg: #f3e2de;
            --danger-text: #a45f52;
            --warning-bg: #efe7dc;
            --warning-text: #8a6545;
            --shadow: 0 10px 30px rgba(79, 59, 42, 0.05);
        }

        .admin-users-page {
            background: var(--page-bg);
            min-height: 100vh;
            padding: 36px 24px 60px;
            color: var(--text);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .admin-users-wrap {
            max-width: 1280px;
            margin: 0 auto;
        }

        .page-shell {
            background: var(--section-bg);
            border: 1px solid var(--line);
            padding: 36px;
            box-shadow: var(--shadow);
        }

        .breadcrumb {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 28px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--line);
        }

        .breadcrumb a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 34px;
        }

        .stat-box {
            background: var(--accent-soft);
            border: 1px solid var(--line);
            padding: 24px 18px;
            text-align: center;
        }

        .stat-number {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.4rem;
            color: var(--accent);
            margin-bottom: 8px;
            font-weight: 700;
        }

        .stat-label {
            color: var(--muted);
            font-size: 14px;
        }

        .users-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 26px;
        }

        .user-card {
            background: var(--card-bg);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .user-header {
            padding: 22px 24px 16px;
            border-bottom: 1px solid #e8ddd1;
            background: #fcf9f4;
        }

        .role-badge {
            display: inline-block;
            padding: 5px 10px;
            border: 1px solid var(--line);
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 12px;
            background: #f4ece2;
            color: var(--accent);
        }

        .role-badge.admin {
            background: #efe4d8;
            color: var(--accent);
        }

        .role-badge.user {
            background: #edf2e7;
            color: #667652;
            border-color: #d7dfcc;
        }

        .user-name {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            color: var(--accent);
            font-weight: 500;
            line-height: 1.2;
            margin-bottom: 8px;
        }

        .user-email {
            color: var(--muted);
            font-size: 15px;
            margin-bottom: 10px;
        }

        .user-meta-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            font-size: 14px;
            color: var(--muted);
        }

        .user-body {
            padding: 22px 24px 24px;
        }

        .meta-table {
            width: 100%;
            border: 1px solid var(--line);
            background: var(--soft-bg);
            margin-bottom: 18px;
        }

        .meta-row {
            display: grid;
            grid-template-columns: 180px 1fr;
            padding: 12px 14px;
            border-bottom: 1px solid #e2d6c9;
            gap: 12px;
            align-items: center;
            font-size: 14px;
        }

        .meta-row:last-child {
            border-bottom: none;
        }

        .meta-label {
            color: var(--muted);
        }

        .meta-value {
            color: var(--text);
            font-weight: 600;
            text-align: right;
        }

        .meta-value.success {
            color: #667652;
        }

        .meta-value.danger {
            color: #a45f52;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 11px 16px;
            text-decoration: none;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn:hover {
            filter: brightness(0.98);
        }

        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #fffaf4;
        }

        .btn-success {
            background: var(--success-bg);
            color: var(--success-text);
            border-color: #d7dfcc;
        }

        .btn-danger {
            background: var(--danger-bg);
            color: var(--danger-text);
            border-color: #e3c9c2;
        }

        .btn-warning {
            background: var(--warning-bg);
            color: var(--warning-text);
            border-color: #deccb8;
        }

        .btn-secondary {
            background: #f5eee5;
            color: var(--text);
        }

        .btn-disabled {
            background: #ebe4da;
            color: #8f8378;
            cursor: not-allowed;
            opacity: 0.85;
        }

        .pagination-wrap {
            display: flex;
            justify-content: center;
            margin-top: 36px;
            padding-top: 24px;
            border-top: 1px solid var(--line);
        }

        .empty-state {
            text-align: center;
            padding: 70px 20px;
            background: var(--card-bg);
            border: 1px solid var(--line);
        }

        .empty-state .icon {
            font-size: 4rem;
            margin-bottom: 18px;
        }

        .empty-state h3 {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 2rem;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .empty-state p {
            color: var(--muted);
        }

        .quick-actions {
            margin-top: 40px;
            padding-top: 28px;
            border-top: 1px solid var(--line);
        }

        .quick-actions h3 {
            text-align: center;
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 2rem;
            font-weight: 500;
            margin-bottom: 22px;
        }

        .quick-actions-row {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        @media (max-width: 1100px) {
            .stats-row {
                grid-template-columns: repeat(2, 1fr);
            }

            .users-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .admin-users-page {
                padding: 20px 12px 40px;
            }

            .page-shell {
                padding: 20px;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .meta-row {
                grid-template-columns: 1fr;
            }

            .meta-value {
                text-align: left;
            }

            .user-meta-top {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <div class="admin-users-page">
        <div class="admin-users-wrap">
            <div class="page-shell">
                <div class="breadcrumb">
                    <a href="{{ route('admin.index') }}">Admin panelis</a>
                    <span> / </span>
                    <span style="font-weight: 700; color: var(--text);">Lietotāju pārvaldība</span>
                </div>

                <div class="stats-row">
                    <div class="stat-box">
                        <div class="stat-number">{{ $users->total() }}</div>
                        <div class="stat-label">Kopā lietotāju</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">{{ $users->where('is_admin', true)->count() }}</div>
                        <div class="stat-label">Administratori</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">{{ $users->where('is_admin', false)->count() }}</div>
                        <div class="stat-label">Parastie lietotāji</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">{{ $users->where('created_at', '>=', now()->subDays(7))->count() }}</div>
                        <div class="stat-label">Jauni šonedēļ</div>
                    </div>
                </div>

                @if($users->count() > 0)
                    <div class="users-grid">
                        @foreach($users as $user)
                            <div class="user-card">
                                <div class="user-header">
                                    @if($user->is_admin)
                                        <div class="role-badge admin">Administrators</div>
                                    @else
                                        <div class="role-badge user">Lietotājs</div>
                                    @endif

                                    <h3 class="user-name">{{ $user->name }}</h3>
                                    <p class="user-email">{{ $user->email }}</p>

                                    <div class="user-meta-top">
                                        <span>Reģ.: {{ $user->created_at->format('d.m.Y') }}</span>
                                        <span>{{ $user->recipes->count() }} receptes</span>
                                    </div>
                                </div>

                                <div class="user-body">
                                    <div class="meta-table">
                                        <div class="meta-row">
                                            <div class="meta-label">E-pasts apstiprināts</div>
                                            <div class="meta-value {{ $user->email_verified_at ? 'success' : 'danger' }}">
                                                {{ $user->email_verified_at ? 'Jā' : 'Nē' }}
                                            </div>
                                        </div>
                                        <div class="meta-row">
                                            <div class="meta-label">Pēdējā aktivitāte</div>
                                            <div class="meta-value">
                                                {{ $user->updated_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="actions">
                                        @if($user->id !== Auth::id())
                                            <form method="POST" action="{{ route('admin.users.toggle-admin', $user) }}" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button
                                                    type="submit"
                                                    class="btn {{ $user->is_admin ? 'btn-warning' : 'btn-success' }}"
                                                    onclick="return confirm('Vai tiešām mainīt lietotāja statusu?')">
                                                    {{ $user->is_admin ? 'Noņemt admin' : 'Padarīt par admin' }}
                                                </button>
                                            </form>

                                            @if(!$user->is_admin)
                                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Vai tiešām dzēst šo lietotāju? Šī darbība ir neatgriezeniska!')">
                                                        Dzēst
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <span class="btn btn-disabled">
                                                Jūs pats
                                            </span>
                                        @endif

                                        @if($user->recipes->count() > 0)
                                            <a href="/recipes?user={{ $user->id }}" class="btn btn-primary">
                                                Skatīt receptes ({{ $user->recipes->count() }})
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination-wrap">
                        {{ $users->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <div class="icon">👥</div>
                        <h3>Nav lietotāju</h3>
                        <p>Nav atrasts neviens lietotājs sistēmā.</p>
                    </div>
                @endif

                <div class="quick-actions">
                    <h3>Ātras darbības</h3>
                    <div class="quick-actions-row">
                        <a href="{{ route('admin.index') }}" class="btn btn-primary">
                            Admin panelis
                        </a>
                        <a href="{{ route('admin.recipes') }}" class="btn btn-success">
                            Pārvaldīt receptes
                        </a>
                        <a href="/dashboard" class="btn btn-secondary">
                            Vadības panelis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection