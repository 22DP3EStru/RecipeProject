<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakti - Vecmāmiņas Receptes</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{
            font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
            background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
            min-height:100vh;
            color:#333
        }
        .container{max-width:1000px;margin:0 auto;padding:20px}
        .header{text-align:center;color:white;margin-bottom:30px;padding:40px 0}
        .header h1{font-size:3rem;margin-bottom:10px;text-shadow:2px 2px 4px rgba(0,0,0,0.3)}
        .header p{font-size:1.2rem;opacity:.9}

        .nav-bar{
            background:rgba(255,255,255,0.95);
            backdrop-filter:blur(10px);
            border-radius:15px;
            padding:20px;
            margin-bottom:30px;
            box-shadow:0 8px 32px rgba(0,0,0,0.1);
            display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:15px
        }
        .nav-brand{font-size:24px;font-weight:800;color:#667eea;text-decoration:none}
        .nav-links{display:flex;gap:20px;flex-wrap:wrap}
        .nav-links a{
            color:#333;text-decoration:none;padding:8px 16px;border-radius:8px;
            transition:.3s;font-weight:500
        }
        .nav-links a:hover{background:#667eea;color:#fff;transform:translateY(-2px)}

        .main{
            background:rgba(255,255,255,0.95);
            backdrop-filter:blur(10px);
            border-radius:20px;
            padding:40px;
            box-shadow:0 15px 35px rgba(0,0,0,0.1);
            border:1px solid rgba(255,255,255,0.2)
        }
        .card{
            background:rgba(255,255,255,0.85);
            border-radius:15px;
            padding:25px;
            box-shadow:0 8px 25px rgba(0,0,0,0.08);
            border:1px solid rgba(255,255,255,0.3);
            margin-bottom:20px
        }
        .row{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
            gap:20px;
            margin-top:20px
        }
        .muted{color:#666;line-height:1.7}

        .btn{
            display:inline-block;
            padding:12px 18px;
            border-radius:12px;
            text-decoration:none;
            font-weight:700;
            border:none;
            cursor:pointer;
            background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
            color:#fff;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
            transition:.3s
        }
        .btn:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(0,0,0,0.15)}

        @media(max-width:768px){
            .header h1{font-size:2rem}
            .main{padding:20px}
        }
    </style>
</head>
<body>
<div class="container">

    <div class="header">
        <h1>📞 Kontakti</h1>
        <p>Vecmāmiņas Receptes — sazinies ar mums, ja ir jautājumi vai ieteikumi</p>
    </div>

    <nav class="nav-bar">
        <a href="/dashboard" class="nav-brand">🍲 Vecmāmiņas Receptes</a>

        <div class="nav-links">
            <a href="/dashboard">🏠 Vadības panelis</a>
            <a href="/recipes">🍽️ Receptes</a>
            <a href="/categories">📂 Kategorijas</a>
            <a href="/profile/recipes">📝 Manas receptes</a>
            @auth
                <a href="{{ route('profile.favorites') }}">❤️ Favorīti</a>
            @endauth
            <a href="{{ route('contact') }}">📞 Kontakti</a>
        </div>

        <a href="/dashboard" class="btn">← Atpakaļ</a>
    </nav>

    <div class="main">
        <div class="card">
            <h2 style="margin-bottom:10px;">Kā ar mums sazināties</h2>
            <p class="muted">
                Ja pamanīji kļūdu, vēlies ieteikt uzlabojumu vai ir jautājums par “Vecmāmiņas Receptes”,
                izmanto kādu no kontaktiem zemāk.
            </p>
        </div>

        <div class="row">
            <div class="card">
                <h3>👤 Galvenais kontakts</h3>
                <p class="muted">
                    E-pasts: <strong>info@vecmaminasreceptes.lv</strong><br>
                    Tālrunis: <strong>+371 20000000</strong><br>
                    Darba laiks: <strong>P–Pk 09:00–18:00</strong>
                </p>
            </div>

            <div class="card">
                <h3>🛠️ Tehniskais atbalsts</h3>
                <p class="muted">
                    E-pasts: <strong>support@vecmaminasreceptes.lv</strong><br>
                    Atbildes laiks: <strong>24–48h</strong><br>
                    Iekļauj: lietotājvārdu + īsu problēmas aprakstu
                </p>
            </div>

            <div class="card">
                <h3>💬 Ieteikumi / sadarbība</h3>
                <p class="muted">
                    E-pasts: <strong>sadarbiba@vecmaminasreceptes.lv</strong><br>
                    Raksti, ja ir idejas jaunām funkcijām vai saturam.
                </p>
            </div>
        </div>

        <div class="card" style="margin-top:10px;">
            <h3 style="margin-bottom:10px;">📌 Ātrais jautājums</h3>
            <p class="muted">
                Ja jautājums ir par konkrētu recepti, pievieno receptes nosaukumu un (ja vari) saiti uz to.
            </p>
        </div>
    </div>

</div>
</body>
</html>
