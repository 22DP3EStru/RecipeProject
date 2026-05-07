{{--
    403 kļūdas lapas skats.

    Šis Blade fails nodrošina 403 kļūdas lapu tīmekļa vietnē
    “Vecmāmiņas Receptes”. Skats tiek parādīts gadījumos, kad lietotājam
    nav nepieciešamo tiesību piekļūt konkrētai sadaļai vai veikt noteiktu
    darbību sistēmā.

    Failā ir iekļauts kļūdas kods, īss kļūdas skaidrojums, paskaidrojuma teksts
    lietotājam un poga, kas ļauj atgriezties iepriekšējā lapā.

    Skatā izmantotas Tailwind CSS klases, lai noteiktu lapas izkārtojumu,
    teksta izmērus, krāsas, atstarpes, pogas noformējumu un hover efektu.
--}}

@extends('layouts.app')

{{-- Norāda lapas nosaukumu pārlūkprogrammas cilnē --}}
@section('title', '403 - Piekļuve liegta')

@section('content')

{{-- Galvenais 403 kļūdas lapas konteiners --}}
<div class="max-w-3xl mx-auto px-4 py-16 text-center">

    {{-- Kļūdas kods, kas norāda uz piekļuves tiesību trūkumu --}}
    <h1 class="text-5xl font-bold text-gray-800 mb-4">403</h1>

    {{-- Kļūdas lapas virsraksts lietotājam saprotamā valodā --}}
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Piekļuve liegta</h2>

    {{-- Īss paskaidrojums par to, kāpēc šī lapa tiek parādīta --}}
    <p class="text-gray-600 mb-8">
        Tev nav tiesību piekļūt šai sadaļai.
    </p>

    {{-- Poga atgriež lietotāju iepriekšējā lapā --}}
    <a href="{{ url()->previous() }}" class="px-6 py-3 rounded-xl bg-orange-500 text-white font-semibold hover:bg-orange-600 transition">
        Atgriezties atpakaļ
    </a>
</div>

@endsection