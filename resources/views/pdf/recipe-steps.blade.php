<!--
    Pagatavošanas soļu PDF skats.

    Šis Blade fails tiek izmantots PDF dokumenta ģenerēšanai,
    kurā tiek attēloti tikai receptes pagatavošanas soļi.

    Dokumentā tiek attēlots:
    - receptes nosaukums;
    - porciju skaits;
    - kopējais pagatavošanas laiks;
    - pagatavošanas soļu skaits;
    - visi pagatavošanas soļi tabulas veidā.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <!-- Dokumenta kodējums latviešu simbolu pareizai attēlošanai. -->
    <meta charset="UTF-8">

    <!-- PDF dokumenta virsraksts ar receptes nosaukumu. -->
    <title>Soļi - {{ $recipe->title }}</title>

    <!-- Kopējie PDF stili tiek ielādēti no atsevišķa Blade faila. -->
    @include('pdf.styles')
</head>

<body>
    <!--
        Dokumenta galvene.

        Tajā tiek attēlota galvenā informācija par recepti
        un pagatavošanas procesu.
    -->
    <div class="header center">
        <!-- Receptes nosaukums. -->
        <h1>{{ $recipe->title }}</h1>

        <!--
            Porciju skaits.

            Ja PDF ģenerēšanas laikā izvēlēts cits porciju skaits,
            tiek izmantota $targetServings vērtība.
        -->
        <p><strong>Porciju skaits:</strong> {{ $targetServings ?? ($recipe->servings ?? '-') }}</p>

        <!--
            Kopējais pagatavošanas laiks.

            Tas tiek aprēķināts, saskaitot:
            - sagatavošanas laiku;
            - gatavošanas laiku.
        -->
        <p>
            <strong>Pagatavošanas laiks:</strong>
            {{ (int)($recipe->prep_time ?? 0) + (int)($recipe->cook_time ?? 0) }} min
        </p>

        <!--
            Kopējais pagatavošanas soļu skaits.

            count($steps) aprēķina,
            cik soļi ir pieejami receptes instrukcijās.
        -->
        <p><strong>Kopējais soļu skaits:</strong> {{ count($steps) }}</p>
    </div>

    <!--
        Pagatavošanas soļu tabula.

        Ja receptei ir pieejami strukturēti soļi,
        tie tiek attēloti tabulas veidā.
    -->
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
                        <!-- Soļa kārtas numurs. -->
                        <td>{{ $index + 1 }}</td>

                        <!-- Soļa apraksts. -->
                        <td>{{ $step }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <!--
            Ja strukturēti pagatavošanas soļi nav pieejami,
            tiek attēlots pilnais instructions teksts.
        -->
        <p>{{ $recipe->instructions ?? 'Pagatavošanas soļi nav pievienoti.' }}</p>
    @endif
</body>
</html>