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
        <p><strong>Kopējais skatījumu skaits:</strong> {{ $totalViews }}</p>
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
            @foreach($recipes as $recipe)
                @php
                    $avg = $recipe->reviews->avg('rating');
                @endphp
                <tr>
                    <td>{{ $recipe->title }}</td>
                    <td>{{ isset($recipe->views_count) ? $recipe->views_count : '-' }}</td>
                    <td>{{ $avg ? number_format($avg, 1) : '-' }}</td>
                    <td>{{ $recipe->user->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>