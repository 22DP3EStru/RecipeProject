<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Vecmāmiņas Receptes')</title>
    <meta name="description" content="@yield('meta_description', 'Vecmāmiņas Receptes administrācijas panelis - lietotāju, recepšu un satura pārvaldība.')">

    <link rel="icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --page-bg: #eee5da;
            --page-bg-2: #e8ddd0;
            --surface: #fffdf9;
            --surface-soft: #f6efe7;
            --line: #ddcfc0;
            --text: #2f241d;
            --muted: #7b6d61;
            --accent: #7a5a43;
            --accent-dark: #634733;
            --shadow: 0 14px 36px rgba(79, 59, 42, 0.06);
        }

        html, body {
            min-height: 100%;
        }

        body.admin-layout {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background:
                linear-gradient(180deg, rgba(255,255,255,0.35), rgba(255,255,255,0)),
                linear-gradient(180deg, var(--page-bg) 0%, var(--page-bg-2) 100%);
        }

        .admin-shell {
            min-height: 100vh;
        }

        .admin-topbar-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 26px 20px 0;
        }

        .admin-topbar {
            background: rgba(255, 253, 249, 0.92);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
        }

        .admin-topbar-left,
        .admin-topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .admin-brand {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.9rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        .admin-link {
            text-decoration: none;
            color: var(--text);
            font-size: 14px;
            font-weight: 600;
            padding: 10px 14px;
            border: 1px solid transparent;
            transition: 0.2s ease;
        }

        .admin-link:hover {
            background: var(--surface-soft);
            border-color: var(--line);
            color: var(--accent);
        }

        .admin-user {
            color: var(--muted);
            font-size: 14px;
            font-weight: 600;
        }

        .admin-logout-btn {
            border: 1px solid var(--line);
            background: #f3e2de;
            color: #a45f52;
            padding: 11px 16px;
            font-weight: 700;
            cursor: pointer;
        }

        .admin-main-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 24px 20px 42px;
        }

        .flash-messages {
            margin-bottom: 20px;
        }

        .flash-message {
            padding: 12px 16px;
            border: 1px solid;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .flash-message.success {
            background: #e8eee2;
            color: #667652;
            border-color: #d7dfcc;
        }

        .flash-message.error {
            background: #f7ebe8;
            color: #a45f52;
            border-color: #e3c9c2;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}">
</head>
<body class="admin-layout">

<div class="admin-shell">

    <header class="admin-topbar-wrap">
        <div class="admin-topbar">
            <div class="admin-topbar-left">
                <a href="{{ route('admin.index') }}" class="admin-brand">Vecmāmiņas Receptes</a>
                <a href="{{ route('admin.index') }}" class="admin-link">Admin panelis</a>
                <a href="{{ route('dashboard') }}" class="admin-link">Uz sākumlapu</a>
            </div>

            <div class="admin-topbar-right">
                <span class="admin-user">{{ auth()->user()?->email }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="admin-logout-btn">Iziet</button>
                </form>
            </div>
        </div>
    </header>

    <main class="admin-main-wrap">
        @include('components.flash-messages')

        @yield('content')
    </main>

</div>

</body>
</html>