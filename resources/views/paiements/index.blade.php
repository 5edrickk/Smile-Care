<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestion des paiements
            </h2>
            <a href="{{ route('paiements.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md
                       text-sm hover:bg-indigo-700 transition">
                + Ajouter un paiement
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Messages flash --}}
            @if (Session::has('succes'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200
                            text-green-700 rounded-lg text-sm">
                    {{ Session::get('succes') }}
                </div>
            @endif

            @if (Session::has('erreur'))
                <div class="mb-4 p-4 bg-red-50 border border-red-200
                            text-red-700 rounded-lg text-sm">
                    {{ Session::get('erreur') }}
                </div>
            @endif

            {{-- Barre de recherche --}}
            <div class="mb-6 bg-white shadow-sm rounded-lg p-4">
                <div class="flex gap-3">
                    <input
                        type="text"
                        id="search-input"
                        placeholder="Rechercher par montant, état ou type..."
                        class="flex-1 border-gray-300 rounded-md text-sm
                               focus:ring-indigo-500 focus:border-indigo-500"
                    />
                   <button
                        id="btn-rechercher"
                        class="bg-indigo-600 text-white px-4 py-2
                            rounded-md text-sm hover:bg-indigo-700">
                        Rechercher
                    </button>
                    <button
                        id="btn-reinitialiser"
                        class="bg-gray-100 text-gray-700 px-4 py-2
                            rounded-md text-sm hover:bg-gray-200">
                        Réinitialiser
                    </button>
                </div>
            </div>

            {{-- Tableau des paiements --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200" id="table-paiements">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium
                                       text-gray-500 uppercase tracking-wider">
                                #
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium
                                       text-gray-500 uppercase tracking-wider">
                                Montant
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium
                                       text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium
                                       text-gray-500 uppercase tracking-wider">
                                État
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium
                                       text-gray-500 uppercase tracking-wider">
                                Rendez-vous
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium
                                       text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200"
                           id="tbody-paiements">
                        @forelse ($paiements as $paiement)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $paiement->id }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ number_format($paiement->montant, 2) }} $
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $paiement->typePaiement->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium
                                        {{ $paiement->etatPaiement->name === 'Payé'
                                            ? 'bg-green-100 text-green-800'
                                            : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $paiement->etatPaiement->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $paiement->id_rendez_vous }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <div class="flex gap-3">
                                        <a href="{{ route('paiements.show', $paiement->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900">
                                            Voir
                                        </a>
                                        <a href="{{ route('paiements.edit', $paiement->id) }}"
                                            class="text-amber-600 hover:text-amber-900">
                                            Modifier
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="px-6 py-8 text-center text-sm text-gray-500">
                                    Aucun paiement trouvé.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- Script fetch async pour la recherche --}}
    @vite('resources/js/paiement-search.js')

</x-app-layout>
