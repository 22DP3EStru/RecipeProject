@extends('layouts.app')

@section('title', '404 - Lapa nav atrasta')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-16 text-center">
    <h1 class="text-5xl font-bold text-gray-800 mb-4">404</h1>
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Lapa nav atrasta</h2>
    <p class="text-gray-600 mb-8">
        Izskatās, ka šī lapa neeksistē vai ir pārvietota.
    </p>

    <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="{{ url('/') }}" class="px-6 py-3 rounded-xl bg-orange-500 text-white font-semibold hover:bg-orange-600 transition">
            Uz sākumlapu
        </a>
        <a href="{{ route('recipes.index') }}" class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">
            Skatīt receptes
        </a>
    </div>
</div>
@endsection