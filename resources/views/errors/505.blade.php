@extends('layouts.app')

@section('title', '500 - Servera kļūda')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-16 text-center">
    <h1 class="text-5xl font-bold text-gray-800 mb-4">500</h1>
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Radās servera kļūda</h2>
    <p class="text-gray-600 mb-8">
        Diemžēl kaut kas nogāja greizi. Mēģini vēlreiz pēc brīža.
    </p>

    <a href="{{ url('/') }}" class="px-6 py-3 rounded-xl bg-orange-500 text-white font-semibold hover:bg-orange-600 transition">
        Uz sākumlapu
    </a>
</div>
</div>
@endsection