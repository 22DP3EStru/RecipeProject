<!doctype html>
<html lang="lv">
<head>
    <meta charset="utf-8">
    <title>{{ $recipe->title }}</title>
    <style>
        @page { margin: 22px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color:#111; }

        .header { border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 14px; }
        .title { font-size: 22px; font-weight: 800; margin: 0 0 6px 0; }
        .sub { color:#666; font-size: 11px; }

        .badges { margin-top: 8px; }
        .badge {
            display:inline-block; border:1px solid #ddd; border-radius:999px;
            padding:3px 8px; margin-right:6px; font-size:10px; color:#444; background:#fafafa;
        }

        /* ✅ HERO bilde bez "cover" (necropē, nesaspiež) */
        .hero {
            margin: 12px 0 14px;
            border: 1px solid #eee;
            border-radius: 10px;
            overflow: hidden;
            padding: 10px;
            text-align: center;
        }
        .hero img{
            width: 100%;
            height: auto;
            max-height: 520px;     /* vari mainīt: 420 / 600 */
            object-fit: contain;   /* ✅ kā pdf_image */
            display: block;
            background: #fff;
        }
        .hero .noimg { padding: 16px; color:#777; font-size: 11px; }

        .section-title { font-size: 13px; font-weight: 800; margin: 10px 0 6px; }
        .desc { border-left: 3px solid #eee; padding-left: 10px; color:#333; white-space: pre-line; line-height: 1.35; }

        table.grid { width:100%; margin-top: 10px; border-collapse: collapse; }
        table.grid td { vertical-align: top; }

        .box { border: 1px solid #eee; border-radius: 10px; padding: 12px; }
        .list { margin: 0; padding-left: 0; list-style: none; }
        .list li { padding: 4px 0; border-bottom: 1px dotted #eee; }
        .list li:last-child { border-bottom: none; }

        .steps { white-space: pre-line; line-height: 1.45; }

        .footer {
            position: fixed; bottom: 14px; left: 22px; right: 22px;
            font-size: 10px; color: #888; border-top: 1px solid #eee; padding-top: 8px;
        }
    </style>
</head>
<body>

@php
    // ✅ Tavā gadījumā pareizais ceļš uz failu konteinerī ir storage/app/public/...
    $imgPath = (!empty($recipe->image_path))
        ? storage_path('app/public/' . ltrim($recipe->image_path, '/'))
        : null;

    $imgDataUri = null;

    if ($imgPath && file_exists($imgPath)) {
        $ext = strtolower(pathinfo($imgPath, PATHINFO_EXTENSION));
        $mime = match ($ext) {
            'jpg','jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            default => 'image/png',
        };
        $imgDataUri = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($imgPath));
    }
@endphp

<div class="header">
    <div class="title">{{ $recipe->title }}</div>
    <div class="sub">
        @if(!empty($recipe->category)) Kategorija: {{ $recipe->category }} @endif
        @if(!empty($recipe->difficulty)) · Grūtība: {{ $recipe->difficulty }} @endif
    </div>

    <div class="badges">
        @if(!is_null($recipe->prep_time)) <span class="badge">Sagatavošana: {{ $recipe->prep_time }} min</span> @endif
        @if(!is_null($recipe->cook_time)) <span class="badge">Gatavošana: {{ $recipe->cook_time }} min</span> @endif
        @if(!is_null($recipe->servings)) <span class="badge">Porcijas: {{ $recipe->servings }}</span> @endif
    </div>
</div>

<div class="hero">
    @if($imgDataUri)
        <img src="{{ $imgDataUri }}" alt="Recepšu bilde">
    @else
        <div class="noimg">Receptei nav pievienots attēls vai attēla fails nav atrasts.</div>
    @endif
</div>

@if(!empty($recipe->description))
    <div class="section-title">Apraksts</div>
    <div class="desc">{{ $recipe->description }}</div>
@endif

<table class="grid" cellspacing="0" cellpadding="0">
    <tr>
        <td style="width:49%; padding-right:10px;">
            <div class="section-title">Sastāvdaļas</div>
            <div class="box">
                @if($recipe->ingredientsItems && $recipe->ingredientsItems->count())
                    <ul class="list">
                        @foreach($recipe->ingredientsItems as $ing)
                            @php
                                $q = $ing->quantity;
                                $qText = $q !== null ? rtrim(rtrim(number_format((float)$q, 2, '.', ''), '0'), '.') : '';
                                $unit = trim((string)($ing->unit ?? ''));
                                $name = trim((string)($ing->name ?? ''));
                                $line = trim($qText . ' ' . $unit . ' ' . $name);
                            @endphp
                            @if($line !== '')
                                <li>{{ $line }}</li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <div class="steps">{{ (string)$recipe->ingredients }}</div>
                @endif
            </div>
        </td>

        <td style="width:2%;"></td>

        <td style="width:49%; padding-left:10px;">
            <div class="section-title">Pagatavošana</div>
            <div class="box">
                <div class="steps">{{ (string)$recipe->instructions }}</div>
            </div>
        </td>
    </tr>
</table>

<div class="footer">
    Vecmāmiņas Receptes · {{ $recipe->title }}
</div>

</body>
</html>