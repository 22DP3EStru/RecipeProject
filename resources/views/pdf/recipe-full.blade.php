<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>{{ $recipe->title }}</title>
    @include('pdf.styles')
</head>
<body>
    <div class="header">
        <h1>{{ $recipe->title }}</h1>

        <div class="meta">
            <p><strong>Kategorija:</strong> {{ $recipe->category ?? '-' }}</p>
            <p><strong>Porciju skaits:</strong> {{ $targetServings ?? ($recipe->servings ?? '-') }}</p>
            <p><strong>Pagatavošanas laiks:</strong> {{ (int)($recipe->prep_time ?? 0) + (int)($recipe->cook_time ?? 0) }} min</p>
            <p><strong>Sarežģītība:</strong> {{ $recipe->difficulty ?? '-' }}</p>
        </div>

        @if(!empty($recipe->image_path))
            <img src="{{ public_path('storage/' . $recipe->image_path) }}" class="cover-image" alt="Recepte">
        @endif
    </div>

    <h2>Sastāvdaļas</h2>

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

    <h2 style="margin-top: 24px;">Pagatavošanas soļi</h2>

    @if(count($steps))
        @foreach($steps as $index => $step)
            <div class="step-block">
                <p><strong>{{ $index + 1 }}. solis</strong></p>
                <p>{{ $step }}</p>
            </div>
        @endforeach
    @else
        <p>{{ $recipe->instructions ?? 'Pagatavošanas soļi nav pievienoti.' }}</p>
    @endif
</body>
</html>