@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-4rem)] px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-2xl font-bold mb-6 text-center">Ienākt</h1>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block mb-1">E-pasts</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block mb-1">Parole</label>
                <input id="password" type="password" name="password" required
                       class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input class="rounded mr-2" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="text-sm">Atcerēties mani</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">Aizmirsi paroli?</a>
                @endif
            </div>

            <button class="w-full py-2 bg-primary text-white rounded-lg font-semibold">Ienākt</button>
        </form>
    </div>
</div>
@endsection
