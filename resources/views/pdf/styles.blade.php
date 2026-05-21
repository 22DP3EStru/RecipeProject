<!--
    Kopējie PDF dokumentu stili.

    Šis Blade fails satur vienotus CSS stilus visiem PDF dokumentiem,
    kas tiek ģenerēti sistēmā.

    Stili tiek izmantoti:
    - pilnas receptes PDF;
    - sastāvdaļu PDF;
    - pagatavošanas soļu PDF;
    - statistikas PDF;
    - kategoriju PDF;
    - populārāko recepšu PDF;
    - profila PDF.
-->

<style>

    /*
        Universālie stili visiem HTML elementiem.

        DejaVu Sans tiek izmantots globāli,
        lai novērstu UTF-8 simbolu problēmas PDF dokumentos.

        box-sizing nodrošina korektus izmēru aprēķinus.
    */
    * {
        font-family: DejaVu Sans, sans-serif;
        box-sizing: border-box;
    }

    /*
        Galvenie dokumenta stili.

        Tiek definēts:
        - teksta izmērs;
        - krāsa;
        - rindstarpa;
        - dokumenta malas.
    */
    body {
        font-size: 12px;
        color: #1f1f1f;
        line-height: 1.6;
        background: #ffffff;
        margin: 28px;
    }

    /*
        Virsrakstu kopējie stili.

        Tos izmanto dažādām PDF sadaļām.
    */
    h1,
    h2,
    h3 {
        margin: 0 0 10px 0;
        font-weight: bold;
        color: #111111;
    }

    /*
        Galvenā dokumenta virsraksts.

        Parasti tiek izmantots:
        - PDF nosaukumam;
        - receptes nosaukumam;
        - statistikas nosaukumam.
    */
    h1 {
        font-size: 26px;
        padding-bottom: 10px;
        margin-bottom: 18px;
        border-bottom: 2px solid #d6d6d6;
    }

    /*
        Otrā līmeņa virsraksti.

        Tos izmanto sadaļām:
        - sastāvdaļas;
        - statistika;
        - pagatavošanas soļi;
        - populārākās receptes.
    */
    h2 {
        font-size: 18px;
        margin-top: 22px;
        padding-bottom: 6px;
        border-bottom: 1px solid #e0e0e0;
    }

    /*
        Trešā līmeņa virsraksti.

        Tos izmanto mazākām sadaļām vai apakšvirsrakstiem.
    */
    h3 {
        font-size: 14px;
        margin-top: 16px;
        color: #2f2f2f;
    }

    /*
        Parasta teksta rindkopas.

        margin nodrošina atstarpi starp rindkopām.
    */
    p {
        margin: 6px 0;
    }

    /*
        Dokumenta galvenes bloks.

        Tajā parasti tiek ievietots:
        - dokumenta nosaukums;
        - ģenerēšanas datums;
        - papildinformācija.
    */
    .header {
        background: #f0f0f0;
        border: 1px solid #dddddd;
        padding: 18px 20px;
        margin-bottom: 22px;
        border-radius: 10px;
    }

    /*
        Metadatu bloks.

        To izmanto:
        - kategorijām;
        - porciju skaitam;
        - pagatavošanas laikam;
        - statistikas datiem.
    */
    .meta {
        background: #fcfcfc;
        border: 1px solid #e3e3e3;
        padding: 14px 16px;
        margin-bottom: 18px;
        border-radius: 10px;
    }

    /*
        Meta bloka rindkopu atstarpes.
    */
    .meta p {
        margin: 5px 0;
    }

    /*
        Izcelts teksts.

        To izmanto:
        - etiķetēm;
        - nosaukumiem;
        - svarīgai informācijai.
    */
    .label {
        font-weight: bold;
        color: #111111;
    }

    /*
        Universāls satura bloks.

        To iespējams izmantot dažādām PDF sadaļām.
    */
    .section-box {
        background: #ffffff;
        border: 1px solid #e3e3e3;
        padding: 16px 18px;
        margin-bottom: 18px;
        border-radius: 10px;
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
        border-radius: 8px;
    }

    /*
        Attēla konteiners.

        text-align: center centrē attēlu PDF dokumentā.
    */
    .image-wrap {
        text-align: center;
        margin-top: 10px;
        margin-bottom: 16px;
    }

    /*
        Tabulu kopējie stili.

        Tiek izmantoti:
        - statistikas tabulām;
        - recepšu tabulām;
        - sastāvdaļu tabulām.
    */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 12px;
        background: #ffffff;
    }

    /*
        Tabulu šūnu stili.
    */
    th,
    td {
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
        Katras otrās rindas iekrāsošana.

        Tas uzlabo tabulas lasāmību.
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
        Pagatavošanas soļa kartīte.

        Katrs solis tiek attēlots atsevišķi.
    */
    .step-block {
        margin-bottom: 14px;
        page-break-inside: avoid;
        background: #ffffff;
        border: 1px solid #e2e2e2;
        border-left: 4px solid #9c9c9c;
        padding: 12px 14px;
        border-radius: 10px;
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
        Mazas informatīvas etiķetes.

        Tās iespējams izmantot:
        - kategorijām;
        - sarežģītības līmenim;
        - statusiem.
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
        PDF dokumenta apakšējā piezīme.

        To izmanto:
        - autortiesībām;
        - ģenerēšanas informācijai;
        - sistēmas nosaukumam.
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
    ul,
    ol {
        margin-top: 8px;
        margin-bottom: 8px;
        padding-left: 18px;
    }

    /*
        Atstarpes starp sarakstu elementiem.
    */
    li {
        margin-bottom: 4px;
    }

    /*
        Izceltais informācijas bloks.

        To iespējams izmantot:
        - svarīgiem paziņojumiem;
        - statistikai;
        - rekomendācijām.
    */
    .highlight-box {
        background: #f4f4f4;
        border: 1px solid #dfdfdf;
        padding: 12px 14px;
        margin: 14px 0;
        border-radius: 10px;
    }

    /*
        Horizontālā sadalījuma līnija starp sadaļām.
    */
    .divider {
        height: 1px;
        background: #e2e2e2;
        margin: 18px 0;
    }

</style>