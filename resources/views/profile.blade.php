@extends('layouts.app')

@section('title', 'Profils - Vecmāmiņas Receptes')
@section('meta_description', 'Pārvaldiet savu profila informāciju, atjauniniet paroli un nepieciešamības gadījumā dzēsiet kontu.')

@section('hero_title', 'Profils')
@section('hero_text', 'Pārvaldiet savu profila informāciju, atjauniniet paroli un nepieciešamības gadījumā dzēsiet kontu.')

@section('content')
<style>
    .profile-page {
        color: var(--text);
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

    .section-block + .section-block {
        margin-top: 28px;
    }

    .intro-box,
    .profile-card {
        background: var(--surface);
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
        background: var(--surface-soft);
        color: var(--text);
        font-size: 14px;
        font-weight: 700;
        transition: 0.2s ease;
        font-family: inherit;
    }

    .pdf-btn:hover {
        background: var(--surface-soft-2);
    }

    .livewire-box {
        max-width: 720px;
    }

    @media (max-width: 900px) {
        .hero-title {
            font-size: 2.8rem;
        }
    }

    @media (max-width: 640px) {
        .hero {
            padding: 10px 8px 24px;
        }

        .hero-title {
            font-size: 2.3rem;
        }

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

<div class="profile-page">
    <div class="pdf-row">
        <a href="{{ route('pdf.user.profile', Auth::id()) }}" class="pdf-btn">
            Profila PDF
        </a>
    </div>

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
@endsection