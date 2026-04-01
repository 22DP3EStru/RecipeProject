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

    .breadcrumb {
        font-size: 14px;
        color: var(--muted);
        margin-bottom: 24px;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--line);
    }

    .breadcrumb a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 600;
    }

    .pdf-actions {
        margin-bottom: 22px;
    }

    .profile-sections {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .profile-card {
        background: var(--surface);
        border: 1px solid var(--line);
        padding: 30px;
        box-shadow: 0 10px 30px rgba(79, 59, 42, 0.05);
    }

    .profile-hero-card {
        background: linear-gradient(180deg, #fffdf9 0%, #fbf6ef 100%);
        border: 1px solid var(--line);
        box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
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
        width: 124px;
        height: 124px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #f0e5d8;
        box-shadow: 0 10px 24px rgba(122, 90, 67, 0.12);
        background: linear-gradient(135deg, #efe3d5 0%, #e7d5c3 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 2.8rem;
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
        max-width: 160px;
    }

    .profile-hero-content {
        min-width: 0;
    }

    .profile-badge {
        display: inline-block;
        padding: 7px 12px;
        border: 1px solid #eadbcb;
        background: #f8efe5;
        color: var(--accent);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    .profile-main-name {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.6rem;
        font-weight: 500;
        color: var(--accent);
        margin: 0 0 8px;
        line-height: 1.1;
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
        background: #fffdfa;
        border: 1px solid #eadbcb;
        padding: 18px 16px;
        transition: transform 0.18s ease, box-shadow 0.18s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 59, 42, 0.06);
    }

    .stat-icon {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--accent);
        line-height: 1;
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 13px;
        color: var(--muted);
        font-weight: 600;
    }

    .card-header {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 24px;
        padding-bottom: 14px;
        border-bottom: 1px solid #e3d6c8;
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
    }

    .card-subtitle {
        color: var(--muted);
        font-size: 14px;
        line-height: 1.7;
    }

    .profile-edit-layout {
        display: grid;
        grid-template-columns: 180px 1fr;
        gap: 24px;
        align-items: start;
    }

    .photo-preview-box {
        background: #fcf7f1;
        border: 1px solid #eadbcb;
        padding: 18px;
        text-align: center;
    }

    .photo-preview-avatar {
        width: 120px;
        height: 120px;
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

    .form-input {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid var(--line);
        font-size: 15px;
        background: #fffdfa;
        color: var(--text);
        transition: 0.2s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #bba692;
        background: #fff;
    }

    .form-file {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--line);
        background: #fffdfa;
        color: var(--text);
        font-size: 14px;
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
    }

    .actions-row {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .pdf-btn {
        display: inline-block;
        padding: 12px 18px;
        text-decoration: none;
        border: 1px solid var(--line);
        background: var(--surface-soft);
        color: var(--accent);
        font-size: 14px;
        font-weight: 700;
    }

    .pdf-btn:hover {
        background: var(--surface-soft-2);
    }

    .alert {
        padding: 14px 18px;
        margin-bottom: 18px;
        border: 1px solid var(--line);
        font-weight: 600;
    }

    .alert-info {
        background: #f3ece3;
        border-color: #dfcfbf;
        color: #7a5a43;
    }

    .delete-section {
        background: #fbefec;
        border-color: #e7d0ca;
    }

    .danger-box {
        background: rgba(255,255,255,0.4);
        border: 1px solid #e7d0ca;
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

    .quick-actions {
        margin-top: 38px;
        padding-top: 26px;
        border-top: 1px solid var(--line);
    }

    .quick-title {
        text-align: center;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2rem;
        color: var(--accent);
        margin-bottom: 20px;
        font-weight: 500;
    }

    .quick-actions-row {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(47, 36, 29, 0.38);
        z-index: 1000;
        padding: 20px;
    }

    .modal-content {
        background: var(--surface);
        margin: 8% auto 0;
        padding: 30px;
        border: 1px solid var(--line);
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

    @media (max-width: 900px) {
        .profile-card {
            padding: 22px;
        }

        .profile-hero-inner,
        .profile-edit-layout {
            grid-template-columns: 1fr;
        }

        .profile-avatar-wrap {
            align-items: flex-start;
        }
    }

    @media (max-width: 640px) {
        .card-header {
            flex-direction: column;
        }

        .profile-main-name {
            font-size: 2rem;
        }

        .profile-stats {
            grid-template-columns: 1fr;
        }

        .modal-content {
            margin-top: 20%;
            padding: 22px;
        }
    }
</style>

<div class="profile-page">
    <div class="breadcrumb">
        <a href="/dashboard">Vadības panelis</a>
        <span> / </span>
        <span style="font-weight: 700; color: var(--text);">Profila iestatījumi</span>
    </div>

    <div class="pdf-actions">
        <a href="{{ route('pdf.user.profile', $user->id) }}" class="pdf-btn">Profila PDF</a>
    </div>

    <div class="profile-sections">
        <div class="profile-card profile-hero-card">
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
                        Šeit vari pārvaldīt savu konta informāciju, atjaunināt profila attēlu un uzturēt savu profilu sakārtotu.
                    </p>

                    <div class="profile-stats">
                        <div class="stat-card">
                            <div class="stat-icon">🍲</div>
                            <div class="stat-number">{{ $recipesCount }}</div>
                            <div class="stat-label">Receptes</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon">❤️</div>
                            <div class="stat-number">{{ $favoritesCount }}</div>
                            <div class="stat-label">Favorīti</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon">💬</div>
                            <div class="stat-number">{{ $commentsCount }}</div>
                            <div class="stat-label">Komentāri</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-card">
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
                                <label style="display: inline-flex; align-items: center; gap: 8px; font-size: 14px; color: var(--muted);">
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

        <div class="profile-card">
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

        <div class="profile-card delete-section">
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
    </div>

    <div class="quick-actions">
        <h3 class="quick-title">Ātras darbības</h3>
        <div class="quick-actions-row">
            <a href="/recipes/create" class="btn btn-success">Izveidot jaunu recepti</a>
            <a href="/recipes" class="btn btn-secondary">Pārlūkot receptes</a>
            <a href="/" class="btn btn-primary">Sākumlapa</a>
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