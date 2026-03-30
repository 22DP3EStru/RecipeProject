<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Populārākās receptes</title>
    @include('pdf.styles')
</head>
<body>
    <div class="header">
        <h1>Populārākās receptes</h1>
        <p><strong>Laika periods:</strong> Pēdējās {{ $days }} dienās</p>
        <p><strong>Kopējais skatījumu skaits:</strong> {{ number_format($totalViews ?? 0, 0, ',', ' ') }}</p>
        <p><strong>Populārāko recepšu skaits:</strong> {{ $recipes->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Skatījumi</th>
                <th>Vidējais vērtējums</th>
                <th>Autors</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recipes as $recipe)
                @php
                    $avg = $recipe->reviews->avg('rating');
                @endphp
                <tr>
                    <td>{{ $recipe->title }}</td>
                    <td>{{ number_format((int)($recipe->views ?? 0), 0, ',', ' ') }}</td>
                    <td>{{ $avg ? number_format($avg, 1) : '-' }}</td>
                    <td>{{ $recipe->user->name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nav pieejamu datu.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>