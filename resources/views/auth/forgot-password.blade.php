<x-guest-layout>

    <div class="mb-6 text-center">
        <h1 class="text-2xl font-semibold text-gray-800">SmileCare</h1>
        <p class="text-sm text-gray-500 mt-1">Récupération de mot de passe</p>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        Mot de passe oublié ? Entrez votre adresse courriel et nous vous
        enverrons un lien pour en choisir un nouveau.
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Adresse courriel')" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                placeholder="exemple@smilecare.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('login') }}"
                class="text-sm text-indigo-600 underline hover:text-indigo-800">
                Retour à la connexion
            </a>
            <x-primary-button>
                Envoyer le lien de réinitialisation
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
