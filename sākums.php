<!-- filepath: /workspaces/RecipeProject/resources/views/sakums.blade.php -->
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modernā Recepšu Mājaslapa</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>Recepšu Mājaslapa</h1>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Sākums</a></li>
                <li><a href="{{ url('/recipes') }}">Receptes</a></li>
                <li><a href="{{ url('/login') }}">Pieslēgties</a></li>
                <li><a href="{{ url('/register') }}">Reģistrēties</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Laipni lūgti recepšu vietnē!</h2>
        <p>Atrodiet un dalieties ar savām iecienītākajām receptēm.</p>
        <button>Pievienot jaunu recepti</button>
    </main>
    <footer>
        <p>&copy; 2025 Recepšu Mājaslapa</p>
    </footer>
</body>
</html>