<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vecmāmiņas Receptes')</title>
    <meta name="description" content="@yield('meta_description', 'Vecmāmiņas Receptes - garšīgas mājās gatavotas receptes, favorīti, kategorijas un iedvesma katrai dienai.')">

    <link rel="icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --page-bg: #eee5da;
            --page-bg-2: #e8ddd0;
            --surface: rgba(255, 253, 249, 0.94);
            --surface-strong: #fffdf9;
            --surface-soft: #f6efe7;
            --surface-soft-2: #efe4d6;
            --line: #ddcfc0;
            --line-strong: #d4c2ae;
            --text: #2f241d;
            --muted: #7b6d61;
            --accent: #7a5a43;
            --accent-dark: #634733;
            --accent-soft: #ebe0d2;
            --danger-bg: #f3e2de;
            --danger-text: #a45f52;
            --danger-border: #e3c9c2;
            --success-bg: #e8eee2;
            --success-text: #667652;
            --success-border: #d7dfcc;
            --warning-bg: #f6eddc;
            --warning-text: #8a6a2f;
            --warning-border: #e3d3ae;
            --info-bg: #e7eff6;
            --info-text: #4d667d;
            --info-border: #c9d9e8;
            --shadow-sm: 0 10px 24px rgba(79, 59, 42, 0.05);
            --shadow: 0 18px 44px rgba(79, 59, 42, 0.07);
            --shadow-lg: 0 26px 60px rgba(79, 59, 42, 0.10);
            --radius-sm: 12px;
            --radius-md: 18px;
            --radius-lg: 26px;
        }

        html, body {
            min-height: 100%;
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.46) 0%, rgba(255,255,255,0) 34%),
                radial-gradient(circle at top right, rgba(255,255,255,0.24) 0%, rgba(255,255,255,0) 28%),
                linear-gradient(180deg, var(--page-bg) 0%, var(--page-bg-2) 100%);
        }

        body.menu-open {
            overflow: hidden;
        }

        .site-shell {
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        .site-shell::before,
        .site-shell::after {
            content: "";
            position: fixed;
            z-index: 0;
            pointer-events: none;
            border-radius: 50%;
            filter: blur(18px);
            opacity: 0.45;
        }

        .site-shell::before {
            width: 280px;
            height: 280px;
            top: -80px;
            left: -80px;
            background: rgba(255, 248, 238, 0.7);
        }

        .site-shell::after {
            width: 340px;
            height: 340px;
            right: -110px;
            bottom: 40px;
            background: rgba(239, 228, 214, 0.65);
        }

        .page {
            position: relative;
            z-index: 1;
            max-width: 1450px;
            margin: 0 auto;
            padding: 26px 20px 54px;
        }

        .hero {
            position: relative;
            padding: 34px 24px 36px;
            margin-bottom: 22px;
            text-align: center;
            background: linear-gradient(180deg, rgba(255,253,249,0.72) 0%, rgba(255,250,244,0.52) 100%);
            border: 1px solid rgba(221, 207, 192, 0.85);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 15% 20%, rgba(255,255,255,0.55) 0%, rgba(255,255,255,0) 22%),
                radial-gradient(circle at 85% 10%, rgba(239,228,214,0.55) 0%, rgba(239,228,214,0) 18%);
            pointer-events: none;
        }

        .hero > * {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 4rem;
            line-height: 1.06;
            color: var(--accent);
            font-weight: 500;
            margin-bottom: 12px;
            letter-spacing: 0.01em;
        }

        .hero-text {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.8;
            max-width: 860px;
            margin: 0 auto;
        }

        .nav-bar {
            position: sticky;
            top: 14px;
            z-index: 40;
            background: rgba(255, 253, 249, 0.92);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 194, 174, 0.75);
            border-radius: 22px;
            padding: 16px 20px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 34px;
        }

        .nav-brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.9rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 0.02em;
            line-height: 1.1;
            white-space: nowrap;
            transition: 0.2s ease;
        }

        .nav-brand::before {
            content: "📖";
            font-size: 1.2rem;
            line-height: 1;
        }

        .nav-brand:hover {
            color: var(--accent-dark);
            transform: translateY(-1px);
        }

        .nav-center {
            min-width: 0;
            display: flex;
            justify-content: center;
        }

        .nav-links {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            flex-wrap: nowrap;
            min-width: 0;
        }

        .nav-links a {
            color: var(--text);
            text-decoration: none;
            padding: 10px 13px;
            border: 1px solid transparent;
            border-radius: 999px;
            transition: 0.2s ease;
            font-weight: 700;
            font-size: 13.5px;
            white-space: nowrap;
            line-height: 1.2;
        }

        .nav-links a:hover {
            background: var(--surface-soft);
            border-color: var(--line);
            color: var(--accent);
            transform: translateY(-1px);
        }

        .nav-links a.active {
            color: var(--accent);
            background: linear-gradient(180deg, #f8f1e9 0%, #f0e5d8 100%);
            border-color: var(--line-strong);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.45);
        }

        .nav-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            white-space: nowrap;
        }

        .nav-user-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            max-width: 220px;
            padding: 8px 12px;
            background: var(--surface-soft);
            border: 1px solid var(--line);
            border-radius: 999px;
        }

        .nav-user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(180deg, #f6efe7 0%, #ecdfd0 100%);
            border: 1px solid var(--line);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-dark);
            font-weight: 800;
            font-size: 14px;
            flex: 0 0 auto;
        }

        .nav-user-name {
            color: var(--muted);
            font-size: 13.5px;
            font-weight: 700;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .nav-toggle {
            display: none;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, #fffdfa 0%, #f6efe7 100%);
            color: var(--accent-dark);
            border-radius: 14px;
            width: 48px;
            height: 48px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(79, 59, 42, 0.05);
            transition: 0.2s ease;
            font-size: 20px;
            font-weight: 700;
            font-family: inherit;
        }

        .nav-toggle:hover {
            transform: translateY(-1px);
            background: var(--surface-soft-2);
        }

        .nav-toggle-icon,
        .nav-toggle-icon::before,
        .nav-toggle-icon::after {
            display: block;
            width: 18px;
            height: 2px;
            border-radius: 999px;
            background: currentColor;
            position: relative;
            transition: 0.25s ease;
            content: "";
        }

        .nav-toggle-icon::before {
            position: absolute;
            top: -6px;
            left: 0;
        }

        .nav-toggle-icon::after {
            position: absolute;
            top: 6px;
            left: 0;
        }

        .menu-open .nav-toggle-icon {
            background: transparent;
        }

        .menu-open .nav-toggle-icon::before {
            top: 0;
            transform: rotate(45deg);
        }

        .menu-open .nav-toggle-icon::after {
            top: 0;
            transform: rotate(-45deg);
        }

        .nav-mobile-panel {
            display: none;
        }

        .main-content {
            background: rgba(255, 253, 249, 0.84);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            border: 1px solid rgba(212, 194, 174, 0.85);
            border-radius: 30px;
            box-shadow: var(--shadow-lg);
            padding: 34px;
        }

        .section-block + .section-block {
            margin-top: 28px;
        }

        .section-title {
            color: var(--accent);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            font-weight: 500;
            line-height: 1.2;
        }

        .section-subtext {
            color: var(--muted);
            line-height: 1.75;
            margin-bottom: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .form-label {
            display: block;
            margin-bottom: 9px;
            font-weight: 700;
            color: var(--text);
            font-size: 15px;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--line);
            border-radius: 14px;
            font-size: 15px;
            background: #fffdfa;
            color: var(--text);
            transition: 0.2s ease;
            font-family: inherit;
            box-shadow: inset 0 1px 2px rgba(79, 59, 42, 0.02);
        }

        .form-input,
        .form-select {
            min-height: 50px;
        }

        .form-textarea {
            min-height: 140px;
            resize: vertical;
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: #b79d84;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(122, 90, 67, 0.10);
        }

        .help-text {
            color: var(--muted);
            margin-top: 7px;
            display: block;
            font-size: 13px;
            line-height: 1.55;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 12px 18px;
            text-decoration: none;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: #fff;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
            text-align: center;
            white-space: nowrap;
            font-family: inherit;
            box-shadow: 0 6px 18px rgba(79, 59, 42, 0.04);
        }

        .btn:hover {
            transform: translateY(-1px);
            filter: brightness(0.99);
        }

        .btn-primary {
            background: linear-gradient(180deg, #84624a 0%, #7a5a43 100%);
            border-color: var(--accent);
            color: #fffaf4;
            box-shadow: 0 10px 24px rgba(122, 90, 67, 0.22);
        }

        .btn-primary:hover {
            background: linear-gradient(180deg, #6e4f39 0%, #634733 100%);
        }

        .btn-success {
            background: linear-gradient(180deg, #eef3ea 0%, #e8eee2 100%);
            color: var(--success-text);
            border-color: var(--success-border);
        }

        .btn-success:hover {
            background: #dde6d3;
        }

        .btn-secondary {
            background: linear-gradient(180deg, #faf6f0 0%, #f6efe7 100%);
            color: var(--text);
        }

        .btn-secondary:hover {
            background: var(--surface-soft-2);
        }

        .btn-warning {
            background: linear-gradient(180deg, #f8f0e2 0%, #f6eddc 100%);
            color: var(--warning-text);
            border-color: var(--warning-border);
        }

        .btn-warning:hover {
            background: #f0e3cc;
        }

        .btn-danger {
            background: linear-gradient(180deg, #f7e9e5 0%, #f3e2de 100%);
            color: var(--danger-text);
            border-color: var(--danger-border);
        }

        .btn-danger:hover {
            background: #eed6d1;
        }

        .card {
            position: relative;
            background: var(--surface-strong);
            border: 1px solid rgba(221, 207, 192, 0.95);
            border-radius: 22px;
            padding: 28px;
            margin-bottom: 22px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            inset: 0 0 auto 0;
            height: 1px;
            background: linear-gradient(90deg, rgba(255,255,255,0.6), rgba(255,255,255,0));
            pointer-events: none;
        }

        .card-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.9rem;
            color: var(--accent);
            margin-bottom: 18px;
            text-align: center;
            font-weight: 500;
        }

        .text-center {
            text-align: center;
        }

        .grid {
            display: grid;
            gap: 20px;
        }

        .grid-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .grid-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-top: 18px;
        }

        .stat-box {
            background: linear-gradient(180deg, #f9f2ea 0%, #efe2d2 100%);
            color: var(--text);
            padding: 24px 16px;
            text-align: center;
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: 0 8px 24px rgba(90, 69, 52, 0.05);
            transition: 0.2s ease;
        }

        .stat-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(90, 69, 52, 0.08);
        }

        .stat-number {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.4rem;
            font-weight: 700;
            display: block;
            margin-bottom: 8px;
            color: var(--accent-dark);
            line-height: 1;
        }

        .stat-label {
            font-size: 0.95rem;
            color: var(--muted);
        }

        .list-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid var(--line);
        }

        .list-row:last-child {
            border-bottom: 0;
        }

        .avatar,
        .emoji-box {
            height: 48px;
            width: 48px;
            background: linear-gradient(180deg, #f6efe7 0%, #ecdfd0 100%);
            border: 1px solid var(--line);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--accent-dark);
            flex: 0 0 auto;
            box-shadow: 0 6px 16px rgba(79, 59, 42, 0.05);
        }

        .avatar {
            border-radius: 50%;
        }

        .muted {
            color: var(--muted);
            font-size: 14px;
        }

        .nowrap {
            white-space: nowrap;
        }

        .hero-icon {
            font-size: 3.7rem;
            margin-bottom: 12px;
        }

        .section-subtitle {
            color: var(--muted);
            line-height: 1.7;
            max-width: 720px;
            margin: 0 auto;
        }

        .panel-title {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent-dark);
            margin-bottom: 10px;
            font-size: 2.3rem;
            font-weight: 500;
        }

        .row-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .item-title {
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .flash-messages {
            margin-bottom: 24px;
        }

        .flash-message {
            padding: 15px 18px;
            border: 1px solid;
            border-radius: 16px;
            margin-bottom: 12px;
            font-size: 14px;
            line-height: 1.6;
            font-weight: 600;
            box-shadow: 0 8px 18px rgba(79, 59, 42, 0.04);
        }

        .flash-message.success {
            background: var(--success-bg);
            color: var(--success-text);
            border-color: var(--success-border);
        }

        .flash-message.error {
            background: var(--danger-bg);
            color: var(--danger-text);
            border-color: var(--danger-border);
        }

        .flash-message.warning {
            background: var(--warning-bg);
            color: var(--warning-text);
            border-color: var(--warning-border);
        }

        .flash-message.info {
            background: var(--info-bg);
            color: var(--info-text);
            border-color: var(--info-border);
        }

        .flash-message ul {
            margin: 8px 0 0 18px;
            padding: 0;
        }

        .flash-message li {
            margin-bottom: 4px;
        }

        .empty-state {
            text-align: center;
            padding: 34px 20px;
            background: linear-gradient(180deg, #f9f3eb 0%, #f4eadf 100%);
            border: 1px dashed var(--line-strong);
            border-radius: 22px;
        }

        .empty-state-title {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 1.7rem;
            margin-bottom: 10px;
        }

        .empty-state-text {
            color: var(--muted);
            line-height: 1.7;
            max-width: 620px;
            margin: 0 auto;
        }

        @media (max-width: 1280px) {
            .nav-bar {
                grid-template-columns: 1fr;
                justify-items: center;
                text-align: center;
                position: relative;
                top: 0;
            }

            .nav-center {
                width: 100%;
            }

            .nav-links {
                flex-wrap: wrap;
            }

            .nav-right {
                justify-content: center;
                flex-wrap: wrap;
            }

            .nav-user-chip {
                max-width: none;
            }
        }

        @media (max-width: 980px) {
            .main-content {
                padding: 24px;
                border-radius: 24px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .grid-2,
            .grid-3,
            .form-row {
                grid-template-columns: 1fr;
            }

            .hero {
                padding: 28px 18px 30px;
            }

            .hero-title {
                font-size: 2.8rem;
            }

            .nav-brand {
                font-size: 1.7rem;
            }

            .nav-links a {
                font-size: 13px;
                padding: 8px 10px;
            }
        }

        @media (max-width: 768px) {
            .page {
                padding: 14px 12px 30px;
            }

            .hero {
                padding: 24px 16px 26px;
                border-radius: 22px;
                margin-bottom: 16px;
            }

            .hero-title {
                font-size: 2.2rem;
                line-height: 1.12;
                margin-bottom: 10px;
            }

            .hero-text {
                font-size: 15px;
                line-height: 1.65;
            }

            .nav-bar {
                position: sticky;
                top: 10px;
                grid-template-columns: 1fr auto;
                justify-items: stretch;
                align-items: center;
                gap: 12px;
                padding: 14px;
                border-radius: 18px;
                margin-bottom: 18px;
                text-align: left;
            }

            .nav-brand {
                font-size: 1.35rem;
                min-width: 0;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .nav-center,
            .nav-right {
                display: none;
            }

            .nav-toggle {
                display: inline-flex;
            }

            .nav-mobile-panel {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 80;
                pointer-events: none;
                opacity: 0;
                transition: opacity 0.25s ease;
            }

            .menu-open .nav-mobile-panel {
                opacity: 1;
                pointer-events: auto;
            }

            .nav-mobile-backdrop {
                position: absolute;
                inset: 0;
                background: rgba(47, 36, 29, 0.32);
                backdrop-filter: blur(3px);
                -webkit-backdrop-filter: blur(3px);
            }

            .nav-mobile-sheet {
                position: absolute;
                top: 0;
                right: 0;
                width: min(88vw, 360px);
                height: 100%;
                background: linear-gradient(180deg, rgba(255,253,249,0.98) 0%, rgba(247,239,231,0.98) 100%);
                border-left: 1px solid rgba(212, 194, 174, 0.85);
                box-shadow: -18px 0 44px rgba(79, 59, 42, 0.12);
                padding: 18px 16px 22px;
                overflow-y: auto;
                transform: translateX(100%);
                transition: transform 0.28s ease;
            }

            .menu-open .nav-mobile-sheet {
                transform: translateX(0);
            }

            .nav-mobile-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                margin-bottom: 16px;
            }

            .nav-mobile-title {
                font-family: Georgia, "Times New Roman", serif;
                color: var(--accent);
                font-size: 1.35rem;
                font-weight: 500;
            }

            .nav-mobile-close {
                border: 1px solid var(--line);
                background: #fffdfa;
                color: var(--accent-dark);
                width: 42px;
                height: 42px;
                border-radius: 12px;
                font-size: 24px;
                line-height: 1;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .nav-mobile-user {
                display: flex;
                align-items: center;
                gap: 12px;
                background: var(--surface-soft);
                border: 1px solid var(--line);
                border-radius: 18px;
                padding: 12px;
                margin-bottom: 16px;
            }

            .nav-mobile-user-name {
                font-weight: 700;
                color: var(--text);
                line-height: 1.4;
                word-break: break-word;
            }

            .nav-mobile-links {
                display: flex;
                flex-direction: column;
                gap: 8px;
                margin-bottom: 18px;
            }

            .nav-mobile-links a {
                display: block;
                width: 100%;
                text-decoration: none;
                color: var(--text);
                background: rgba(255,255,255,0.72);
                border: 1px solid var(--line);
                border-radius: 14px;
                padding: 13px 14px;
                font-weight: 700;
                line-height: 1.35;
                transition: 0.2s ease;
            }

            .nav-mobile-links a.active {
                color: var(--accent);
                background: linear-gradient(180deg, #f8f1e9 0%, #f0e5d8 100%);
                border-color: var(--line-strong);
            }

            .nav-mobile-actions {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .nav-mobile-actions .btn,
            .nav-mobile-actions button {
                width: 100%;
            }

            .main-content,
            .card {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .list-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .nowrap {
                white-space: normal;
            }

            .btn {
                width: 100%;
            }

            .section-title {
                font-size: 1.6rem;
            }

            .card-title {
                font-size: 1.5rem;
            }

            .panel-title {
                font-size: 1.8rem;
            }

            .hero-icon {
                font-size: 3rem;
            }

            .site-shell::before {
                width: 200px;
                height: 200px;
            }

            .site-shell::after {
                width: 240px;
                height: 240px;
                right: -90px;
                bottom: 20px;
            }
        }

        @media (max-width: 640px) {
            .page {
                padding: 12px 10px 24px;
            }

            .hero {
                padding: 22px 14px 24px;
                border-radius: 20px;
            }

            .hero-title {
                font-size: 1.95rem;
            }

            .hero-text {
                font-size: 14px;
            }

            .main-content,
            .card {
                padding: 16px;
                border-radius: 20px;
            }

            .flash-message {
                padding: 13px 14px;
                font-size: 13px;
            }

            .section-title {
                font-size: 1.45rem;
            }

            .card-title {
                font-size: 1.35rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-force.css') }}">
</head>
<body>
<div class="site-shell">
    <div class="page">

        @php
            $hideMainNavigation = request()->routeIs('login')
                || request()->routeIs('register')
                || request()->routeIs('password.request')
                || request()->routeIs('password.reset');
        @endphp

        @unless($hideMainNavigation)
            @if(request()->is('admin*'))
                <div class="hero">
                    <h1 class="hero-title">Administrācijas panelis</h1>
                    <p class="hero-text">Šeit vari pārvaldīt lietotājus, receptes un sistēmas saturu.</p>
                </div>
            @else
                <div class="hero">
                    <h1 class="hero-title">
                        @yield('hero_title', 'Vecmāmiņas Receptes')
                    </h1>

                    <p class="hero-text">
                        @yield('hero_text', 'Garšas, kas paliek atmiņā')
                    </p>
                </div>
            @endif

            <nav class="nav-bar">
                <a href="{{ Auth::check() ? url('/dashboard') : url('/') }}" class="nav-brand">Vecmāmiņas Receptes</a>

                <div class="nav-center">
                    @auth
                        <div class="nav-links">
                            <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">Vadības panelis</a>
                            <a href="{{ url('/recipes') }}" class="{{ request()->is('recipes') || request()->is('recipes/*') ? 'active' : '' }}">Receptes</a>
                            <a href="{{ url('/categories') }}" class="{{ request()->is('categories') || request()->is('categories/*') ? 'active' : '' }}">Kategorijas</a>
                            <a href="{{ url('/profile/recipes') }}" class="{{ request()->is('profile/recipes') ? 'active' : '' }}">Manas receptes</a>
                            <a href="{{ url('/profile/favorites') }}" class="{{ request()->is('profile/favorites') ? 'active' : '' }}">Favorīti</a>
                            <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Kontakti</a>
                            <a href="{{ route('profile.edit') }}" class="{{ request()->is('profile') ? 'active' : '' }}">Profils</a>

                            @if(Auth::user()->is_admin)
                                <a href="{{ url('/admin') }}" class="{{ request()->is('admin') || request()->is('admin/*') ? 'active' : '' }}">Administrācija</a>
                            @endif
                        </div>
                    @endauth
                </div>

                <div class="nav-right">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-secondary">Ielogoties</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Reģistrēties</a>
                    @endguest

                    @auth
                        <div class="nav-user-chip">
                            <span class="nav-user-avatar">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                            </span>
                            <span class="nav-user-name">{{ Auth::user()->name }}</span>
                        </div>

                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Iziet</button>
                        </form>
                    @endauth
                </div>

                <button
                    type="button"
                    class="nav-toggle"
                    aria-label="Atvērt izvēlni"
                    aria-expanded="false"
                    aria-controls="mobileMenu"
                    onclick="toggleMobileMenu()"
                >
                    <span class="nav-toggle-icon"></span>
                </button>
            </nav>

            <div class="nav-mobile-panel" id="mobileMenu">
                <div class="nav-mobile-backdrop" onclick="closeMobileMenu()"></div>

                <div class="nav-mobile-sheet">
                    <div class="nav-mobile-header">
                        <div class="nav-mobile-title">Izvēlne</div>
                        <button type="button" class="nav-mobile-close" onclick="closeMobileMenu()" aria-label="Aizvērt izvēlni">
                            ×
                        </button>
                    </div>

                    @auth
                        <div class="nav-mobile-user">
                            <span class="nav-user-avatar">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                            </span>
                            <div class="nav-mobile-user-name">{{ Auth::user()->name }}</div>
                        </div>

                        <div class="nav-mobile-links">
                            <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">Vadības panelis</a>
                            <a href="{{ url('/recipes') }}" class="{{ request()->is('recipes') || request()->is('recipes/*') ? 'active' : '' }}">Receptes</a>
                            <a href="{{ url('/categories') }}" class="{{ request()->is('categories') || request()->is('categories/*') ? 'active' : '' }}">Kategorijas</a>
                            <a href="{{ url('/profile/recipes') }}" class="{{ request()->is('profile/recipes') ? 'active' : '' }}">Manas receptes</a>
                            <a href="{{ url('/profile/favorites') }}" class="{{ request()->is('profile/favorites') ? 'active' : '' }}">Favorīti</a>
                            <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Kontakti</a>
                            <a href="{{ route('profile.edit') }}" class="{{ request()->is('profile') ? 'active' : '' }}">Profils</a>

                            @if(Auth::user()->is_admin)
                                <a href="{{ url('/admin') }}" class="{{ request()->is('admin') || request()->is('admin/*') ? 'active' : '' }}">Administrācija</a>
                            @endif
                        </div>

                        <div class="nav-mobile-actions">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Iziet</button>
                            </form>
                        </div>
                    @endauth

                    @guest
                        <div class="nav-mobile-actions">
                            <a href="{{ route('login') }}" class="btn btn-secondary">Ielogoties</a>
                            <a href="{{ route('register') }}" class="btn btn-primary">Reģistrēties</a>
                        </div>
                    @endguest
                </div>
            </div>
        @endunless

        <div class="main-content">
            @include('components.flash-messages')
            @yield('content')
        </div>

    </div>
</div>

<script>
    function toggleMobileMenu() {
        const body = document.body;
        const menu = document.getElementById('mobileMenu');
        const toggle = document.querySelector('.nav-toggle');

        body.classList.toggle('menu-open');

        const isOpen = body.classList.contains('menu-open');

        if (toggle) {
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        }

        if (menu) {
            menu.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
        }
    }

    function closeMobileMenu() {
        const body = document.body;
        const menu = document.getElementById('mobileMenu');
        const toggle = document.querySelector('.nav-toggle');

        body.classList.remove('menu-open');

        if (toggle) {
            toggle.setAttribute('aria-expanded', 'false');
        }

        if (menu) {
            menu.setAttribute('aria-hidden', 'true');
        }
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeMobileMenu();
        }
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            closeMobileMenu();
        }
    });

    document.addEventListener('click', function (event) {
        if (window.innerWidth > 768) {
            return;
        }

        const mobileMenu = document.getElementById('mobileMenu');
        const navToggle = document.querySelector('.nav-toggle');
        const clickedLink = event.target.closest('.nav-mobile-links a');

        if (clickedLink && mobileMenu) {
            closeMobileMenu();
        }

        if (
            document.body.classList.contains('menu-open') &&
            mobileMenu &&
            !event.target.closest('.nav-mobile-sheet') &&
            navToggle &&
            !event.target.closest('.nav-toggle')
        ) {
            closeMobileMenu();
        }
    });
</script>
</body>
</html>