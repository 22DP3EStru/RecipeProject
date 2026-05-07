<!--
    Populārāko recepšu PDF skats.

    Šis Blade fails tiek izmantots PDF dokumenta ģenerēšanai,
    kurā tiek attēlotas populārākās receptes noteiktā laika periodā.

    Dokumentā tiek attēlots:
    - izvēlētais laika periods;
    - kopējais skatījumu skaits;
    - populārāko recepšu skaits;
    - recepšu nosaukumi;
    - skatījumu skaits;
    - vidējais vērtējums;
    - receptes autors.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <!-- Dokumenta kodējums latviešu simbolu pareizai attēlošanai. -->
    <meta charset="UTF-8">

    <!-- PDF dokumenta virsraksts. -->
    <title>Populārākās receptes</title>

    <!-- Kopējie PDF stili tiek ielādēti no atsevišķa Blade faila. -->
    @include('pdf.styles')
</head>

<body>
    <!--
        Dokumenta galvene.

        Tajā tiek attēlota pamatinformācija par populāro recepšu statistiku.
    -->
    <div class="header">
        <h1>Populārākās receptes</h1>

        <!--
            Laika periods, pēc kura tiek atlasītas populārākās receptes.

            Mainīgais $days nosaka dienu skaitu.
        -->
        <p><strong>Laika periods:</strong> Pēdējās {{ $days }} dienās</p>

        <!--
            Kopējais skatījumu skaits visām atlasītajām receptēm.

            number_format tiek izmantots,
            lai pievienotu tūkstošu atdalītājus.
        -->
        <p>
            <strong>Kopējais skatījumu skaits:</strong>
            {{ number_format($totalViews ?? 0, 0, ',', ' ') }}
        </p>

        <!-- Atlasīto populāro recepšu skaits. -->
        <p><strong>Populārāko recepšu skaits:</strong> {{ $recipes->count() }}</p>
    </div>

    <!--
        Populārāko recepšu tabula.

        Tabulā tiek attēlotas receptes ar lielāko skatījumu skaitu.
    -->
    <table>
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Skatījumi</th>
                <th>Vidējais vērtējums</th>
                <th>Autors</th>
            </tr>
        </thead>

        <tbody>
            @forelse($recipes as $recipe)
                @php
                    /*
                        Aprēķina receptes vidējo vērtējumu.

                        Vērtējumi tiek iegūti no reviews relācijas.
                        Ja vērtējumi nav pieejami,
                        vēlāk tabulā tiks attēlota svītra.
                    */
                    $avg = $recipe->reviews->avg('rating');
                @endphp

                <tr>
                    <!-- Receptes nosaukums. -->
                    <td>{{ $recipe->title }}</td>

                    <!--
                        Receptes skatījumu skaits.

                        Skaitlis tiek formatēts ar tūkstošu atdalītājiem.
                    -->
                    <td>{{ number_format((int)($recipe->views ?? 0), 0, ',', ' ') }}</td>

                    <!--
                        Receptes vidējais vērtējums.

                        number_format noapaļo vērtējumu līdz vienai zīmei aiz komata.
                    -->
                    <td>{{ $avg ? number_format($avg, 1) : '-' }}</td>

                    <!-- Receptes autora vārds. -->
                    <td>{{ $recipe->user->name ?? '-' }}</td>
                </tr>
            @empty
                <!--
                    Šī rinda tiek attēlota,
                    ja populāro recepšu saraksts ir tukšs.
                -->
                <tr>
                    <td colspan="4">Nav pieejamu datu.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>