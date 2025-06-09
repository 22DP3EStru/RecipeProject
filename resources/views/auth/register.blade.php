@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50 px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Izveidot kontu</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block mb-1 text-sm font-medium text-gray-700">Vārds un uzvārds</label>
                <input id="name" name="name" type="text" required autofocus
                    value="{{ old('name') }}"
                    class="w-full rounded-lg border border-gray-300 focus:ring-primary focus:border-primary px-3 py-2">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-700">E-pasta adrese</label>
                <input id="email" name="email" type="email" required
                    value="{{ old('email') }}"
                    class="w-full rounded-lg border border-gray-300 focus:ring-primary focus:border-primary px-3 py-2">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Parole</label>
                <input id="password" name="password" type="password" required
                    class="w-full rounded-lg border border-gray-300 focus:ring-primary focus:border-primary px-3 py-2">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password-confirm" class="block mb-1 text-sm font-medium text-gray-700">Atkārtojiet paroli</label>
                <input id="password-confirm" name="password_confirmation" type="password" required
                    class="w-full rounded-lg border border-gray-300 focus:ring-primary focus:border-primary px-3 py-2">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">Reģistrēties</button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Jau ir konts? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Ienākt</a>
        </p>
    </div>
</div>
@endsection
