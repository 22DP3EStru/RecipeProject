@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Kategorijas</h1>

<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
@foreach ($categories as $c)
    <a href="{{ route('recipes.index', ['category' => $c->slug]) }}"
       class="bg-white rounded-xl shadow p-6 flex items-center justify-between hover:shadow-lg transition">
        <span>{{ $c->name }}</span>
        <span class="text-sm text-gray-500">{{ $c->recipes_count }}</span>
    </a>
@endforeach
</div>
@endsection
