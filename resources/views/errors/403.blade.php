@extends('layouts.app')

@section('title', '403 - Piekļuve liegta')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-16 text-center">
    <h1 class="text-5xl font-bold text-gray-800 mb-4">403</h1>
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Piekļuve liegta</h2>
    <p class="text-gray-600 mb-8">
        Tev nav tiesību piekļūt šai sadaļai.
    </p>

    <a href="{{ url()->previous() }}" class="px-6 py-3 rounded-xl bg-orange-500 text-white font-semibold hover:bg-orange-600 transition">
        Atgriezties atpakaļ
    </a>
</div>
@endsection