{{--
    Paroles apstiprināšanas skats.

    Šis Blade fails tiek izmantots gadījumos, kad lietotājam pirms turpmākas darbības
    jāapstiprina sava parole. Šāda pārbaude parasti tiek izmantota drošības nolūkos,
    piemēram, pirms sensitīvu konta iestatījumu maiņas vai piekļuves aizsargātai sadaļai.

    Skatā tiek attēlota paroles ievades forma, kļūdu paziņojumi un saite uz paroles
    atjaunošanas lapu, ja lietotājs ir aizmirsis paroli.
--}}

@extends('layouts.app')

{{-- Sāk galveno lapas satura sekciju --}}
@section('content')

{{-- Galvenais Bootstrap konteiners, kas centrē lapas saturu --}}
<div class="container">

    {{-- Rinda tiek izmantota, lai kartīti novietotu lapas centrā --}}
    <div class="row justify-content-center">

        {{-- Kolonna nosaka paroles apstiprināšanas kartītes platumu --}}
        <div class="col-md-8">

            {{-- Kartīte satur virsrakstu, paskaidrojumu un formu --}}
            <div class="card">

                {{-- Kartītes virsraksts --}}
                <div class="card-header">
                    {{ __('Confirm Password') }}
                </div>

                {{-- Kartītes galvenais saturs --}}
                <div class="card-body">

                    {{-- Paskaidrojums lietotājam, kāpēc nepieciešama paroles apstiprināšana --}}
                    {{ __('Please confirm your password before continuing.') }}

                    {{-- Forma nosūta ievadīto paroli uz Laravel paroles apstiprināšanas maršrutu --}}
                    <form method="POST" action="{{ route('password.confirm') }}">

                        {{-- CSRF aizsardzība pret neatļautiem formas pieprasījumiem --}}
                        @csrf

                        {{-- Paroles ievades lauks --}}
                        <div class="row mb-3">

                            {{-- Paroles lauka nosaukums --}}
                            <label for="password" class="col-md-4 col-form-label text-md-end">
                                {{ __('Password') }}
                            </label>

                            <div class="col-md-6">

                                {{-- 
                                    Paroles ievades lauks.
                                    @error direktīva pievieno is-invalid klasi, ja parole nav ievadīta pareizi.
                                --}}
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                >

                                {{-- Ja validācijā ir paroles kļūda, tiek parādīts kļūdas paziņojums --}}
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        {{-- Formas pogu rinda --}}
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">

                                {{-- Nosūta paroles apstiprināšanas formu --}}
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                {{-- Ja paroles atiestatīšanas maršruts eksistē, tiek parādīta paroles atjaunošanas saite --}}
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection