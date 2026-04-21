<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Un lien de vérification a été envoyé à votre adresse courriel.
        Cliquez sur ce lien pour compléter votre connexion.
    </div>

    {{-- Afficher message de succès si lien renvoyé --}}
    @if (Session::has('succes'))
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ Session::get('succes') }}
        </div>
    @endif

    {{-- Afficher les erreurs --}}
    @if ($errors->any())
        <div class="mb-4 text-sm font-medium text-red-600">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="mt-4 text-sm text-gray-600">
        <p>Vous n'avez pas reçu le courriel ?</p>

        {{-- Formulaire pour renvoyer le lien --}}
        <form method="POST" action="{{ route('mfa.resend') }}" class="mt-2">
            @csrf
            <button type="submit"
                class="text-blue-600 underline hover:text-blue-800">
                Renvoyer le lien de vérification
            </button>
        </form>
    </div>

    <div class="mt-4">
        <a href="{{ route('login') }}"
            class="text-sm text-gray-600 underline hover:text-gray-800">
            Retour à la page de connexion
        </a>
    </div>
</x-guest-layout>
