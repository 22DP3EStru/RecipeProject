<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Filtrētās receptes</title>
    @include('pdf.styles')
</head>
<body>
    <div class="header">
        <h1>Receptes pēc izvēlētiem filtriem</h1>
        <p><strong>Kategorija:</strong> {{ $filters['category'] ?: '-' }}</p>
        <p><strong>Sarežģītība:</strong> {{ $filters['difficulty'] ?: '-' }}</p>
        <p><strong>Maksimālais laiks:</strong> {{ $filters['max_time'] ? $filters['max_time'] . ' min' : '-' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Kategorija</th>
                <th>Laiks</th>
                <th>Sarežģītība</th>
                <th>Vērtējums</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recipes as $recipe)
                @php
                    $avg = $recipe->reviews->avg('rating');
                    $totalTime = (int)($recipe->prep_time ?? 0) + (int)($recipe->cook_time ?? 0);
                @endphp
                <tr>
                    <td>{{ $recipe->title }}</td>
                    <td>{{ $recipe->category ?? '-' }}</td>
                    <td>{{ $totalTime }} min</td>
                    <td>{{ $recipe->difficulty ?? '-' }}</td>
                    <td>{{ $avg ? number_format($avg, 1) : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>