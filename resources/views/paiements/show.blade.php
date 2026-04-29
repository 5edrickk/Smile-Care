@vite('resources/js/paiement-validation.js')
<x-header/>
<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-full min-h-[80vh]">
        <x-article/>
        <div class="min-h-[70%] w-[80%]">
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
                                    Client
                                </p>
                                <p class="text-gray-900 mt-1">
                                    {{ $paiement->rendezVous?->user
                                        ? $paiement->rendezVous->user->prenom . ' ' . $paiement->rendezVous->user->name
                                        : '-' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase">
                                    Rendez-vous
                                </p>
                                <p class="text-gray-900 mt-1">
                                    @if($paiement->rendezVous)
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
                                class="bg-bluepain text-white px-4 py-2 rounded-md
                                    text-sm transition">
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
        </div>
    </div>
</body>
