<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Détails du rendez-vous') }}
            </h2>
            <a href="{{ route('rendezvous') }}"
                class="inline-flex items-center gap-1 rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                &larr; {{ __('Retour') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            {{-- A remplacer par les vraies donnees du $rendezVous passe en parametre --}}
            @php
                $rdv = [
                    'date' => '26 mai 2026',
                    'time' => '11h30',
                    'commentaire' =>
                        'Le patient ressent une gêne du côté droit. Prévoir une radiographie de contrôle si nécessaire.',
                    'id_etat' => 3,
                    'id_service' => 5,
                    'id_client' => 14,
                    'id_employe' => 7,
                ];
            @endphp

            <div class="overflow-hidden rounded-lg bg-white shadow-md">

                {{-- En-tête avec le nom du client à gauche et la date/heure à droite --}}
                <div class="flex items-center justify-between bg-cyan-500 px-6 py-5 text-white">
                    <div class="text-base font-semibold">
                        <span class="font-semibold"> {{ 'George Dubois' }} </span>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-semibold">{{ $rdv['date'] }}</p>
                        <p class="text-sm opacity-90">{{ $rdv['time'] }}</p>
                    </div>
                </div>


                {{-- tout changer pour prender les donnes de l'objet rendezvous passee en parametre --}}
                <div class="grid grid-cols-1 gap-4 border-b border-gray-100 px-6 py-5 sm:grid-cols-2">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            {{ __('État') }}
                        </p>
                        <p class="mt-1 flex items-center text-sm text-gray-900">
                            {{ $rdv['id_etat'] }}
                            @if ($rdv['id_etat'] == 1)
                                <x-heroicon-o-clock class="mr-1 h-4 w-4 pl-1 text-red-500" />
                            @elseif ($rdv['id_etat'] == 2)
                                <x-heroicon-o-clock class="mr-1 h-4 w-4 pl-1 text-yellow-500" />
                            @elseif ($rdv['id_etat'] == 3)
                                <x-heroicon-o-check class="mr-1 h-4 w-4 pl-1 text-green-500" />
                            @endif
                        </p>


                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            {{ __('Service') }}
                        </p>
                        <p class="mt-1 text-sm text-gray-900">{{ $rdv['id_service'] }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            {{ __('Client') }}
                        </p>
                        <p class="mt-1 text-sm text-gray-900">{{ $rdv['id_client'] }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            {{ __('Employé') }}
                        </p>
                        <p class="mt-1 text-sm text-gray-900">{{ $rdv['id_employe'] }}</p>
                    </div>
                </div>

                {{-- Commentaire --}}
                <div class="px-6 py-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        {{ __('Commentaire') }}
                    </p>
                    <p class="mt-1 text-sm leading-relaxed text-gray-700">{{ $rdv['commentaire'] }}</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
