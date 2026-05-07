{{--
    Paroles atiestatīšanas skats.

    Šis Blade fails tiek izmantots paroles atiestatīšanas procesa pēdējā posmā.
    Lietotājs šajā lapā ievada savu e-pasta adresi, jauno paroli un paroles
    apstiprinājumu, lai nomainītu esošo paroli.

    Skats satur:
    - slēpto paroles atiestatīšanas tokenu;
    - e-pasta ievades lauku;
    - jaunās paroles ievades lauku;
    - paroles apstiprināšanas lauku;
    - validācijas kļūdu attēlošanu;
    - paroles atiestatīšanas pogu.

    Forma izmanto Laravel maršrutu "password.update", kas apstrādā paroles
    maiņu un pārbauda tokena derīgumu.
--}}

@extends('layouts.app')

{{-- Sāk galveno lapas satura sekciju --}}
@section('content')

{{-- Galvenais Bootstrap konteiners --}}
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
                        Forma nosūta paroles atiestatīšanas datus
                        uz Laravel paroles atjaunošanas maršrutu.
                    --}}
                    <form method="POST" action="{{ route('password.update') }}">

                        {{-- CSRF aizsardzība pret neatļautiem pieprasījumiem --}}
                        @csrf

                        {{-- 
                            Slēptais tokena lauks.

                            Tokenu Laravel izmanto, lai pārbaudītu,
                            vai paroles atiestatīšanas saite ir derīga.
                        --}}
                        <input type="hidden" name="token" value="{{ $token }}">

                        {{-- E-pasta ievades lauks --}}
                        <div class="row mb-3">

                            {{-- E-pasta lauka nosaukums --}}
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                {{ __('Email Address') }}
                            </label>

                            <div class="col-md-6">

                                {{--
                                    E-pasta ievades lauks.

                                    Ja $email vērtība eksistē, tā tiek izmantota automātiski.
                                    Pretējā gadījumā tiek izmantota iepriekš ievadītā vērtība.
                                --}}
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ $email ?? old('email') }}"
                                    required
                                    autocomplete="email"
                                    autofocus
                                >

                                {{-- 
                                    Ja validācijā rodas kļūda e-pasta laukam,
                                    tiek attēlots kļūdas ziņojums.
                                --}}
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Jaunās paroles ievades lauks --}}
                        <div class="row mb-3">

                            {{-- Paroles lauka nosaukums --}}
                            <label for="password" class="col-md-4 col-form-label text-md-end">
                                {{ __('Password') }}
                            </label>

                            <div class="col-md-6">

                                {{--
                                    Jaunās paroles ievades lauks.

                                    autocomplete="new-password" palīdz pārlūkam
                                    saprast, ka tiek ievadīta jauna parole.
                                --}}
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                >

                                {{-- 
                                    Ja paroles validācija neizdodas,
                                    tiek attēlots kļūdas ziņojums.
                                --}}
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Paroles apstiprinājuma ievades lauks --}}
                        <div class="row mb-3">

                            {{-- Paroles apstiprinājuma lauka nosaukums --}}
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">
                                {{ __('Confirm Password') }}
                            </label>

                            <div class="col-md-6">

                                {{--
                                    Lauks paredzēts atkārtotai paroles ievadei,
                                    lai pārbaudītu, vai abas paroles sakrīt.
                                --}}
                                <input
                                    id="password-confirm"
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                >

                            </div>
                        </div>

                        {{-- Formas pogas rinda --}}
                        <div class="row mb-0">

                            {{-- Nobīda pogu pa labi Bootstrap režģī --}}
                            <div class="col-md-6 offset-md-4">

                                {{-- Poga nosūta paroles atiestatīšanas formu --}}
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
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