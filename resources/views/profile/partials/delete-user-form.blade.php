<section class="space-y-6">
    <header class="mb-6">
        <h2 class="text-lg font-medium">
            DzÄ“st kontu
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Kad jÅ«su konts tiks dzÄ“sts, visi tÄ resursi un dati tiks neatgriezeniski izdzÄ“sti. Pirms konta dzÄ“Åanas, lÅ«dzu, lejupielÄdÄ“jiet visus datus vai informÄciju, ko vÄ“laties saglabÄt.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn-secondary text-red-600 hover:bg-red-50"
    >
        DzÄ“st kontu
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium mb-4">
                Vai tieÅÄm vÄ“laties dzÄ“st savu kontu?
            </h2>

            <p class="text-sm text-gray-600 mb-6">
                Kad jÅ«su konts tiks dzÄ“sts, visi tÄ resursi un dati tiks neatgriezeniski izdzÄ“sti. LÅ«dzu, ievadiet savu paroli, lai apstiprinÄtu, ka vÄ“laties neatgriezeniski dzÄ“st savu kontu.
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
                    DzÄ“st kontu
                </button>
            </div>
        </form>
    </x-modal>
</section>

