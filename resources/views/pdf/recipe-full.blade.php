<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>{{ $recipe->title }}</title>
    @include('pdf.styles')
</head>
<body>
    @php
        $imagePath = null;

        if (!empty($recipe->image_path) && file_exists(public_path('storage/' . $recipe->image_path))) {
            $imagePath = public_path('storage/' . $recipe->image_path);
        } elseif (!empty($recipe->image_url)) {
            $imagePath = $recipe->image_url;
        }
    @endphp

    <div class="header">
        <h1>{{ $recipe->title }}</h1>

        <div class="meta">
            <p><strong>Kategorija:</strong> {{ $recipe->category ?? '-' }}</p>
            <p><strong>Porciju skaits:</strong> {{ $targetServings ?? ($recipe->servings ?? '-') }}</p>
            <p><strong>Pagatavošanas laiks:</strong> {{ (int)($recipe->prep_time ?? 0) + (int)($recipe->cook_time ?? 0) }} min</p>
            <p><strong>Sarežģītība:</strong> {{ $recipe->difficulty ?? '-' }}</p>
        </div>

        @if($imagePath)
            <div style="margin-top: 15px; text-align: center;">
                <img
                    src="{{ $imagePath }}"
                    alt="Recepte"
                    style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 10px;"
                >
            </div>
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