<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Hesabı Sil
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Hesabınızı sildiğinizde tüm verileriniz kalıcı olarak silinecektir. Lütfen silmeden önce gerekli bilgileri yedekleyin.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Hesabı Sil</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Hesabınızı silmek istediğinize emin misiniz?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Hesabınızı sildiğinizde tüm verileriniz kalıcı olarak silinecektir. Lütfen onaylamak için şifrenizi girin.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Şifre" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Şifre"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Vazgeç
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Hesabı Sil
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
