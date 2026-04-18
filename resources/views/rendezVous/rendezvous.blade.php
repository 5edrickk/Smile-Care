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
                <input placeholder="Chercher un patient..."
                    class="w-full rounded-lg border border-gray-500 bg-white px-3 py-2.5 text-lg font-bold">
                <button
                    class="w-25 rounded-lg border border-gray-500 bg-white px-4 py-2.5 text-sm shadow-sm hover:bg-gray-50">
                    Rechercher
                </button>
            </div>

            {{-- A la place ici, les donnees viendront du controller qui passera les donnees en parametre a la vue --}}
            @php
                $rendezvoustest = [
                    [
                        'date' => '26 mai 2026',
                        'time' => '11h30',
                        'name' => 'Georges Dubois',
                        'age' => 29,
                        'treatment' => 'Check de carries',
                    ],
                    [
                        'date' => '28 mai 2026',
                        'time' => '12h35',
                        'name' => 'Robin Terrien',
                        'age' => 22,
                        'treatment' => 'Dents de sagesses',
                    ],
                    [
                        'date' => '1 juin 2026',
                        'time' => '9h25',
                        'name' => 'Marie Fontaine',
                        'age' => 35,
                        'treatment' => 'Détartrage',
                    ],
                ];
            @endphp

            <div class="space-y-4">
                @foreach ($rendezvoustest as $rdv)
                    <div class="overflow-hidden rounded-lg shadow-md">

                        {{-- pour la date et lheure du rdv --}}
                        <div class="bg-cyan-500 px-4 py-2 text-white">
                            <p class="font-semibold">{{ $rdv['date'] }}</p>
                            <p class="text-sm">{{ $rdv['time'] }}</p>
                        </div>

                        {{-- pour les informations du patient --}}
                        <div class="flex items-center gap-4 bg-white px-4 py-4">

                            {{-- limage du patient va etre ici --}}
                            <div
                                class="flex h-14 w-14 flex-shrink-0 items-end justify-center overflow-hidden rounded-full bg-gray-300">
                            </div>

                            {{-- pour le nom, lage et le traitement --}}
                            <div>
                                <p class="font-semibold text-gray-800">{{ $rdv['name'] }}</p>
                                <p class="text-sm text-gray-800">{{ $rdv['age'] }} ans</p>
                                <p class="text-sm text-gray-900">Traitement : {{ $rdv['treatment'] }}</p>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
