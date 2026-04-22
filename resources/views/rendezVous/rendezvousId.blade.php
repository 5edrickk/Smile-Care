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

            <div class="overflow-hidden rounded-lg bg-white shadow-md">
                <div class="flex items-center justify-between bg-cyan-500 px-6 py-5 text-white">
                    <div class="text-base font-semibold">
                        <span class="font-semibold"> {{ $rendezVous->user->name . ' ' . $rendezVous->user->prenom }}
                        </span>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-semibold">{{ $rendezVous->formaterDate() }}</p>
                        <p class="text-sm opacity-90">{{ $rendezVous->formaterHeure() }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 px-6 py-5 sm:grid-cols-2">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            {{ __('État') }}
                        </p>
                        <p class="mt-1 flex items-center text-sm text-gray-900">
                            {{ $etatRendezVous->name }}
                            @if ($etatRendezVous->id == 1)
                                <x-heroicon-o-clock class="mr-1 h-4 w-4 pl-1 text-red-500" />
                            @elseif ($etatRendezVous->id == 2)
                                <x-heroicon-o-clock class="mr-1 h-4 w-4 pl-1 text-yellow-500" />
                            @elseif ($etatRendezVous->id == 3)
                                <x-heroicon-o-check class="mr-1 h-4 w-4 pl-1 text-green-500" />
                            @endif
                        </p>

                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            {{ __('Service') }}
                        </p>
                        <div class="flex flex-col gap-2">
                            <p class="mt-1 border-b border-gray-300 pb-2 text-sm text-gray-900">
                                Nom du service : {{ $rendezVous->service->name }}</p>
                            <p class="mt-1 text-sm text-gray-900">Description : {{ $rendezVous->service->description }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            {{ __('Client') }}
                        </p>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ $rendezVous->user->prenom . ' ' . $rendezVous->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            {{ __('Dentiste responsable') }}
                        </p>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ $dentiste->prenom . ', ' . $dentiste->name }}</p>
                    </div>
                </div>

                <div class="px-6 py-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        {{ __('Commentaire') }}
                    </p>
                    <p class="mt-1 text-sm leading-relaxed text-gray-700">{{ $rendezVous->commentaire }}</p>
                </div>
                <div class="flex justify-end gap-3 px-6 py-5">
                    <a href="{{ route('rendezvousEdit', ['id' => $rendezVous->id]) }}"
                        class="text-md rounded-lg border border-cyan-400 bg-white px-4 py-2 font-semibold text-cyan-500 shadow-sm hover:bg-cyan-50">
                        <p class="">Modifier</p>
                    </a>

                    <form method="POST" action="{{ route('rendezvousDestroy') }}">
                        @csrf
                        <button type="submit" name="id_rendez_vous" value="{{ $rendezVous->id }}"
                            class="inline-flex items-center justify-center gap-2 rounded-lg border border-transparent bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-red-800">
                            <x-heroicon-o-trash class="h-4 w-4 text-white" />
                            <p class="text-sm font-semibold text-white">Supprimer</p>
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
