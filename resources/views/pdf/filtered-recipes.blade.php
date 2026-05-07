<!--
    Filtrēto recepšu PDF skats.

    Šis Blade fails tiek izmantots PDF dokumenta ģenerēšanai,
    kurā tiek attēlotas receptes pēc lietotāja izvēlētiem filtriem.

    Dokumentā tiek attēlots:
    - izvēlētā kategorija;
    - izvēlētais sarežģītības līmenis;
    - maksimālais pagatavošanas laiks;
    - filtrētās receptes;
    - recepšu vērtējumi un pagatavošanas laiki.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <!-- Dokumenta kodējums latviešu simbolu pareizai attēlošanai. -->
    <meta charset="UTF-8">

    <!-- PDF dokumenta virsraksts. -->
    <title>Filtrētās receptes</title>

    <!-- Kopējie PDF stili tiek ielādēti no atsevišķa Blade faila. -->
    @include('pdf.styles')
</head>

<body>
    <!--
        Dokumenta galvene.

        Šeit tiek attēloti visi lietotāja izvēlētie filtri,
        pēc kuriem tika atlasītas receptes.
    -->
    <div class="header">
        <h1>Receptes pēc izvēlētiem filtriem</h1>

        <!--
            Izvēlētā kategorija.

            Ja kategorija nav izvēlēta,
            tiek attēlota svītra.
        -->
        <p><strong>Kategorija:</strong> {{ $filters['category'] ?: '-' }}</p>

        <!--
            Izvēlētais sarežģītības līmenis.

            Ja filtrs nav izmantots,
            tiek attēlota svītra.
        -->
        <p><strong>Sarežģītība:</strong> {{ $filters['difficulty'] ?: '-' }}</p>

        <!--
            Maksimālais pagatavošanas laiks.

            Ja lietotājs nav norādījis laika limitu,
            tiek attēlota svītra.
        -->
        <p>
            <strong>Maksimālais laiks:</strong>
            {{ $filters['max_time'] ? $filters['max_time'] . ' min' : '-' }}
        </p>
    </div>

    <!--
        Filtrēto recepšu tabula.

        Tajā tiek attēlotas visas receptes,
        kas atbilst izvēlētajiem filtriem.
    -->
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
                    /*
                        Aprēķina receptes vidējo vērtējumu.

                        Vērtējumi tiek iegūti no reviews relācijas.
                    */
                    $avg = $recipe->reviews->avg('rating');

                    /*
                        Aprēķina kopējo receptes pagatavošanas laiku.

                        Kopējais laiks sastāv no:
                        - sagatavošanas laika;
                        - gatavošanas laika.
                    */
                    $totalTime = (int)($recipe->prep_time ?? 0) + (int)($recipe->cook_time ?? 0);
                @endphp

                <tr>
                    <!-- Receptes nosaukums. -->
                    <td>{{ $recipe->title }}</td>

                    <!-- Receptes kategorija. -->
                    <td>{{ $recipe->category ?? '-' }}</td>

                    <!-- Kopējais pagatavošanas laiks minūtēs. -->
                    <td>{{ $totalTime }} min</td>

                    <!-- Receptes sarežģītības līmenis. -->
                    <td>{{ $recipe->difficulty ?? '-' }}</td>

                    <!--
                        Receptes vidējais vērtējums.

                        Ja vērtējums nav pieejams,
                        tiek attēlota svītra.
                    -->
                    <td>{{ $avg ? number_format($avg, 1) : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>