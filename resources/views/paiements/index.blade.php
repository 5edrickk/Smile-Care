{{-- Script fetch async pour la recherche --}}
@vite('resources/js/paiement-search.js')

<x-header />

<body class="bg-[#EBEBEB]">
    <div class="flex min-h-[80vh] max-w-full">
        <x-article />

        <div class="min-h-[70%] w-[80%]">
            <a href="{{ route('paiements.create') }}"
                class="rounded-md bg-[#009CCF] px-4 py-2 text-sm text-white transition hover:bg-[#066586]">
                + {{ __('Ajouter un paiement') }}
            </a>
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

                    {{-- Messages flash --}}
                    @if (Session::has('succes'))
                        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                            {{ Session::get('succes') }}
                        </div>
                    @endif

                    @if (Session::has('erreur'))
                        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                            {{ Session::get('erreur') }}
                        </div>
                    @endif

                    {{-- Barre de recherche --}}
                    <div class="mb-6 rounded-lg bg-white p-4 shadow-sm">
                        <div class="flex gap-3">
                            <input type="text" id="search-input"
                                placeholder="{{ __('Rechercher par montant, état ou type...') }}"
                                class="flex-1 rounded-md border-gray-300 text-sm focus:border-[#009CCF] focus:ring-[#009CCF]" />
                            <button id="btn-rechercher"
                                class="rounded-md bg-[#009CCF] px-4 py-2 text-sm text-white hover:bg-[#066586]">
                                {{ __('Rechercher') }}
                            </button>
                            <button id="btn-reinitialiser"
                                class="rounded-md bg-gray-100 px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">
                                {{ __('Réinitialiser') }}
                            </button>
                        </div>
                    </div>

                    {{-- Tableau des paiements --}}
                    <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200" id="table-paiements">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ __('Montant') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ __('Type') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ __('État') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ __('Client') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ __('Rendez-vous') }}
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white" id="tbody-paiements">
                                @forelse ($paiements as $paiement)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                            {{ number_format($paiement->montant, 2) }} $
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $paiement->typePaiement->name ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <span
                                                class="{{ $paiement->etatPaiement->name === 'Payé' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} rounded-full px-2 py-1 text-xs font-medium">
                                                {{ $paiement->etatPaiement->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $paiement->rendezVous?->user
                                                ? $paiement->rendezVous->user->prenom . ' ' . $paiement->rendezVous->user->name
                                                : '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            @if ($paiement->rendezVous)
                                                <span class="block">{{ $paiement->rendezVous->formaterDate() }}</span>
                                                <span
                                                    class="block text-gray-400">{{ $paiement->rendezVous->formaterHeure() }}</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium">
                                            <div class="flex gap-3">
                                                <a href="{{ route('paiements.show', $paiement->id) }}"
                                                    class="text-[#009CCF] hover:text-[#066586]">
                                                    {{ __('Voir') }}
                                                </a>
                                                <a href="{{ route('paiements.edit', $paiement->id) }}"
                                                    class="text-[#009CCF] hover:text-[#066586]">
                                                    {{ __('Modifier') }}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                            {{ __('Aucun paiement trouvé.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

<x-footer />
