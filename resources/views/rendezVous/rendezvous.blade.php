<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Liste des rendez-vous') }}
        </h2>
    </x-slot>

    <div class="py-8">
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
                <button type="button" wire:click="createRendezVous"
                    class="rounded-lg border border-cyan-500 bg-cyan-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-cyan-600">
                    {{ __('Créer un Rendez-vous') }}
                </button>
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
                                {{-- pour la date et lheure du rdv --}}
                                <div class="bg-cyan-500 px-4 py-2 text-white">
                                    <p class="font-semibold">{{ $rdv->formaterDate() }}</p>
                                    <p class="text-sm">{{ $rdv->formaterHeure() }}</p>
                                </div>

                                {{-- pour les informations du patient --}}
                                <div class="flex items-center gap-4 bg-white px-4 py-4">

                                    {{-- limage du patient va etre ici --}}
                                    <div
                                        class="flex h-14 w-14 flex-shrink-0 items-end justify-center overflow-hidden rounded-full bg-gray-300">
                                    </div>

                                    {{-- pour le nom, lage et le traitement --}}
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $rdv->user->name }}</p>
                                        {{-- <p class="text-sm text-gray-800">{{ $rdv->user->age }} ans</p> --}}
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
</x-app-layout>
