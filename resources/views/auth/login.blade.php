<x-guest-layout>

    {{-- Titre de la page --}}
    <div class="mb-6 text-center">
        <p class="text-sm text-gray-500 mt-1">Connexion au panneau employés</p>
    </div>

    {{-- Message de statut (ex: mot de passe réinitialisé) --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Erreurs générales --}}
    @if ($errors->any())
        <div class="mb-4 text-sm text-red-600 bg-red-50
                    border border-red-200 rounded-lg p-3">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Courriel --}}
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
                autocomplete="username"
                placeholder="exemple@smilecare.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Mot de passe --}}
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Se souvenir de moi --}}
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded-sm border-gray-300 text-indigo-600
                           shadow-xs focus:ring-indigo-500"
                    name="remember"
                />
                <span class="ms-2 text-sm text-gray-600">
                    Se souvenir de moi
                </span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            {{-- Mot de passe oublié --}}
            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-800
                           underline rounded-md focus:outline-hidden
                           focus:ring-2 focus:ring-offset-2
                           focus:ring-indigo-500"
                   href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif

            <x-primary-button>
                Se connecter
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
