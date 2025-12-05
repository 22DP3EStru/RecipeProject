<section class="space-y-6">
    <header class="mb-6">
        <h2 class="text-lg font-medium">
            Dzēst kontu
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Kad jūsu konts tiks dzēsts, visi tā resursi un dati tiks neatgriezeniski izdzēsti. Pirms konta dzēšanas, lūdzu, lejupielādējiet visus datus vai informāciju, ko vēlaties saglabāt.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn-secondary text-red-600 hover:bg-red-50"
    >
        Dzēst kontu
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium mb-4">
                Vai tiešām vēlaties dzēst savu kontu?
            </h2>

            <p class="text-sm text-gray-600 mb-6">
                Kad jūsu konts tiks dzēsts, visi tā resursi un dati tiks neatgriezeniski izdzēsti. Lūdzu, ievadiet savu paroli, lai apstiprinātu, ka vēlaties neatgriezeniski dzēst savu kontu.
            </p>

            <div class="mb-6">
                <label for="password" class="form-label">Parole</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input w-full"
                    placeholder="Ievadiet savu paroli"
                />
                @error('password', 'userDeletion')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close')" class="btn-secondary">
                    Atcelt
                </button>

                <button type="submit" class="btn-primary bg-red-600 hover:bg-red-700">
                    Dzēst kontu
                </button>
            </div>
        </form>
    </x-modal>
</section>
