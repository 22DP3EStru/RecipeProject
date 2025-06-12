<section>
    <header class="mb-6">
        <h2 class="text-lg font-medium">
            Mainīt paroli
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Pārliecinieties, ka jūsu konts izmanto garu, nejaušu paroli drošībai.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="form-label">Pašreizējā parole</label>
            <input type="password" id="current_password" name="current_password" class="form-input" autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="form-label">Jaunā parole</label>
            <input type="password" id="password" name="password" class="form-input" autocomplete="new-password" />
            @error('password', 'updatePassword')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="form-label">Apstiprināt paroli</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary">
                Saglabāt jauno paroli
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="badge-green">
                    Saglabāts!
                </p>
            @endif
        </div>
    </form>
</section>
