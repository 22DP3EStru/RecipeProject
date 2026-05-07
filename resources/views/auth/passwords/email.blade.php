{{--
    Paroles atiestatīšanas pieprasījuma skats.

    Šis Blade fails tiek izmantots paroles atiestatīšanas procesā.
    Lietotājs šajā lapā ievada savu e-pasta adresi, lai saņemtu
    paroles atiestatīšanas saiti uz norādīto e-pastu.

    Skats satur:
    - statusa paziņojumu par veiksmīgu saites nosūtīšanu;
    - e-pasta ievades lauku;
    - validācijas kļūdu attēlošanu;
    - formas nosūtīšanas pogu.

    Forma izmanto Laravel autentifikācijas sistēmas maršrutu
    "password.email", kas apstrādā paroles atiestatīšanas pieprasījumu.
--}}

@extends('layouts.app')

{{-- Sāk galveno lapas satura sekciju --}}
@section('content')

{{-- Galvenais Bootstrap konteiners lapas saturam --}}
<div class="container">

    {{-- Rinda centrē paroles atiestatīšanas kartīti --}}
    <div class="row justify-content-center">

        {{-- Nosaka kartītes platumu Bootstrap režģī --}}
        <div class="col-md-8">

            {{-- Kartīte satur paroles atiestatīšanas formu --}}
            <div class="card">

                {{-- Kartītes virsraksts --}}
                <div class="card-header">
                    {{ __('Reset Password') }}
                </div>

                {{-- Kartītes galvenais saturs --}}
                <div class="card-body">

                    {{-- 
                        Pārbauda, vai sesijā eksistē statusa ziņojums.
                        Tas tiek izmantots, lai parādītu paziņojumu par veiksmīgi nosūtītu paroles atiestatīšanas saiti.
                    --}}
                    @if (session('status'))

                        {{-- Veiksmīga paziņojuma bloks --}}
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>

                    @endif

                    {{-- 
                        Forma nosūta lietotāja e-pasta adresi uz Laravel paroles atiestatīšanas maršrutu.
                    --}}
                    <form method="POST" action="{{ route('password.email') }}">

                        {{-- CSRF aizsardzība pret neatļautiem pieprasījumiem --}}
                        @csrf

                        {{-- E-pasta ievades lauks --}}
                        <div class="row mb-3">

                            {{-- E-pasta lauka nosaukums --}}
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                {{ __('Email Address') }}
                            </label>

                            <div class="col-md-6">

                                {{--
                                    E-pasta ievades lauks.

                                    old('email') saglabā iepriekš ievadīto vērtību,
                                    ja forma tika nosūtīta ar kļūdām.

                                    @error direktīva pievieno Bootstrap kļūdas klasi,
                                    ja validācija neizdodas.
                                --}}
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    autofocus
                                >

                                {{-- 
                                    Ja validācijā rodas kļūda e-pasta laukam,
                                    tiek parādīts kļūdas paziņojums.
                                --}}
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Formas pogas rinda --}}
                        <div class="row mb-0">

                            {{-- Nobīda pogu pa labi Bootstrap režģī --}}
                            <div class="col-md-6 offset-md-4">

                                {{-- Poga nosūta paroles atiestatīšanas pieprasījumu --}}
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>

                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection