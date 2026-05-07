<!--
    Kopējie PDF dokumentu stili.

    Šis Blade fails satur vienotus CSS stilus visiem PDF dokumentiem,
    kas tiek ģenerēti sistēmā.

    Stili tiek atkārtoti izmantoti:
    - pilnas receptes PDF;
    - sastāvdaļu PDF;
    - pagatavošanas soļu PDF;
    - statistikas PDF;
    - kategoriju PDF;
    - filtrēto recepšu PDF;
    - populārāko recepšu PDF.

    Šāda pieeja samazina koda dublēšanos
    un nodrošina vienotu PDF dokumentu dizainu.
-->

<style>
    /*
        Galvenie PDF dokumenta stili.

        DejaVu Sans fonts tiek izmantots,
        jo tas korekti attēlo latviešu valodas simbolus PDF dokumentos.
    */
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 12px;
        color: #1f1f1f;
        line-height: 1.68;
        background: #f7f7f7;
        margin: 28px;
    }

    /*
        Virsrakstu kopējie stili.

        h1, h2 un h3 tiek izmantoti dažādām sadaļām PDF dokumentos.
    */
    h1, h2, h3 {
        margin: 0 0 10px 0;
        font-weight: bold;
        color: #111111;
    }

    /*
        Galvenā dokumenta virsraksta stils.

        To izmanto PDF dokumenta nosaukumam.
    */
    h1 {
        font-size: 26px;
        padding-bottom: 10px;
        margin-bottom: 18px;
        border-bottom: 2px solid #d6d6d6;
        letter-spacing: 0.3px;
    }

    /*
        Otrā līmeņa virsraksti sadaļām.

        Piemēram:
        - sastāvdaļu sadaļai;
        - pagatavošanas soļiem;
        - statistikas blokiem.
    */
    h2 {
        font-size: 18px;
        margin-top: 22px;
        padding-bottom: 6px;
        border-bottom: 1px solid #e0e0e0;
    }

    /*
        Trešā līmeņa virsraksti.

        Parasti tiek izmantoti mazākām sadaļām vai apakšvirsrakstiem.
    */
    h3 {
        font-size: 14px;
        margin-top: 16px;
        color: #2f2f2f;
    }

    /*
        Dokumenta galvenes bloks.

        Tajā tiek ievietota galvenā PDF informācija.
    */
    .header {
        background: #f0f0f0;
        border: 1px solid #dddddd;
        padding: 18px 20px;
        margin-bottom: 22px;
        border-radius: 14px;
    }

    /*
        Metadatu bloks.

        Tajā tiek attēlota papildinformācija:
        - kategorija;
        - porciju skaits;
        - laiks;
        - statistika.
    */
    .meta {
        background: #fcfcfc;
        border: 1px solid #e3e3e3;
        padding: 14px 16px;
        margin-bottom: 18px;
        border-radius: 12px;
    }

    /* Atstarpes starp meta informācijas rindām. */
    .meta p {
        margin: 5px 0;
    }

    /*
        Izcelta teksta klase.

        To izmanto svarīgiem nosaukumiem vai etiķetēm.
    */
    .label {
        font-weight: bold;
        color: #111111;
    }

    /*
        Universāls informācijas bloks.

        To iespējams izmantot dažādām PDF sadaļām.
    */
    .section-box {
        background: #ffffff;
        border: 1px solid #e3e3e3;
        padding: 16px 18px;
        margin-bottom: 18px;
        border-radius: 14px;
    }

    /*
        Receptes vai profila attēla stils.

        max-width un max-height ierobežo attēla izmēru PDF dokumentā.
    */
    .cover-image,
    .profile-image {
        max-width: 220px;
        max-height: 180px;
        border: 1px solid #d7d7d7;
        padding: 5px;
        background: #ffffff;
        margin-top: 12px;
        border-radius: 10px;
    }

    /*
        Attēla konteiners centrētai attēlošanai.
    */
    .image-wrap {
        text-align: center;
        margin-top: 10px;
        margin-bottom: 16px;
    }

    /*
        Tabulu kopējie stili.

        Šie stili tiek izmantoti:
        - statistikas tabulām;
        - recepšu tabulām;
        - sastāvdaļu tabulām;
        - pagatavošanas soļu tabulām.
    */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 12px;
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
    }

    /*
        Tabulas šūnu stili.
    */
    th, td {
        border: 1px solid #e1e1e1;
        padding: 10px 11px;
        vertical-align: top;
        text-align: left;
    }

    /*
        Tabulas galvenes stils.
    */
    th {
        background: #f2f2f2;
        color: #111111;
        font-weight: bold;
    }

    /*
        Katras otrās rindas fona tonējums,
        lai uzlabotu tabulas lasāmību.
    */
    tr:nth-child(even) td {
        background: #fafafa;
    }

    /*
        Teksta centrēšanas klase.
    */
    .center {
        text-align: center;
    }

    /*
        Mazāka izmēra teksts papildinformācijai.
    */
    .small {
        font-size: 10.5px;
        color: #666666;
    }

    /*
        Pagatavošanas soļa bloks.

        Katrs solis tiek vizuāli atdalīts atsevišķā kartītē.
    */
    .step-block {
        margin-bottom: 14px;
        page-break-inside: avoid;
        background: #ffffff;
        border: 1px solid #e2e2e2;
        border-left: 4px solid #9c9c9c;
        padding: 12px 14px;
        border-radius: 12px;
    }

    /*
        Pagatavošanas soļa virsraksts.
    */
    .step-title {
        font-weight: bold;
        color: #111111;
        margin-bottom: 6px;
    }

    /*
        Mazas informatīvas etiķetes jeb badges.

        Tās iespējams izmantot:
        - kategorijām;
        - sarežģītības līmenim;
        - papildinformācijai.
    */
    .badge {
        display: inline-block;
        padding: 4px 9px;
        font-size: 10px;
        font-weight: bold;
        color: #111111;
        background: #f1f1f1;
        border: 1px solid #d9d9d9;
        margin-right: 6px;
        margin-bottom: 6px;
        border-radius: 999px;
    }

    /*
        PDF dokumenta apakšējās piezīmes stils.
    */
    .footer-note {
        margin-top: 24px;
        padding-top: 10px;
        border-top: 1px solid #dddddd;
        font-size: 10.5px;
        color: #666666;
        text-align: center;
    }

    /*
        Sarakstu kopējie stili.
    */
    ul, ol {
        margin-top: 8px;
        margin-bottom: 8px;
        padding-left: 18px;
    }

    /* Atstarpes starp saraksta elementiem. */
    li {
        margin-bottom: 4px;
    }

    /*
        Izceltais informācijas bloks.

        To iespējams izmantot svarīgu paziņojumu vai statistikas attēlošanai.
    */
    .highlight-box {
        background: #f4f4f4;
        border: 1px solid #dfdfdf;
        padding: 12px 14px;
        margin: 14px 0;
        border-radius: 12px;
    }

    /*
        Horizontālā atdalīšanas līnija starp sadaļām.
    */
    .divider {
        height: 1px;
        background: #e2e2e2;
        margin: 18px 0;
    }
</style>