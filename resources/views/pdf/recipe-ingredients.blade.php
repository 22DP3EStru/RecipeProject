<!--
    Sastāvdaļu PDF skats.

    Šis Blade fails tiek izmantots PDF dokumenta ģenerēšanai,
    kurā tiek attēlotas tikai receptes sastāvdaļas.

    Dokumentā tiek attēlots:
    - receptes nosaukums;
    - kategorija;
    - porciju skaits;
    - sastāvdaļu kopskaits;
    - sastāvdaļu saraksts ar daudzumiem.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <!-- Dokumenta kodējums latviešu simbolu pareizai attēlošanai. -->
    <meta charset="UTF-8">

    <!-- PDF dokumenta virsraksts ar receptes nosaukumu. -->
    <title>Sastāvdaļas - {{ $recipe->title }}</title>

    <!-- Kopējie PDF stili tiek ielādēti no atsevišķa Blade faila. -->
    @include('pdf.styles')
</head>

<body>
    <!--
        Dokumenta galvene.

        Tajā tiek attēlota pamatinformācija par recepti.
    -->
    <div class="header">
        <!-- Receptes nosaukums. -->
        <h1>{{ $recipe->title }}</h1>

        <div class="meta">
            <!-- Receptes kategorija. -->
            <p><strong>Kategorija:</strong> {{ $recipe->category ?? '-' }}</p>

            <!--
                Porciju skaits.

                Ja lietotājs izvēlējies citu porciju daudzumu PDF ģenerēšanas laikā,
                tiek izmantota $targetServings vērtība.
            -->
            <p><strong>Porciju skaits:</strong> {{ $targetServings ?? ($recipe->servings ?? '-') }}</p>

            <!--
                Kopējais sastāvdaļu skaits.

                count() aprēķina, cik sastāvdaļas ir scaledIngredients masīvā.
                Ja sastāvdaļu saraksts nav pieejams, tiek attēlota svītra.
            -->
            <p>
                <strong>Kopējais sastāvdaļu skaits:</strong>
                {{ !empty($scaledIngredients) ? count($scaledIngredients) : '-' }}
            </p>
        </div>
    </div>

    <!--
        Sastāvdaļu tabula.

        Ja scaledIngredients masīvā ir pieejami strukturēti dati,
        sastāvdaļas tiek attēlotas tabulas veidā.
    -->
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
                        <!-- Sastāvdaļas nosaukums. -->
                        <td>{{ $ingredient['name'] }}</td>

                        <!--
                            Sastāvdaļas daudzums.

                            Šī vērtība var būt pārrēķināta,
                            ja lietotājs izvēlējies citu porciju skaitu.
                        -->
                        <td>{{ $ingredient['amount'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <!--
            Ja strukturēts sastāvdaļu saraksts nav pieejams,
            tiek attēlots vienkāršs ingredients teksts.
        -->
        <p>{{ $recipe->ingredients ?? 'Sastāvdaļas nav pievienotas.' }}</p>
    @endif
</body>
</html>