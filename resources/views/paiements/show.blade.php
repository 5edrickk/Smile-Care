<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Détail du paiement #{{ $paiement->id }}
            </h2>
            <a href="{{ route('paiements.index') }}"
                class="text-sm text-indigo-600 hover:text-indigo-800 underline">
                ← Retour à la liste
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-8">

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase">
                            Montant
                        </p>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">
                            {{ number_format($paiement->montant, 2) }} $
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase">
                            État
                        </p>
                        <span class="inline-block mt-1 px-3 py-1 rounded-full
                                     text-sm font-medium
                            {{ $paiement->etatPaiement->name === 'Payé'
                                ? 'bg-green-100 text-green-800'
                                : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $paiement->etatPaiement->name ?? '-' }}
                        </span>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase">
                            Type de paiement
                        </p>
                        <p class="text-gray-900 mt-1">
                            {{ $paiement->typePaiement->name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase">
                            Rendez-vous
                        </p>
                        <p class="text-gray-900 mt-1">
                            #{{ $paiement->id_rendez_vous }}
                        </p>
                    </div>
                </div>

                <div class="mt-8 flex gap-4">
                    <a href="{{ route('paiements.edit', $paiement->id) }}"
                        class="bg-amber-500 text-white px-4 py-2 rounded-md
                               text-sm hover:bg-amber-600 transition">
                        Modifier ce paiement
                    </a>
                    <a href="{{ route('paiements.index') }}"
                        class="bg-gray-100 text-gray-700 px-4 py-2 rounded-md
                               text-sm hover:bg-gray-200 transition">
                        Retour à la liste
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
