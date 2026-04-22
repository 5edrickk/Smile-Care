<x-guest-layout>

    <div class="mb-6 text-center">
        <h1 class="text-2xl font-semibold text-gray-800">SmileCare</h1>
        <p class="text-sm text-gray-500 mt-1">Réinitialisation du mot de passe</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        {{-- Token caché — nécessaire pour identifier la demande de reset --}}
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Courriel --}}
        <div>
            <x-input-label for="email" :value="__('Adresse courriel')" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email', $request->email)"
                required
                autofocus
                autocomplete="username"
                placeholder="exemple@smilecare.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Nouveau mot de passe --}}
        <div class="mt-4">
            <x-input-label for="password" :value="__('Nouveau mot de passe')" />
            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Minimum 8 caractères"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Confirmation --}}
        <div class="mt-4">
            <x-input-label
                for="password_confirmation"
                :value="__('Confirmer le mot de passe')"
            />
            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Répéter le nouveau mot de passe"
            />
            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button>
                Réinitialiser le mot de passe
            </x-primary-button>
        </div>

    </form>

</x-guest-layout>
