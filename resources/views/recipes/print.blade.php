<!doctype html>
<html lang="lv">
<head>
    <meta charset="utf-8">
    <title>{{ $recipe->title }} — drukai</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; margin: 24px; color:#111; }
        h1 { margin: 0 0 8px 0; }
        .meta { color:#555; margin-bottom: 14px; }
        img { width:100%; max-height: 420px; object-fit: cover; margin: 10px 0 16px 0; }
        h2 { margin: 18px 0 8px 0; }
        .text { white-space: pre-line; line-height: 1.4; }
        .actions { margin-bottom: 14px; }
        .btn { display:inline-block; padding: 8px 12px; border:1px solid #ddd; border-radius: 8px; text-decoration:none; color:#111; }
        .btn-primary { border-color:#4f46e5; color:#4f46e5; }
        @media print {
            .actions { display:none; }
            body { margin: 0; }
        }
    </style>
</head>
<body>

@php
    $imgLocal = $recipe->image_path ? asset('storage/' . ltrim($recipe->image_path, '/')) : null;
@endphp

<div class="actions">
    <a class="btn" href="{{ route('recipes.show', $recipe) }}">Atpakaļ uz recepti</a>
    <a class="btn btn-primary" href="#" onclick="window.print(); return false;">Drukāt (Ctrl+P)</a>
</div>

<h1>{{ $recipe->title }}</h1>

<div class="meta">
    @if(!empty($recipe->category))
        Kategorija: {{ $recipe->category }}
    @endif
    @if(!empty($recipe->difficulty))
        | Grūtība: {{ $recipe->difficulty }}
    @endif
    @if(!empty($recipe->prep_time))
        | Sagatavošana: {{ $recipe->prep_time }} min
    @endif
    @if(!empty($recipe->cook_time))
        | Gatavošana: {{ $recipe->cook_time }} min
    @endif
    @if(!empty($recipe->servings))
        | Porcijas: {{ $recipe->servings }}
    @endif
</div>

@if(!empty($recipe->image_path))
    <img src="{{ $imgLocal }}" alt="Recepšu bilde">
@elseif(!empty($recipe->image_url))
    <img src="{{ $recipe->image_url }}" alt="Recepšu bilde">
@endif

@if(!empty($recipe->description))
    <h2>Apraksts</h2>
    <div class="text">{{ $recipe->description }}</div>
@endif

<h2>Sastāvdaļas</h2>
@if($recipe->relationLoaded('ingredientsItems') && $recipe->ingredientsItems->count())
    <div class="text">
@foreach($recipe->ingredientsItems as $it)
{{ $it->quantity !== null ? rtrim(rtrim(number_format($it->quantity, 2, '.', ''), '0'), '.') : '' }}{{ $it->quantity !== null ? ' ' : '' }}{{ $it->unit ?? '' }}{{ ($it->quantity !== null || !empty($it->unit)) ? ' ' : '' }}{{ $it->name }}
@endforeach
    </div>
@else
    <div class="text">{{ $recipe->ingredients }}</div>
@endif

<h2>Pagatavošana</h2>
<div class="text">{{ $recipe->instructions }}</div>

</body>
</html>