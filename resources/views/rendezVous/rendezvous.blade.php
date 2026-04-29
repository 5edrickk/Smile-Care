<x-header/>
<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-full min-h-[80vh]">
        <x-article/>
        <div class="py-8 w-[80%]">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

                {{-- Barre de recherche, faudra changer apres pour utilisr livewire --}}
                <div class="mb-6 flex gap-2">
                    <input placeholder="{{ __('Chercher un patient...') }}"
                        class="w-full rounded-lg border border-gray-500 bg-white px-3 py-2.5 text-lg">
                    <button
                        class="w-25 rounded-lg border border-gray-500 bg-white px-4 py-2.5 text-sm shadow-sm hover:bg-gray-50">
                        {{ __('Rechercher') }}
                    </button>
                </div>
                <div class="mb-6 flex justify-end">
                    <a href="{{ route('rendezvousCreate') }}"
                        class="text-md rounded-lg border border-cyan-400 bg-white px-4 py-2 font-semibold text-cyan-500 shadow-sm hover:bg-cyan-50">
                        {{ __('Créer un rendez-vous') }}
                    </a>
                </div>

                <div class="space-y-4">
                    @if (empty($rendezVous))
                        <div class="text-center text-gray-500">
                            <x-heroicon-o-exclamation-triangle class="mx-auto h-10 w-10" />
                            {{ __('Aucun rendez-vous trouvé') }}
                        </div>
                    @else
                        @foreach ($rendezVous as $rdv)
                            <div class="overflow-hidden rounded-lg shadow-md">
                                <a href="{{ route('rendezvousID', ['id' => $rdv->id]) }}">
                                    <div class="bg-cyan-500 px-4 py-2 text-white">
                                        <p class="font-semibold">{{ $rdv->formaterDate() }}</p>
                                        <p class="text-sm">{{ $rdv->formaterHeure() }}</p>
                                    </div>

                                    <div class="flex items-center gap-4 bg-white px-4 py-4">
                                        {{-- limage du patient va etre ici --}}
                                        <div
                                            class="flex h-14 w-14 shrink-0 items-end justify-center overflow-hidden rounded-full bg-gray-300">
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">
                                                {{ $rdv->user->name . ' ' . $rdv->user->prenom }}
                                            </p>
                                            <p class="text-sm text-gray-500">Dentiste :
                                                {{ $rdv->dentiste->name . ' ' . $rdv->dentiste->prenom }}</p>
                                            <p class="text-sm text-gray-900">Traitement : {{ $rdv->service->name }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>
</body>

<x-footer/>
