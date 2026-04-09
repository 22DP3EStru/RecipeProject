@extends('layouts.app')

@section('title', 'Rediģēt profilu - Vecmāmiņas Receptes')
@section('meta_description', 'Pārvaldiet sava konta informāciju, nomainiet paroli un kontrolējiet personīgos iestatījumus Vecmāmiņas Receptes profilā.')

@section('hero_title', 'Profils')
@section('hero_text', 'Pārvaldiet sava konta informāciju, drošību un iestatījumus')

@section('content')
@php
    $recipesCount = $user->recipes_count ?? 0;
    $favoritesCount = $user->favorite_recipes_count ?? 0;
    $commentsCount = 0;

    $profilePhoto = $user->profile_photo ?? null;
    $userInitial = strtoupper(mb_substr($user->name ?? 'U', 0, 1));
@endphp

<style>
    .profile-page {
        color: var(--text);
    }

    .profile-stack {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .profile-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        padding: 16px 18px;
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 18px;
        color: var(--muted);
        font-size: 14px;
        box-shadow: 0 10px 24px rgba(79, 59, 42, 0.04);
    }

    .profile-breadcrumb a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 700;
    }

    .profile-breadcrumb-current {
        color: var(--text);
        font-weight: 800;
    }

    .profile-top-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 12px;
    }

    .profile-outline-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 18px;
        border-radius: 14px;
        text-decoration: none;
        border: 1px solid rgba(122, 90, 67, 0.14);
        background: linear-gradient(180deg, #faf6f0 0%, #f6efe7 100%);
        color: var(--accent);
        font-size: 14px;
        font-weight: 700;
        transition: 0.2s ease;
        box-shadow: 0 6px 18px rgba(79, 59, 42, 0.04);
    }

    .profile-outline-btn:hover {
        transform: translateY(-1px);
        background: #efe4d6;
    }

    .profile-section-card {
        background: rgba(255, 253, 249, 0.97);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
    }

    .profile-hero-card {
        background: linear-gradient(180deg, #fffdf9 0%, #fbf5ee 100%);
        overflow: hidden;
    }

    .profile-hero-inner {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 28px;
        align-items: center;
    }

    .profile-avatar-wrap {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
    }

    .profile-avatar {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #f0e5d8;
        box-shadow: 0 10px 24px rgba(122, 90, 67, 0.12);
        background: linear-gradient(135deg, #efe3d5 0%, #e7d5c3 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 2.9rem;
        font-weight: 700;
        font-family: Georgia, "Times New Roman", serif;
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .avatar-note {
        font-size: 12px;
        color: var(--muted);
        text-align: center;
        line-height: 1.6;
        max-width: 170px;
    }

    .profile-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 12px;
        border-radius: 999px;
        border: 1px solid rgba(122, 90, 67, 0.12);
        background: #f5ece2;
        color: var(--accent);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.02em;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    .profile-main-name {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.7rem;
        font-weight: 500;
        color: var(--accent);
        margin: 0 0 8px;
        line-height: 1.08;
    }

    .profile-main-email {
        color: var(--muted);
        font-size: 15px;
        margin-bottom: 10px;
    }

    .profile-main-text {
        color: var(--muted);
        font-size: 14px;
        line-height: 1.8;
        max-width: 700px;
    }

    .profile-stats {
        margin-top: 26px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .stat-card {
        background: linear-gradient(180deg, #f8f2ea 0%, #f2e8dc 100%);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 18px;
        padding: 18px 16px;
        transition: 0.18s ease;
        box-shadow: 0 8px 20px rgba(79, 59, 42, 0.04);
        text-align: center;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(79, 59, 42, 0.08);
    }

    .stat-card.soft-green {
        background: linear-gradient(180deg, #eef5ea 0%, #e5efdf 100%);
    }

    .stat-card.soft-pink {
        background: linear-gradient(180deg, #faf0f3 0%, #f6e8ed 100%);
    }

    .stat-icon {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .stat-number {
        font-size: 1.95rem;
        font-weight: 700;
        color: #6f472c;
        line-height: 1;
        margin-bottom: 8px;
        font-family: Georgia, "Times New Roman", serif;
    }

    .stat-label {
        font-size: 13px;
        color: var(--muted);
        font-weight: 700;
    }

    .card-header {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 24px;
        padding-bottom: 14px;
        border-bottom: 1px solid rgba(221, 207, 192, 0.9);
    }

    .card-icon {
        font-size: 1.8rem;
        line-height: 1;
        padding-top: 2px;
    }

    .card-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2rem;
        font-weight: 500;
        color: var(--accent);
        margin-bottom: 4px;
        line-height: 1.1;
    }

    .card-subtitle {
        color: var(--muted);
        font-size: 14px;
        line-height: 1.7;
    }

    .profile-edit-layout {
        display: grid;
        grid-template-columns: 200px 1fr;
        gap: 24px;
        align-items: start;
    }

    .photo-preview-box {
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
        border: 1px solid rgba(122, 90, 67, 0.12);
        border-radius: 20px;
        padding: 18px;
        text-align: center;
    }

    .photo-preview-avatar {
        width: 122px;
        height: 122px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 14px;
        border: 4px solid #f0e5d8;
        background: linear-gradient(135deg, #efe3d5 0%, #e7d5c3 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 2.5rem;
        font-weight: 700;
        font-family: Georgia, "Times New Roman", serif;
        box-shadow: 0 10px 24px rgba(122, 90, 67, 0.10);
    }

    .photo-preview-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-preview-text {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.6;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 700;
        color: var(--text);
        font-size: 14px;
    }

    .form-input,
    .form-file {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid var(--line);
        border-radius: 14px;
        font-size: 15px;
        background: #fffdfa;
        color: var(--text);
        transition: 0.2s ease;
        box-shadow: inset 0 1px 2px rgba(79, 59, 42, 0.02);
    }

    .form-input:focus,
    .form-file:focus {
        outline: none;
        border-color: #b79d84;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(122, 90, 67, 0.10);
    }

    .form-help {
        color: var(--muted);
        font-size: 12px;
        margin-top: 8px;
        line-height: 1.6;
    }

    .form-error {
        color: var(--danger-text);
        font-size: 13px;
        margin-top: 6px;
        font-weight: 600;
    }

    .checkbox-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: var(--muted);
        background: #faf4ed;
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 14px;
        padding: 10px 12px;
    }

    .checkbox-label input {
        accent-color: var(--accent);
    }

    .actions-row {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .alert {
        padding: 14px 18px;
        margin-bottom: 18px;
        border: 1px solid var(--line);
        border-radius: 16px;
        font-weight: 600;
        line-height: 1.7;
    }

    .alert-info {
        background: #f3ece3;
        border-color: #dfcfbf;
        color: #7a5a43;
    }

    .delete-section {
        background: linear-gradient(180deg, #fcf2ef 0%, #f8ebe7 100%);
        border-color: #e7d0ca;
    }

    .danger-box {
        background: rgba(255,255,255,0.5);
        border: 1px solid #e7d0ca;
        border-radius: 18px;
        padding: 18px;
        margin-bottom: 20px;
    }

    .danger-box h4 {
        color: var(--danger-text);
        margin-bottom: 8px;
        font-size: 16px;
    }

    .danger-box p {
        color: var(--muted);
        line-height: 1.7;
        font-size: 14px;
    }

    .quick-actions-card {
        background: rgba(255, 253, 249, 0.96);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
    }

    .quick-title {
        text-align: center;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2rem;
        color: var(--accent);
        margin-bottom: 10px;
        font-weight: 500;
    }

    .quick-subtitle {
        text-align: center;
        color: var(--muted);
        line-height: 1.7;
        margin-bottom: 22px;
        font-size: 14px;
    }

    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .quick-action-card {
        display: block;
        text-decoration: none;
        padding: 18px;
        border-radius: 18px;
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
        border: 1px solid rgba(122, 90, 67, 0.14);
        color: var(--text);
        transition: 0.2s ease;
        box-shadow: 0 8px 18px rgba(79, 59, 42, 0.04);
    }

    .quick-action-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 26px rgba(79, 59, 42, 0.08);
    }

    .quick-action-icon {
        font-size: 24px;
        display: block;
        margin-bottom: 10px;
    }

    .quick-action-title {
        font-size: 15px;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 6px;
    }

    .quick-action-text {
        font-size: 13px;
        color: var(--muted);
        line-height: 1.6;
    }

    .modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(47, 36, 29, 0.42);
        z-index: 1000;
        padding: 20px;
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
    }

    .modal-content {
        background: rgba(255, 253, 249, 0.98);
        margin: 8% auto 0;
        padding: 30px;
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 24px;
        width: 100%;
        max-width: 520px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
    }

    .modal-head {
        text-align: center;
        margin-bottom: 24px;
    }

    .modal-icon {
        font-size: 3rem;
        margin-bottom: 12px;
    }

    .modal-head h3 {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2rem;
        color: var(--danger-text);
        margin-bottom: 8px;
        font-weight: 500;
    }

    .modal-head p {
        color: var(--muted);
        line-height: 1.7;
    }

    @media (max-width: 768px) {
    .profile-stack {
        gap: 16px;
    }

    .profile-breadcrumb {
        padding: 12px 14px;
        font-size: 13px;
        border-radius: 14px;
    }

    .profile-top-actions {
        justify-content: stretch;
    }

    .profile-top-actions > * {
        width: 100%;
    }

    .profile-outline-btn {
        width: 100%;
        padding: 10px 14px;
        font-size: 13px;
        border-radius: 12px;
    }

    .profile-section-card,
    .quick-actions-card {
        padding: 14px;
        border-radius: 18px;
    }

    .profile-hero-inner {
        grid-template-columns: 1fr;
        gap: 16px;
        text-align: center;
    }

    .profile-avatar-wrap {
        gap: 10px;
    }

    .profile-avatar {
        width: 104px;
        height: 104px;
        font-size: 2.2rem;
        margin: 0 auto;
    }

    .avatar-note {
        max-width: 100%;
        font-size: 12px;
    }

    .profile-badge {
        margin: 0 auto 10px;
        font-size: 11px;
        padding: 6px 10px;
    }

    .profile-main-name {
        font-size: 1.9rem;
        line-height: 1.1;
        margin-bottom: 6px;
    }

    .profile-main-email {
        font-size: 13px;
        margin-bottom: 8px;
    }

    .profile-main-text {
        font-size: 13px;
        line-height: 1.6;
        max-width: 100%;
    }

    .profile-stats {
        margin-top: 16px;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 8px;
    }

    .stat-card {
        padding: 10px 6px;
        border-radius: 14px;
    }

    .stat-icon {
        font-size: 1rem;
        margin-bottom: 6px;
    }

    .stat-number {
        font-size: 1.35rem;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 11px;
    }

    .card-header {
        gap: 10px;
        margin-bottom: 16px;
        padding-bottom: 10px;
    }

    .card-icon {
        font-size: 1.35rem;
    }

    .card-title {
        font-size: 1.45rem;
        margin-bottom: 2px;
    }

    .card-subtitle {
        font-size: 13px;
        line-height: 1.55;
    }

    .profile-edit-layout {
        grid-template-columns: 1fr;
        gap: 14px;
    }

    .photo-preview-box {
        padding: 14px;
        border-radius: 16px;
    }

    .photo-preview-avatar {
        width: 96px;
        height: 96px;
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .photo-preview-text {
        font-size: 12px;
        line-height: 1.5;
    }

    .form-group {
        margin-bottom: 14px;
    }

    .form-label {
        font-size: 13px;
        margin-bottom: 6px;
    }

    .form-input,
    .form-file {
        padding: 10px 12px;
        font-size: 14px;
        border-radius: 12px;
    }

    .form-help,
    .form-error {
        font-size: 12px;
    }

    .checkbox-label {
        width: 100%;
        font-size: 13px;
        line-height: 1.45;
        padding: 10px 12px;
        border-radius: 12px;
    }

    .actions-row {
        flex-direction: column;
        align-items: stretch;
        gap: 8px;
    }

    .actions-row .btn {
        width: 100%;
    }

    .alert {
        padding: 12px 14px;
        border-radius: 14px;
        font-size: 13px;
        line-height: 1.55;
    }

    .danger-box {
        padding: 14px;
        border-radius: 14px;
        margin-bottom: 14px;
    }

    .danger-box h4 {
        font-size: 15px;
    }

    .danger-box p {
        font-size: 13px;
        line-height: 1.55;
    }

    .quick-title {
        font-size: 1.45rem;
        margin-bottom: 8px;
    }

    .quick-subtitle {
        font-size: 13px;
        line-height: 1.55;
        margin-bottom: 16px;
    }

    .quick-actions-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .quick-action-card {
        padding: 14px;
        border-radius: 14px;
    }

    .quick-action-icon {
        font-size: 20px;
        margin-bottom: 8px;
    }

    .quick-action-title {
        font-size: 14px;
        margin-bottom: 4px;
    }

    .quick-action-text {
        font-size: 12px;
        line-height: 1.5;
    }

    .modal {
        padding: 12px;
    }

    .modal-content {
        margin: 20% auto 0;
        padding: 18px 14px;
        border-radius: 18px;
    }

    .modal-icon {
        font-size: 2.3rem;
        margin-bottom: 8px;
    }

    .modal-head {
        margin-bottom: 16px;
    }

    .modal-head h3 {
        font-size: 1.5rem;
    }

    .modal-head p {
        font-size: 13px;
        line-height: 1.55;
    }
}

@media (max-width: 480px) {
    .profile-section-card,
    .quick-actions-card {
        padding: 12px;
        border-radius: 16px;
    }

    .profile-main-name {
        font-size: 1.65rem;
    }

    .profile-avatar {
        width: 92px;
        height: 92px;
        font-size: 1.95rem;
    }

    .photo-preview-avatar {
        width: 88px;
        height: 88px;
        font-size: 1.8rem;
    }

    .profile-stats {
        gap: 6px;
    }

    .stat-card {
        padding: 8px 4px;
    }

    .stat-number {
        font-size: 1.2rem;
    }

    .stat-label {
        font-size: 10px;
    }

    .card-title,
    .quick-title {
        font-size: 1.3rem;
    }

    .modal-content {
        margin-top: 16%;
        padding: 16px 12px;
    }
}

</style>

<div class="profile-page">
    <div class="profile-stack">

        <div class="profile-breadcrumb">
            <a href="/dashboard">Vadības panelis</a>
            <span>/</span>
            <span class="profile-breadcrumb-current">Profila iestatījumi</span>
        </div>

        <div class="profile-top-actions">
            <a href="{{ route('pdf.user.profile', $user->id) }}" class="profile-outline-btn">📄 Profila PDF</a>
        </div>

        <div class="profile-section-card profile-hero-card">
            <div class="profile-hero-inner">
                <div class="profile-avatar-wrap">
                    <div class="profile-avatar">
                        @if ($profilePhoto)
                            <img src="{{ asset('storage/' . $profilePhoto) }}" alt="Profila bilde">
                        @else
                            <span>{{ $userInitial }}</span>
                        @endif
                    </div>
                    <div class="avatar-note">
                        Tavs profils un konta iestatījumi vienuviet.
                    </div>
                </div>

                <div class="profile-hero-content">
                    <div class="profile-badge">Mans profils</div>
                    <h2 class="profile-main-name">{{ $user->name }}</h2>
                    <div class="profile-main-email">{{ $user->email }}</div>
                    <p class="profile-main-text">
                        Šeit vari pārvaldīt savu konta informāciju, atjaunināt profila attēlu, mainīt paroli un uzturēt savu profilu sakārtotu.
                    </p>

                    <div class="profile-stats">
                        <div class="stat-card">
                            <div class="stat-icon">🍲</div>
                            <div class="stat-number">{{ $recipesCount }}</div>
                            <div class="stat-label">Receptes</div>
                        </div>

                        <div class="stat-card soft-green">
                            <div class="stat-icon">❤️</div>
                            <div class="stat-number">{{ $favoritesCount }}</div>
                            <div class="stat-label">Favorīti</div>
                        </div>

                        <div class="stat-card soft-pink">
                            <div class="stat-icon">💬</div>
                            <div class="stat-number">{{ $commentsCount }}</div>
                            <div class="stat-label">Komentāri</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-section-card">
            <div class="card-header">
                <div class="card-icon">👤</div>
                <div>
                    <div class="card-title">Profila informācija</div>
                    <p class="card-subtitle">
                        Atjauniniet sava konta pamatinformāciju, e-pasta adresi un profila attēlu.
                    </p>
                </div>
            </div>

            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="profile-edit-layout">
                    <div class="photo-preview-box">
                        <div class="photo-preview-avatar" id="photoPreviewAvatar">
                            @if ($profilePhoto)
                                <img id="photoPreviewImage" src="{{ asset('storage/' . $profilePhoto) }}" alt="Profila bilde">
                            @else
                                <span id="photoPreviewInitial">{{ $userInitial }}</span>
                                <img id="photoPreviewImage" src="" alt="Profila bilde" style="display: none;">
                            @endif
                        </div>
                        <div class="photo-preview-text">
                            Rekomendēts kvadrātveida attēls labākam rezultātam.
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="profile_photo" class="form-label">Profila bilde</label>
                            <input id="profile_photo" name="profile_photo" type="file" class="form-file" accept="image/*">
                            <div class="form-help">
                                Atbalstītie formāti: JPG, PNG, WEBP. Maksimālais izmērs: 2 MB.
                            </div>
                            @error('profile_photo')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($profilePhoto)
                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="remove_profile_photo" value="1" id="removeProfilePhoto">
                                    Dzēst esošo bildi
                                </label>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name" class="form-label">Vārds</label>
                            <input id="name" name="name" type="text" class="form-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            @error('name')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">E-pasta adrese</label>
                            <input id="email" name="email" type="email" class="form-input" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            @error('email')
                                <div class="form-error">{{ $message }}</div>
                            @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="alert alert-info" style="margin-top: 12px;">
                                    <p>Jūsu e-pasta adrese vēl nav verificēta.</p>
                                    <button form="send-verification" class="btn btn-secondary" style="margin-top: 10px;">
                                        Nosūtīt verificēšanas e-pastu atkārtoti
                                    </button>

                                    @if (session('status') === 'verification-link-sent')
                                        <p style="margin-top: 10px; color: #667652;">
                                            Jauna verificēšanas saite ir nosūtīta uz jūsu e-pasta adresi.
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="actions-row">
                            <button type="submit" class="btn btn-primary">Saglabāt izmaiņas</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="profile-section-card">
            <div class="card-header">
                <div class="card-icon">🔒</div>
                <div>
                    <div class="card-title">Nomainīt paroli</div>
                    <p class="card-subtitle">
                        Izvēlieties drošu paroli, lai aizsargātu savu kontu.
                    </p>
                </div>
            </div>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="update_password_current_password" class="form-label">Pašreizējā parole</label>
                    <input id="update_password_current_password" name="current_password" type="password" class="form-input" autocomplete="current-password">
                    @error('current_password', 'updatePassword')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="update_password_password" class="form-label">Jaunā parole</label>
                    <input id="update_password_password" name="password" type="password" class="form-input" autocomplete="new-password">
                    @error('password', 'updatePassword')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="update_password_password_confirmation" class="form-label">Apstiprināt paroli</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-input" autocomplete="new-password">
                    @error('password_confirmation', 'updatePassword')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="actions-row">
                    <button type="submit" class="btn btn-success">Nomainīt paroli</button>
                </div>
            </form>
        </div>

        <div class="profile-section-card delete-section">
            <div class="card-header">
                <div class="card-icon">⚠️</div>
                <div>
                    <div class="card-title" style="color: var(--danger-text);">Dzēst kontu</div>
                    <p class="card-subtitle">
                        Konta dzēšana ir neatgriezeniska darbība.
                    </p>
                </div>
            </div>

            <div class="danger-box">
                <h4>Brīdinājums</h4>
                <p>
                    Kad jūsu konts tiks dzēsts, visas jūsu receptes un personīgie dati tiks neatgriezeniski dzēsti.
                    Pirms konta dzēšanas lejupielādējiet visu informāciju, kuru vēlaties saglabāt.
                </p>
            </div>

            <button onclick="openDeleteModal()" class="btn btn-danger">
                Dzēst kontu
            </button>
        </div>

        <div class="quick-actions-card">
            <h3 class="quick-title">Ātras darbības</h3>
            <p class="quick-subtitle">
                Ātra piekļuve svarīgākajām darbībām jūsu profilā un receptēs.
            </p>

            <div class="quick-actions-grid">
                <a href="/recipes/create" class="quick-action-card">
                    <span class="quick-action-icon">➕</span>
                    <div class="quick-action-title">Jauna recepte</div>
                    <div class="quick-action-text">Izveidojiet un publicējiet jaunu recepti savā profilā.</div>
                </a>

                <a href="/recipes" class="quick-action-card">
                    <span class="quick-action-icon">📖</span>
                    <div class="quick-action-title">Pārlūkot receptes</div>
                    <div class="quick-action-text">Apskatiet visas receptes un atrodiet jaunu iedvesmu.</div>
                </a>

                <a href="/" class="quick-action-card">
                    <span class="quick-action-icon">🏠</span>
                    <div class="quick-action-title">Sākumlapa</div>
                    <div class="quick-action-text">Atgriezieties uz platformas sākumlapu.</div>
                </a>
            </div>
        </div>

    </div>
</div>

<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-head">
            <div class="modal-icon">⚠️</div>
            <h3>Dzēst kontu</h3>
            <p>Vai tiešām vēlaties dzēst savu kontu? Šī darbība ir neatgriezeniska.</p>
        </div>

        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <div class="form-group">
                <label for="password" class="form-label">Ievadiet savu paroli, lai apstiprinātu</label>
                <input id="password" name="password" type="password" class="form-input" placeholder="Jūsu parole" required>
                @error('password', 'userDeletion')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="actions-row" style="justify-content: center; margin-top: 24px;">
                <button type="button" onclick="closeDeleteModal()" class="btn btn-secondary">
                    Atcelt
                </button>
                <button type="submit" class="btn btn-danger">
                    Dzēst kontu
                </button>
            </div>
        </form>
    </div>
</div>

@if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
    <form id="send-verification" method="post" action="{{ route('verification.send') }}" style="display: none;">
        @csrf
    </form>
@endif

<script>
    function openDeleteModal() {
        document.getElementById('deleteModal').style.display = 'block';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }

    const profilePhotoInput = document.getElementById('profile_photo');
    const photoPreviewImage = document.getElementById('photoPreviewImage');
    const photoPreviewInitial = document.getElementById('photoPreviewInitial');
    const removeProfilePhoto = document.getElementById('removeProfilePhoto');

    if (profilePhotoInput) {
        profilePhotoInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    if (photoPreviewImage) {
                        photoPreviewImage.src = e.target.result;
                        photoPreviewImage.style.display = 'block';
                    }

                    if (photoPreviewInitial) {
                        photoPreviewInitial.style.display = 'none';
                    }

                    if (removeProfilePhoto) {
                        removeProfilePhoto.checked = false;
                    }
                };

                reader.readAsDataURL(file);
            }
        });
    }

    if (removeProfilePhoto) {
        removeProfilePhoto.addEventListener('change', function () {
            if (this.checked) {
                if (photoPreviewImage) {
                    photoPreviewImage.style.display = 'none';
                    photoPreviewImage.src = '';
                }

                if (photoPreviewInitial) {
                    photoPreviewInitial.style.display = 'flex';
                }

                if (profilePhotoInput) {
                    profilePhotoInput.value = '';
                }
            }
        });
    }
</script>
@endsection