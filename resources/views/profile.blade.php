<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family: Georgia, 'Times New Roman', serif; font-size: 1.8rem; font-weight: 500; color: #7a5a43; line-height: 1.2;">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <style>
        :root {
            --page-bg: #eee5da;
            --page-bg-2: #e8ddd0;
            --card-bg: #fffdf9;
            --soft-bg: #f6efe7;
            --soft-bg-2: #efe4d6;
            --line: #ddcfc0;
            --text: #2f241d;
            --muted: #7b6d61;
            --accent: #7a5a43;
            --accent-dark: #634733;
            --success-bg: #edf3e7;
            --success-text: #667652;
            --warning-bg: #f3e8e3;
            --warning-text: #9a6b56;
            --danger-bg: #f3e2de;
            --danger-text: #a45f52;
            --danger-border: #e3c9c2;
            --info-bg: #f2e7da;
            --info-text: #7a5a43;
            --shadow: 0 16px 40px rgba(79, 59, 42, 0.07);
        }

        .profile-page-wrap {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.35), rgba(255,255,255,0)),
                linear-gradient(180deg, var(--page-bg) 0%, var(--page-bg-2) 100%);
            min-height: calc(100vh - 64px);
            padding: 28px 20px 50px;
        }

        .profile-page {
            max-width: 1100px;
            margin: 0 auto;
        }

        .hero {
            padding: 18px 20px 32px;
            text-align: center;
        }

        .hero-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 4rem;
            line-height: 1.08;
            color: var(--accent);
            font-weight: 400;
            margin-bottom: 12px;
        }

        .hero-text {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.7;
            max-width: 820px;
            margin: 0 auto;
        }

        .main-content {
            background: rgba(255, 253, 249, 0.78);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 34px;
        }

        .section-block + .section-block {
            margin-top: 28px;
        }

        .intro-box,
        .profile-card {
            background: var(--card-bg);
            border: 1px solid var(--line);
            padding: 28px;
        }

        .intro-box {
            text-align: center;
        }

        .intro-icon {
            font-size: 3.5rem;
            margin-bottom: 16px;
        }

        .intro-box h2,
        .section-title {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-weight: 500;
        }

        .intro-box h2 {
            font-size: 2.3rem;
            margin-bottom: 12px;
        }

        .intro-box p,
        .section-subtext {
            color: var(--muted);
            line-height: 1.8;
        }

        .section-title {
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.9rem;
        }

        .section-subtext {
            margin-bottom: 22px;
        }

        .pdf-row {
            display: flex;
            justify-content: center;
            margin-bottom: 28px;
        }

        .pdf-btn {
            display: inline-block;
            padding: 12px 18px;
            text-decoration: none;
            border: 1px solid var(--line);
            background: var(--soft-bg);
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
            transition: 0.2s ease;
            font-family: inherit;
        }

        .pdf-btn:hover {
            background: var(--soft-bg-2);
        }

        .livewire-box {
            max-width: 720px;
        }

        @media (max-width: 900px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .main-content {
                padding: 24px;
            }
        }

        @media (max-width: 640px) {
            .profile-page-wrap {
                padding: 16px 12px 32px;
            }

            .hero {
                padding: 10px 8px 24px;
            }

            .hero-title {
                font-size: 2.3rem;
            }

            .main-content,
            .intro-box,
            .profile-card {
                padding: 20px;
            }

            .livewire-box {
                max-width: 100%;
            }

            .pdf-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
        <link rel="icon" href="{{ asset('favicon.ico') }}?v=3">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">
    <div class="profile-page-wrap">
        <div class="profile-page">
            <div class="hero">
                <h1 class="hero-title">Profils</h1>
                <p class="hero-text">
                    Pārvaldiet savu profila informāciju, atjauniniet paroli un nepieciešamības gadījumā dzēsiet kontu.
                </p>
            </div>

            <div class="pdf-row">
                <a href="{{ route('pdf.user.profile', Auth::id()) }}" class="pdf-btn">
                    Profila PDF
                </a>
            </div>

            <div class="main-content">
                <div class="section-block intro-box">
                    <div class="intro-icon">⚙️</div>
                    <h2>Profila pārvaldība</h2>
                    <p>
                        Šajā sadaļā varat atjaunināt savu personīgo informāciju, nomainīt paroli un pārvaldīt konta iestatījumus vienuviet.
                    </p>
                </div>

                <div class="section-block profile-card">
                    <h3 class="section-title">👤 Profila informācija</h3>
                    <p class="section-subtext">
                        Atjauniniet savu vārdu, e-pasta adresi un citu pamata informāciju.
                    </p>
                    <div class="livewire-box">
                        <livewire:profile.update-profile-information-form />
                    </div>
                </div>

                <div class="section-block profile-card">
                    <h3 class="section-title">🔒 Paroles maiņa</h3>
                    <p class="section-subtext">
                        Izveidojiet jaunu paroli, lai saglabātu sava konta drošību.
                    </p>
                    <div class="livewire-box">
                        <livewire:profile.update-password-form />
                    </div>
                </div>

                <div class="section-block profile-card">
                    <h3 class="section-title">🗑️ Konta dzēšana</h3>
                    <p class="section-subtext">
                        Ja vairs nevēlaties izmantot šo kontu, šeit iespējams to neatgriezeniski dzēst.
                    </p>
                    <div class="livewire-box">
                        <livewire:profile.delete-user-form />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>