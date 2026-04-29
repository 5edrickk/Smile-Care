<x-header />

<body class="bg-[#EBEBEB]">
    <div class="flex min-h-[80vh] max-w-full">
        <x-article />
        <div class="w-[80%] py-8">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

                {{-- Messages flash --}}
                @if (Session::has('success'))
                    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        {{ Session::get('error') }}
                    </div>
                @endif


                {{-- Barre de recherche, faudra changer apres pour utilisr livewire --}}
                <div class="mb-6 flex gap-2">
                    <input id="search-input" placeholder="{{ __('Chercher un patient...') }}"
                        class="w-full rounded-lg border border-gray-500 bg-white px-3 py-2.5 text-lg">
                    <button id="btn-rechercher"
                        class="w-25 rounded-lg border border-gray-500 bg-white px-4 py-2.5 text-sm shadow-sm hover:bg-gray-50">
                        {{ __('Rechercher') }}
                    </button>
                    <button id="btn-reinitialiser"
                        class="w-25 rounded-lg border border-gray-500 bg-white px-4 py-2.5 text-sm shadow-sm hover:bg-gray-50">
                        {{ __('Réinitialiser') }}
                    </button>
                </div>
                <div class="mb-6 flex justify-end">
                    <a href="{{ route('rendezvousCreate') }}"
                        class="text-md rounded-lg border border-cyan-400 bg-white px-4 py-2 font-semibold text-cyan-500 shadow-sm hover:bg-cyan-50">
                        {{ __('Créer un rendez-vous') }}
                    </a>
                </div>

                <div class="space-y-4">
                    <div id="tbody-rendez-vous">
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
                                                <p class="text-sm text-gray-900">Traitement : {{ $rdv->service->name }}
                                                </p>
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
    </div>
</body>
@vite('resources/js/rendezVous-search.js')
