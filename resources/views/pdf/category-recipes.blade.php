<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Kategorijas receptes</title>
    @include('pdf.styles')
</head>
<body>
    <div class="header">
        <h1>{{ $category->name }}</h1>
        <p><strong>Apraksts:</strong> {{ $category->slug ?? '-' }}</p>
        <p><strong>Recepšu kopskaits:</strong> {{ $recipes->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Autors</th>
                <th>Pagatavošanas laiks</th>
                <th>Sarežģītība</th>
                <th>Vidējais vērtējums</th>
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
                    <td>{{ $recipe->user->name ?? '-' }}</td>
                    <td>{{ $totalTime }} min</td>
                    <td>{{ $recipe->difficulty ?? '-' }}</td>
                    <td>{{ $avg ? number_format($avg, 1) : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>