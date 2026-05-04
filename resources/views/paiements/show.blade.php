@vite('resources/js/paiement-validation.js')
<x-header />

<body class="bg-[#EBEBEB]">
    <div class="flex min-h-[80vh] max-w-full">
        <x-article />
        <div class="min-h-[70%] w-[80%]">
            <div class="py-12">
                <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                    <div class="rounded-lg bg-white p-8 shadow-sm">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs font-medium uppercase text-gray-400">
                                    {{ __('Montant') }}
                                </p>
                                <p class="mt-1 text-2xl font-semibold text-gray-900">
                                    {{ number_format($paiement->montant, 2) }} $
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-medium uppercase text-gray-400">
                                    {{ __('État') }}
                                </p>
                                <span
                                    class="{{ $paiement->etatPaiement->name === 'Payé' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} mt-1 inline-block rounded-full px-3 py-1 text-sm font-medium">
                                    {{ $paiement->etatPaiement->name ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <p class="text-xs font-medium uppercase text-gray-400">
                                    {{ __('Type de paiement') }}
                                </p>
                                <p class="mt-1 text-gray-900">
                                    {{ $paiement->typePaiement->name ?? '-' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-medium uppercase text-gray-400">
                                    {{ __('Client') }}
                                </p>
                                <p class="mt-1 text-gray-900">
                                    {{ $paiement->rendezVous?->user
                                        ? $paiement->rendezVous->user->prenom . ' ' . $paiement->rendezVous->user->name
                                        : '-' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-medium uppercase text-gray-400">
                                    {{ __('Rendez-vous') }}
                                </p>
                                <p class="mt-1 text-gray-900">
                                    @if ($paiement->rendezVous)
                                        {{ $paiement->rendezVous->formaterDate() }}
                                        <span class="text-gray-400">
                                            {{ $paiement->rendezVous->formaterHeure() }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="mt-8 flex gap-4">
                            <a href="{{ route('paiements.edit', $paiement->id) }}"
                                class="rounded-md bg-[#009CCF] px-4 py-2 text-sm text-white transition hover:bg-[#066586]">
                                {{ __('Modifier ce paiement') }}
                            </a>
                            <a href="{{ route('paiements.index') }}"
                                class="rounded-md bg-gray-100 px-4 py-2 text-sm text-gray-700 transition hover:bg-gray-200 hover:text-gray-900">
                                {{ __('Retour à la liste') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<x-footer />
