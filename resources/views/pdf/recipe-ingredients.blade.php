<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Sastāvdaļas - {{ $recipe->title }}</title>
    @include('pdf.styles')
</head>
<body>
    <div class="header">
        <h1>{{ $recipe->title }}</h1>

        <div class="meta">
            <p><strong>Kategorija:</strong> {{ $recipe->category ?? '-' }}</p>
            <p><strong>Porciju skaits:</strong> {{ $targetServings ?? ($recipe->servings ?? '-') }}</p>
            <p><strong>Kopējais sastāvdaļu skaits:</strong> {{ !empty($scaledIngredients) ? count($scaledIngredients) : '-' }}</p>
        </div>
    </div>

    @if(!empty($scaledIngredients) && count($scaledIngredients))
        <table>
            <thead>
                <tr>
                    <th>Sastāvdaļa</th>
                    <th>Daudzums</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scaledIngredients as $ingredient)
                    <tr>
                        <td>{{ $ingredient['name'] }}</td>
                        <td>{{ $ingredient['amount'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>{{ $recipe->ingredients ?? 'Sastāvdaļas nav pievienotas.' }}</p>
    @endif
</body>
</html>