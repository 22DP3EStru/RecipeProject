@extends('layouts.app')

@section('title', 'Rediģēt profilu - Vecmāmiņas Receptes')
@section('meta_description', 'Pārvaldiet sava konta informāciju, nomainiet paroli un kontrolējiet personīgos iestatījumus Vecmāmiņas Receptes profilā.')

@section('hero_title', 'Profils')
@section('hero_text', 'Pārvaldiet sava konta informāciju, drošību un iestatījumus')

@section('content')
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

    .alert-success {
        background: #f1f5ea;
        border-color: #d7ddcc;
        color: #607149;
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
    }

    @media (max-width: 640px) {
        .card-header {
            flex-direction: column;
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

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success">
            Profils veiksmīgi atjaunināts.
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="alert alert-success">
            Parole veiksmīgi nomainīta.
        </div>
    @endif

    <div class="profile-sections">
        <div class="profile-card">
            <div class="card-header">
                <div class="card-icon">👤</div>
                <div>
                    <div class="card-title">Profila informācija</div>
                    <p class="card-subtitle">
                        Atjauniniet sava konta pamatinformāciju un e-pasta adresi.
                    </p>
                </div>
            </div>

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

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
            <a href="/profile/recipes" class="btn btn-primary">Manas receptes</a>
            <a href="/recipes/create" class="btn btn-success">Izveidot jaunu recepti</a>
            <a href="/recipes" class="btn btn-secondary">Pārlūkot receptes</a>
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
</script>
@endsection