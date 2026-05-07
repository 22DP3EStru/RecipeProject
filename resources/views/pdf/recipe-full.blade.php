<!--
    Pilnas receptes PDF skats.

    Šis Blade fails tiek izmantots, lai ģenerētu PDF dokumentu
    ar vienas konkrētas receptes pilnu informāciju.

    Dokumentā tiek attēlots:
    - receptes nosaukums;
    - kategorija;
    - porciju skaits;
    - kopējais pagatavošanas laiks;
    - sarežģītības līmenis;
    - receptes attēls;
    - sastāvdaļu saraksts;
    - pagatavošanas soļi.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <!-- Dokumenta kodējums latviešu valodas simbolu pareizai attēlošanai. -->
    <meta charset="UTF-8">

    <!-- PDF dokumenta virsrakstā tiek izmantots receptes nosaukums. -->
    <title>{{ $recipe->title }}</title>

    <!-- Kopējie PDF stili tiek ielādēti no atsevišķa Blade faila. -->
    @include('pdf.styles')
</head>

<body>
    @php
        /*
            Mainīgais receptes attēla ceļa glabāšanai.

            Sākotnēji vērtība ir null, jo attēls var nebūt pievienots.
        */
        $imagePath = null;

        /*
            Vispirms tiek pārbaudīts, vai receptei ir lokāli saglabāts attēls.

            Ja image_path nav tukšs un fails eksistē public/storage mapē,
            PDF dokumentā tiek izmantots lokālais attēla ceļš.
        */
        if (!empty($recipe->image_path) && file_exists(public_path('storage/' . $recipe->image_path))) {
            $imagePath = public_path('storage/' . $recipe->image_path);

        /*
            Ja lokālais attēls nav pieejams, bet receptei ir image_url,
            tiek izmantota ārējā attēla adrese.
        */
        } elseif (!empty($recipe->image_url)) {
            $imagePath = $recipe->image_url;
        }
    @endphp

    <!--
        PDF dokumenta galvene.

        Šajā sadaļā tiek attēlota galvenā receptes informācija.
    -->
    <div class="header">
        <!-- Receptes nosaukums. -->
        <h1>{{ $recipe->title }}</h1>

        <!-- Receptes metadati: kategorija, porcijas, laiks un sarežģītība. -->
        <div class="meta">
            <!-- Receptes kategorija. Ja kategorija nav pieejama, tiek attēlota svītra. -->
            <p><strong>Kategorija:</strong> {{ $recipe->category ?? '-' }}</p>

            <!--
                Porciju skaits.

                Ja lietotājs PDF ģenerēšanas laikā ir izvēlējies citu porciju skaitu,
                tiek izmantots $targetServings; pretējā gadījumā tiek izmantots receptes sākotnējais porciju skaits.
            -->
            <p><strong>Porciju skaits:</strong> {{ $targetServings ?? ($recipe->servings ?? '-') }}</p>

            <!--
                Kopējais pagatavošanas laiks.

                Tas tiek aprēķināts, saskaitot sagatavošanas laiku un gatavošanas laiku.
                Ja kāda vērtība nav norādīta, tiek izmantota 0.
            -->
            <p><strong>Pagatavošanas laiks:</strong> {{ (int)($recipe->prep_time ?? 0) + (int)($recipe->cook_time ?? 0) }} min</p>

            <!-- Receptes sarežģītības līmenis. -->
            <p><strong>Sarežģītība:</strong> {{ $recipe->difficulty ?? '-' }}</p>
        </div>

        <!--
            Receptes attēls.

            Attēls tiek parādīts tikai tad, ja iepriekš tika atrasts lokāls attēls
            vai ārējā attēla adrese.
        -->
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

    <!-- Sastāvdaļu sadaļas virsraksts. -->
    <h2>Sastāvdaļas</h2>

    <!--
        Sastāvdaļu attēlošana.

        Ja ir pieejams $scaledIngredients masīvs, sastāvdaļas tiek attēlotas tabulā.
        Tas ir nepieciešams gadījumos, kad daudzumi tiek pārrēķināti pēc porciju skaita.
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

                        <!-- Sastāvdaļas pārrēķinātais vai sākotnējais daudzums. -->
                        <td>{{ $ingredient['amount'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <!--
            Ja strukturēts sastāvdaļu saraksts nav pieejams,
            tiek attēlots parastais receptes ingredients teksts.
        -->
        <p>{{ $recipe->ingredients ?? 'Sastāvdaļas nav pievienotas.' }}</p>
    @endif

    <!-- Pagatavošanas soļu sadaļas virsraksts. -->
    <h2 style="margin-top: 24px;">Pagatavošanas soļi</h2>

    <!--
        Pagatavošanas soļu attēlošana.

        Ja $steps masīvā ir sadalīti pagatavošanas soļi,
        katrs solis tiek attēlots atsevišķā blokā ar kārtas numuru.
    -->
    @if(count($steps))
        @foreach($steps as $index => $step)
            <div class="step-block">
                <!-- Soļa kārtas numurs. -->
                <p><strong>{{ $index + 1 }}. solis</strong></p>

                <!-- Soļa apraksts. -->
                <p>{{ $step }}</p>
            </div>
        @endforeach
    @else
        <!--
            Ja soļi nav sadalīti masīvā,
            tiek attēlots pilnais instructions teksts.
        -->
        <p>{{ $recipe->instructions ?? 'Pagatavošanas soļi nav pievienoti.' }}</p>
    @endif
</body>
</html>