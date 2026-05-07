{{--
    500 kļūdas lapas skats.

    Šis Blade fails nodrošina 500 kļūdas lapu tīmekļa vietnē
    “Vecmāmiņas Receptes”. Skats tiek parādīts gadījumos,
    kad sistēmā rodas servera puses kļūda un pieprasījumu
    nav iespējams korekti apstrādāt.

    Failā ir iekļauts kļūdas kods, īss paskaidrojums par servera kļūdu,
    lietotājam saprotams paziņojums un poga, kas ļauj atgriezties sākumlapā.

    Skatā izmantotas Tailwind CSS klases, lai noteiktu lapas izkārtojumu,
    teksta izmērus, krāsas, atstarpes, pogas noformējumu un hover efektu.
--}}

@extends('layouts.app')

{{-- Norāda lapas nosaukumu pārlūkprogrammas cilnē --}}
@section('title', '500 - Servera kļūda')

@section('content')

{{-- Galvenais 500 kļūdas lapas konteiners --}}
<div class="max-w-3xl mx-auto px-4 py-16 text-center">

    {{-- Kļūdas kods, kas norāda uz servera puses kļūdu --}}
    <h1 class="text-5xl font-bold text-gray-800 mb-4">500</h1>

    {{-- Galvenais kļūdas lapas virsraksts --}}
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Radās servera kļūda</h2>

    {{-- Lietotājam saprotams paskaidrojums par kļūdu --}}
    <p class="text-gray-600 mb-8">
        Diemžēl kaut kas nogāja greizi. Mēģini vēlreiz pēc brīža.
    </p>

    {{-- Poga novirza lietotāju atpakaļ uz sākumlapu --}}
    <a href="{{ url('/') }}" class="px-6 py-3 rounded-xl bg-orange-500 text-white font-semibold hover:bg-orange-600 transition">
        Uz sākumlapu
    </a>
</div>

@endsection