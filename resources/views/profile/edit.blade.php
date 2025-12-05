<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rediģēt profilu - Recepšu Aplikācija</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            color: white;
            margin-bottom: 40px;
            padding: 40px 0;
        }

        .header h1 {
            font-size: 3rem;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.3rem;
            opacity: 0.9;
        }

        .nav-bar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-brand {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: #333;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-links a:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .profile-sections {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(102, 126, 234, 0.1);
        }

        .card-icon {
            font-size: 2rem;
            margin-right: 15px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid rgba(102, 126, 234, 0.2);
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-error {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(86, 171, 47, 0.1) 0%, rgba(168, 230, 207, 0.1) 100%);
            color: #56ab2f;
            border: 1px solid rgba(86, 171, 47, 0.2);
        }

        .alert-info {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            color: #667eea;
            border: 1px solid rgba(102, 126, 234, 0.2);
        }

        .delete-section {
            background: linear-gradient(135deg, rgba(255, 65, 108, 0.05) 0%, rgba(255, 75, 43, 0.05) 100%);
            border: 2px solid rgba(255, 65, 108, 0.1);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            background: white;
            margin: 10% auto;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header p { font-size: 1rem; }
            .nav-bar { flex-direction: column; gap: 15px; }
            .main-content { padding: 20px; }
            .profile-card { padding: 20px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>⚙️ Profila iestatījumi</h1>
            <p>Pārvaldiet savu kontu un personīgo informāciju</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">🍽️ Recepšu Aplikācija</a>
            <div class="nav-links">
                <a href="/dashboard">🏠 Vadības panelis</a>
                <a href="/recipes">🍽️ Receptes</a>
                <a href="{{ route('categories.index') }}">📂 Kategorijas</a>
                <a href="/profile/recipes">📝 Manas receptes</a>
                <a href="{{ route('profile.edit') }}">⚙️ Profils</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.index') }}">🔧 Administrācija</a>
                @endif
            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <span style="color: #666; font-weight: 500;">👤 {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="padding: 10px 20px; font-size: 14px;">Iziet</button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Breadcrumb -->
            <div style="margin-bottom: 30px; padding: 15px; background: rgba(102, 126, 234, 0.1); border-radius: 10px;">
                <a href="/dashboard" style="color: #667eea; text-decoration: none;">🏠 Vadības panelis</a> 
                <span style="color: #666;"> / </span>
                <span style="color: #333; font-weight: 600;">⚙️ Profila iestatījumi</span>
            </div>

            <!-- Success Messages -->
            @if (session('status') === 'profile-updated')
                <div class="alert alert-success">
                    ✅ Profils veiksmīgi atjaunināts!
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="alert alert-success">
                    ✅ Parole veiksmīgi nomainīta!
                </div>
            @endif

            <!-- Profile Sections -->
            <div class="profile-sections">
                <!-- Profile Information -->
                <div class="profile-card">
                    <div class="card-header">
                        <div class="card-icon" style="color: #667eea;">👤</div>
                        <div>
                            <div class="card-title">Profila informācija</div>
                            <p style="color: #666; font-size: 14px; margin-top: 5px;">Atjauniniet sava konta profila informāciju un e-pasta adresi</p>
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
                                <div class="alert alert-info" style="margin-top: 10px;">
                                    <p>Jūsu e-pasta adrese nav verificēta.</p>
                                    <button form="send-verification" class="btn btn-secondary" style="margin-top: 10px;">
                                        Nosūtīt verificēšanas e-pastu atkārtoti
                                    </button>
                                    @if (session('status') === 'verification-link-sent')
                                        <p style="margin-top: 10px; color: #56ab2f;">Jauna verificēšanas saite ir nosūtīta uz jūsu e-pasta adresi.</p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div style="display: flex; align-items: center; gap: 15px;">
                            <button type="submit" class="btn btn-primary">Saglabāt izmaiņas</button>
                        </div>
                    </form>
                </div>

                <!-- Update Password -->
                <div class="profile-card">
                    <div class="card-header">
                        <div class="card-icon" style="color: #56ab2f;">🔒</div>
                        <div>
                            <div class="card-title">Nomainīt paroli</div>
                            <p style="color: #666; font-size: 14px; margin-top: 5px;">Nodrošiniet, ka jūsu konts izmanto garu, nejauši ģenerētu paroli</p>
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

                        <div style="display: flex; align-items: center; gap: 15px;">
                            <button type="submit" class="btn btn-success">Nomainīt paroli</button>
                        </div>
                    </form>
                </div>

                <!-- Delete Account -->
                <div class="profile-card delete-section">
                    <div class="card-header">
                        <div class="card-icon" style="color: #ff416c;">⚠️</div>
                        <div>
                            <div class="card-title" style="color: #ff416c;">Dzēst kontu</div>
                            <p style="color: #666; font-size: 14px; margin-top: 5px;">Kad jūsu konts tiks dzēsts, visi tā resursi un dati tiks neatgriezeniski dzēsti</p>
                        </div>
                    </div>

                    <div style="background: rgba(255, 65, 108, 0.1); padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                        <h4 style="color: #ff416c; margin-bottom: 10px;">⚠️ Brīdinājums</h4>
                        <p style="color: #666; line-height: 1.5;">
                            Kad jūsu konts tiks dzēsts, visas jūsu receptes un personīgie dati tiks neatgriezeniski dzēsti. 
                            Pirms konta dzēšanas, lūdzu, lejupielādējiet visus datus vai informāciju, ko vēlaties saglabāt.
                        </p>
                    </div>

                    <button onclick="openDeleteModal()" class="btn btn-danger">
                        🗑️ Dzēst kontu
                    </button>
                </div>
            </div>

            <!-- Quick Actions -->
            <div style="margin-top: 40px; padding: 30px; background: rgba(102, 126, 234, 0.05); border-radius: 15px;">
                <h3 style="text-align: center; color: #667eea; margin-bottom: 25px;">🚀 Ātras darbības</h3>
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                    <a href="/profile/recipes" class="btn btn-primary">
                        📝 Manas receptes
                    </a>
                    <a href="/recipes/create" class="btn btn-success">
                        ➕ Izveidot jaunu recepti
                    </a>
                    <a href="/recipes" class="btn btn-secondary">
                        🔍 Pārlūkot receptes
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div style="text-align: center; margin-bottom: 25px;">
                <div style="font-size: 4rem; color: #ff416c; margin-bottom: 15px;">⚠️</div>
                <h3 style="color: #ff416c; margin-bottom: 10px;">Dzēst kontu</h3>
                <p style="color: #666;">Vai tiešām vēlaties dzēst savu kontu? Šī darbība ir neatgriezeniska.</p>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="form-group">
                    <label for="password" class="form-label">Ievadiet savu paroli, lai apstiprinātu:</label>
                    <input id="password" name="password" type="password" class="form-input" placeholder="Jūsu parole" required>
                    @error('password', 'userDeletion')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display: flex; gap: 15px; justify-content: center; margin-top: 25px;">
                    <button type="button" onclick="closeDeleteModal()" class="btn btn-secondary">
                        Atcelt
                    </button>
                    <button type="submit" class="btn btn-danger">
                        🗑️ Dzēst kontu
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Email Verification Form -->
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

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>