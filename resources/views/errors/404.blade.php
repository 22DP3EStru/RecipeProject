{{--
    404 kļūdas lapas skats.

    Šis Blade fails nodrošina 404 kļūdas lapu tīmekļa vietnē
    “Vecmāmiņas Receptes”. Skats tiek parādīts gadījumos,
    kad lietotājs mēģina piekļūt lapai, kura neeksistē,
    ir dzēsta vai pārvietota.

    Failā ir iekļauts kļūdas kods, īss paskaidrojums par
    neesošu lapu, kā arī navigācijas pogas, kas ļauj
    lietotājam atgriezties sākumlapā vai pāriet uz
    recepšu sarakstu.

    Skatā izmantotas Tailwind CSS klases, lai noteiktu
    lapas izkārtojumu, teksta stilus, atstarpes, pogu
    noformējumu un responsīvo izkārtojumu dažādiem ekrāniem.
--}}

@extends('layouts.app')

{{-- Norāda lapas nosaukumu pārlūkprogrammas cilnē --}}
@section('title', '404 - Lapa nav atrasta')

@section('content')

{{-- Galvenais 404 kļūdas lapas konteiners --}}
<div class="max-w-3xl mx-auto px-4 py-16 text-center">

    {{-- Kļūdas kods, kas norāda, ka lapa nav atrasta --}}
    <h1 class="text-5xl font-bold text-gray-800 mb-4">404</h1>

    {{-- Galvenais kļūdas lapas virsraksts --}}
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Lapa nav atrasta</h2>

    {{-- Paskaidrojuma teksts lietotājam --}}
    <p class="text-gray-600 mb-8">
        Izskatās, ka šī lapa neeksistē vai ir pārvietota.
    </p>

    {{-- Pogu bloks ar navigācijas iespējām --}}
    <div class="flex flex-col sm:flex-row justify-center gap-4">

        {{-- Poga lietotāja novirzīšanai uz sākumlapu --}}
        <a href="{{ url('/') }}" class="px-6 py-3 rounded-xl bg-orange-500 text-white font-semibold hover:bg-orange-600 transition">
            Uz sākumlapu
        </a>

        {{-- Poga pārejai uz recepšu saraksta lapu --}}
        <a href="{{ route('recipes.index') }}" class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">
            Skatīt receptes
        </a>
    </div>
</div>

@endsection