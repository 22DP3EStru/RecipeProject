<section>
    <header class="mb-6">
        <h2 class="text-lg font-medium">
            MainÄ«t paroli
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            PÄrliecinieties, ka jÅ«su konts izmanto garu, nejauÅu paroli droÅÄ«bai.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="form-label">PaÅreizÄ“jÄ parole</label>
            <input type="password" id="current_password" name="current_password" class="form-input" autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="form-label">JaunÄ parole</label>
            <input type="password" id="password" name="password" class="form-input" autocomplete="new-password" />
            @error('password', 'updatePassword')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="form-label">ApstiprinÄt paroli</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary">
                SaglabÄt jauno paroli
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="badge-green">
                    SaglabÄts!
                </p>
            @endif
        </div>
    </form>
</section>

