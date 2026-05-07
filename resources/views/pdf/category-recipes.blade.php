<!--
    Kategorijas recepšu PDF skats.

    Šis Blade fails tiek izmantots, lai ģenerētu PDF dokumentu
    ar konkrētai kategorijai piesaistīto recepšu sarakstu.

    Dokumentā tiek attēlots:
    - kategorijas nosaukums;
    - kategorijas identifikators jeb slug;
    - recepšu kopskaits;
    - recepšu nosaukumi;
    - recepšu autori;
    - kopējais pagatavošanas laiks;
    - sarežģītības līmenis;
    - vidējais vērtējums.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <!-- Dokumenta kodējums latviešu valodas simbolu pareizai attēlošanai. -->
    <meta charset="UTF-8">

    <!-- PDF dokumenta virsraksts. -->
    <title>Kategorijas receptes</title>

    <!-- Kopējie PDF stili tiek ielādēti no atsevišķa Blade faila. -->
    @include('pdf.styles')
</head>

<body>
    <!--
        Dokumenta galvene.

        Tajā tiek attēlota pamatinformācija par izvēlēto kategoriju.
    -->
    <div class="header">
        <!-- Kategorijas nosaukums. -->
        <h1>{{ $category->name }}</h1>

        <!--
            Kategorijas slug vērtība.

            Ja slug nav pieejams, tiek attēlota svītra.
        -->
        <p><strong>Apraksts:</strong> {{ $category->slug ?? '-' }}</p>

        <!-- Kopējais šajā PDF iekļauto recepšu skaits. -->
        <p><strong>Recepšu kopskaits:</strong> {{ $recipes->count() }}</p>
    </div>

    <!--
        Recepšu tabula.

        Tabulā tiek attēlotas visas receptes,
        kas pieder konkrētajai kategorijai.
    -->
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
                    /*
                        Aprēķina receptes vidējo vērtējumu.

                        Vērtējumi tiek iegūti no reviews relācijas.
                        Ja vērtējumu nav, tabulā tiks attēlota svītra.
                    */
                    $avg = $recipe->reviews->avg('rating');

                    /*
                        Aprēķina kopējo receptes pagatavošanas laiku.

                        Kopējais laiks veidojas no:
                        - sagatavošanas laika;
                        - gatavošanas laika.

                        Ja kāda vērtība nav norādīta, tiek izmantota 0.
                    */
                    $totalTime = (int)($recipe->prep_time ?? 0) + (int)($recipe->cook_time ?? 0);
                @endphp

                <tr>
                    <!-- Receptes nosaukums. -->
                    <td>{{ $recipe->title }}</td>

                    <!-- Receptes autora vārds. Ja autors nav pieejams, tiek attēlota svītra. -->
                    <td>{{ $recipe->user->name ?? '-' }}</td>

                    <!-- Kopējais receptes pagatavošanas laiks minūtēs. -->
                    <td>{{ $totalTime }} min</td>

                    <!-- Receptes sarežģītības līmenis. -->
                    <td>{{ $recipe->difficulty ?? '-' }}</td>

                    <!-- Receptes vidējais vērtējums ar vienu zīmi aiz komata. -->
                    <td>{{ $avg ? number_format($avg, 1) : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>