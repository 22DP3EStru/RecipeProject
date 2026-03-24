<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Sistēmas statistika</title>
    @include('pdf.styles')
</head>
<body>
    <div class="header">
        <h1>Sistēmas statistika</h1>
        <p><strong>Datuma zīmogs:</strong> {{ $generatedAt->format('d.m.Y H:i') }}</p>
    </div>

    <table>
        <tbody>
            <tr>
                <th>Lietotāju skaits</th>
                <td>{{ $usersCount }}</td>
            </tr>
            <tr>
                <th>Recepšu kopskaits</th>
                <td>{{ $recipesCount }}</td>
            </tr>
            <tr>
                <th>Komentāru skaits</th>
                <td>{{ $commentsCount }}</td>
            </tr>
            <tr>
                <th>Vidējais vērtējums</th>
                <td>{{ number_format($averageRating ?? 0, 1) }}</td>
            </tr>
        </tbody>
    </table>

    <h2 style="margin-top: 24px;">Vispopulārākās receptes</h2>

    <table>
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Autors</th>
                <th>Vērtējums</th>
            </tr>
        </thead>
        <tbody>
            @foreach($popularRecipes as $recipe)
                @php
                    $avg = $recipe->reviews->avg('rating');
                @endphp
                <tr>
                    <td>{{ $recipe->title }}</td>
                    <td>{{ $recipe->user->name ?? '-' }}</td>
                    <td>{{ $avg ? number_format($avg, 1) : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>