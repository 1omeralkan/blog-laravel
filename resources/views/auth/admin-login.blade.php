<x-guest-layout>
    <div class="flex flex-col items-center mb-8">
        <div class="flex gap-4 mb-4">
            <a href="{{ route('login') }}" class="px-6 py-3 rounded-lg text-lg font-semibold bg-gray-200 text-gray-700 hover:bg-blue-500 hover:text-white transition">Kullanıcı Girişi</a>
            <a href="{{ route('admin.login') }}" class="px-6 py-3 rounded-lg text-lg font-semibold bg-blue-600 text-white">Admin Girişi</a>
        </div>
    </div>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                Admin Girişi
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> 