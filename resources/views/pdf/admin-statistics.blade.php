<!--
    Sistēmas statistikas PDF skats.

    Šis Blade fails tiek izmantots, lai ģenerētu PDF dokumentu
    ar administrācijas sadaļas statistikas datiem.

    Dokumentā tiek attēlots:
    - PDF ģenerēšanas datums un laiks;
    - kopējais lietotāju skaits;
    - kopējais recepšu skaits;
    - komentāru skaits;
    - vidējais vērtējums;
    - kopējais skatījumu skaits;
    - vidējais skatījumu skaits uz recepti;
    - populārākā recepte;
    - populārāko recepšu tabula.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <!-- Dokumenta kodējums latviešu valodas simbolu pareizai attēlošanai. -->
    <meta charset="UTF-8">

    <!-- PDF dokumenta virsraksts. -->
    <title>Sistēmas statistika</title>

    <!-- Kopējie PDF stili tiek ielādēti no atsevišķa Blade faila. -->
    @include('pdf.styles')
</head>

<body>
    <!--
        Dokumenta galvene.

        Tajā tiek norādīts PDF nosaukums un datuma zīmogs,
        kas parāda, kad statistikas dokuments tika ģenerēts.
    -->
    <div class="header">
        <h1>Sistēmas statistika</h1>
        <p><strong>Datuma zīmogs:</strong> {{ $generatedAt->format('d.m.Y H:i') }}</p>
    </div>

    <!--
        Kopsavilkuma tabula.

        Šajā tabulā tiek attēloti galvenie sistēmas statistikas rādītāji.
    -->
    <table>
        <tbody>
            <tr>
                <!-- Kopējais reģistrēto lietotāju skaits sistēmā. -->
                <th>Lietotāju skaits</th>
                <td>{{ $usersCount }}</td>
            </tr>

            <tr>
                <!-- Kopējais sistēmā pievienoto recepšu skaits. -->
                <th>Recepšu kopskaits</th>
                <td>{{ $recipesCount }}</td>
            </tr>

            <tr>
                <!-- Kopējais lietotāju pievienoto komentāru skaits. -->
                <th>Komentāru skaits</th>
                <td>{{ $commentsCount }}</td>
            </tr>

            <tr>
                <!--
                    Vidējais recepšu vērtējums.

                    Ja vērtējums nav pieejams, tiek izmantota vērtība 0.
                    number_format noapaļo rezultātu līdz vienai zīmei aiz komata.
                -->
                <th>Vidējais vērtējums</th>
                <td>{{ number_format($averageRating ?? 0, 1) }}</td>
            </tr>

            <tr>
                <!--
                    Kopējais skatījumu skaits visām receptēm.

                    Skaitlis tiek formatēts ar atstarpi kā tūkstošu atdalītāju.
                -->
                <th>Kopējais skatījumu skaits</th>
                <td>{{ number_format($totalViews ?? 0, 0, ',', ' ') }}</td>
            </tr>

            <tr>
                <!--
                    Vidējais skatījumu skaits uz vienu recepti.

                    Rezultāts tiek attēlots ar divām zīmēm aiz komata.
                -->
                <th>Vidējais skatījumu skaits uz recepti</th>
                <td>{{ number_format($averageViewsPerRecipe ?? 0, 2, ',', ' ') }}</td>
            </tr>

            <tr>
                <!--
                    Populārākā recepte pēc skatījumu skaita.

                    Ja populārākā recepte nav pieejama, tiek attēlota svītra.
                -->
                <th>Populārākā recepte</th>
                <td>
                    @if(!empty($mostViewedRecipe))
                        {{ $mostViewedRecipe->title }} ({{ number_format((int)($mostViewedRecipe->views ?? 0), 0, ',', ' ') }} skatījumi)
                    @else
                        -
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Otrās tabulas virsraksts ar populārāko recepšu sarakstu. -->
    <h2 style="margin-top: 24px;">Vispopulārākās receptes</h2>

    <!--
        Populārāko recepšu tabula.

        Šajā tabulā tiek attēlotas receptes ar lielāko skatījumu skaitu,
        to autori, skatījumu skaits un vidējais vērtējums.
    -->
    <table>
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Autors</th>
                <th>Skatījumi</th>
                <th>Vērtējums</th>
            </tr>
        </thead>

        <tbody>
            @forelse($popularRecipes as $recipe)
                @php
                    /*
                        Aprēķina konkrētās receptes vidējo vērtējumu.

                        Vērtējumi tiek ņemti no reviews relācijas.
                        Ja receptei nav vērtējumu, vēlāk tabulā tiek attēlota svītra.
                    */
                    $avg = $recipe->reviews->avg('rating');
                @endphp

                <tr>
                    <!-- Receptes nosaukums. -->
                    <td>{{ $recipe->title }}</td>

                    <!-- Receptes autora vārds. Ja autors nav pieejams, tiek attēlota svītra. -->
                    <td>{{ $recipe->user->name ?? '-' }}</td>

                    <!-- Receptes skatījumu skaits ar tūkstošu atdalītāju. -->
                    <td>{{ number_format((int)($recipe->views ?? 0), 0, ',', ' ') }}</td>

                    <!-- Vidējais receptes vērtējums ar vienu zīmi aiz komata. -->
                    <td>{{ $avg ? number_format($avg, 1) : '-' }}</td>
                </tr>
            @empty
                <!--
                    Šī rinda tiek attēlota, ja populāro recepšu saraksts ir tukšs.
                -->
                <tr>
                    <td colspan="4">Nav pieejamu datu.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>