<!doctype html>
<html lang="lv">
<head>
    <meta charset="utf-8">
    <title>{{ $recipe->title }} — bilde</title>
    <style>
        @page { margin: 18px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color:#111; }
        .title { font-size: 16px; font-weight: 800; margin-bottom: 10px; }
        .imgbox { border: 1px solid #eee; border-radius: 10px; padding: 10px; }
        img { width: 100%; height: auto; max-height: 780px; object-fit: contain; display:block; }
        .note { margin-top: 10px; font-size: 10px; color:#777; }
    </style>
</head>
<body>

@php
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

<div class="title">{{ $recipe->title }}</div>

<div class="imgbox">
    @if($imgDataUri)
        <img src="{{ $imgDataUri }}" alt="Recepšu bilde">
    @else
        <div style="color:#777;">Nav pievienota recepšu bilde vai attēla fails nav atrasts.</div>
    @endif
</div>

<div class="note">Vecmāmiņas Receptes</div>

</body>
</html>