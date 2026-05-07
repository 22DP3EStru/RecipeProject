<!--
    Lietotāja profila PDF skats.

    Šis Blade fails tiek izmantots PDF dokumenta ģenerēšanai,
    kurā tiek attēlota informācija par konkrētu lietotāju
    un viņa pievienotajām receptēm.

    Dokumentā tiek attēlots:
    - lietotāja vārds;
    - lietotāja e-pasts;
    - lietotāja pievienoto recepšu saraksts;
    - recepšu izveides datumi;
    - recepšu kategorijas;
    - recepšu vidējie vērtējumi.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <!-- Dokumenta kodējums latviešu simbolu pareizai attēlošanai. -->
    <meta charset="UTF-8">

    <!-- PDF dokumenta virsraksts. -->
    <title>Lietotāja profils</title>

    <!-- Kopējie PDF stili tiek ielādēti no atsevišķa Blade faila. -->
    @include('pdf.styles')
</head>

<body>
    <!--
        Dokumenta galvene.

        Tajā tiek attēlota galvenā informācija par lietotāju.
    -->
    <div class="header">
        <!-- Lietotāja vārds. -->
        <h1>{{ $user->name }}</h1>

        <!-- Lietotāja e-pasta adrese. -->
        <p><strong>E-pasts:</strong> {{ $user->email }}</p>
    </div>

    <!-- Lietotāja recepšu sadaļas virsraksts. -->
    <h2>Lietotāja pievienotās receptes</h2>

    <!--
        Recepšu tabula.

        Tajā tiek attēlotas visas receptes,
        kuras konkrētais lietotājs ir pievienojis sistēmā.
    -->
    <table>
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Izveides datums</th>
                <th>Kategorija</th>
                <th>Vidējais vērtējums</th>
            </tr>
        </thead>

        <tbody>
            @foreach($recipes as $recipe)
                @php
                    /*
                        Aprēķina receptes vidējo vērtējumu.

                        reviews relācija satur visus receptes vērtējumus.
                        avg('rating') aprēķina vidējo vērtību.
                    */
                    $avg = $recipe->reviews->avg('rating');
                @endphp

                <tr>
                    <!-- Receptes nosaukums. -->
                    <td>{{ $recipe->title }}</td>

                    <!--
                        Receptes izveides datums.

                        optional() tiek izmantots,
                        lai izvairītos no kļūdām,
                        ja created_at vērtība nav pieejama.
                    -->
                    <td>{{ optional($recipe->created_at)->format('d.m.Y') }}</td>

                    <!-- Receptes kategorija. -->
                    <td>{{ $recipe->category ?? '-' }}</td>

                    <!--
                        Receptes vidējais vērtējums.

                        Ja receptei nav vērtējumu,
                        tiek attēlota svītra.
                    -->
                    <td>{{ $avg ? number_format($avg, 1) : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>