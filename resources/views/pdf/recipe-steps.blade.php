<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Soļi - {{ $recipe->title }}</title>
    @include('pdf.styles')
</head>
<body>
    <div class="header center">
        <h1>{{ $recipe->title }}</h1>
        <p><strong>Porciju skaits:</strong> {{ $targetServings ?? ($recipe->servings ?? '-') }}</p>
        <p><strong>Pagatavošanas laiks:</strong> {{ (int)($recipe->prep_time ?? 0) + (int)($recipe->cook_time ?? 0) }} min</p>
        <p><strong>Kopējais soļu skaits:</strong> {{ count($steps) }}</p>
    </div>

    @if(count($steps))
        <table>
            <thead>
                <tr>
                    <th>Nr.</th>
                    <th>Apraksts</th>
                </tr>
            </thead>
            <tbody>
                @foreach($steps as $index => $step)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $step }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>{{ $recipe->instructions ?? 'Pagatavošanas soļi nav pievienoti.' }}</p>
    @endif
</body>
</html>