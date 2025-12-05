<section>
    <header class="mb-6">
        <h2 class="text-lg font-medium">
            Profila informācija
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Atjauniniet sava konta informāciju un e-pasta adresi.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="form-label">Vārds</label>
            <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $user->name) }}" required autofocus />
            @error('name')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="form-label">E-pasts</label>
            <input type="email" id="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required />
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-600">
                        Jūsu e-pasta adrese nav apstiprināta.

                        <button form="send-verification" class="nav-link text-sm">
                            Noklikšķiniet šeit, lai atkārtoti nosūtītu verifikācijas e-pastu.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm badge-green">
                            Jauna verifikācijas saite ir nosūtīta uz jūsu e-pasta adresi.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary">
                Saglabāt izmaiņas
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm badge-green">
                    Saglabāts!
                </p>
            @endif
        </div>
    </form>
</section>
