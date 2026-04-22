<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajouter un paiement
            </h2>
            <a href="{{ route('paiements.index') }}"
                class="text-sm text-indigo-600 hover:text-indigo-800 underline">
                ← Retour à la liste
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-8">

                {{-- Erreurs --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200
                                text-red-700 rounded-lg text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('paiements.store') }}"
                      id="form-paiement">
                    @csrf

                    {{-- Montant --}}
                    <div>
                        <x-input-label for="montant" :value="__('Montant ($)')" />
                        <x-text-input
                            id="montant"
                            name="montant"
                            type="text"
                            class="mt-1 block w-full"
                            :value="old('montant')"
                            placeholder="ex: 99.99"
                        />
                        <p class="text-red-600 text-sm mt-1 hidden"
                           id="erreur-montant"></p>
                        <x-input-error :messages="$errors->get('montant')"
                                       class="mt-2" />
                    </div>

                    {{-- Rendez-vous --}}
                    <div class="mt-4">
                        <x-input-label for="id_rendez_vous"
                                       :value="__('Rendez-vous')" />
                        <select id="id_rendez_vous" name="id_rendez_vous"
                            class="mt-1 block w-full border-gray-300 rounded-md
                                   shadow-sm text-sm focus:ring-indigo-500
                                   focus:border-indigo-500">
                            <option value="">-- Sélectionner --</option>
                            @foreach ($rendezVous as $rdv)
                                <option value="{{ $rdv->id }}"
                                    {{ old('id_rendez_vous') == $rdv->id
                                        ? 'selected' : '' }}>
                                    #{{ $rdv->id }} —
                                    {{ \Carbon\Carbon::parse($rdv->heure_date)
                                        ->format('d/m/Y H:i') }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('id_rendez_vous')"
                                       class="mt-2" />
                    </div>

                    {{-- Type de paiement --}}
                    <div class="mt-4">
                        <x-input-label for="id_type"
                                       :value="__('Type de paiement')" />
                        <select id="id_type" name="id_type"
                            class="mt-1 block w-full border-gray-300 rounded-md
                                   shadow-sm text-sm focus:ring-indigo-500
                                   focus:border-indigo-500">
                            <option value="">-- Sélectionner --</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('id_type') == $type->id
                                        ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('id_type')"
                                       class="mt-2" />
                    </div>

                    {{-- État --}}
                    <div class="mt-4">
                        <x-input-label for="id_etat" :value="__('État')" />
                        <select id="id_etat" name="id_etat"
                            class="mt-1 block w-full border-gray-300 rounded-md
                                   shadow-sm text-sm focus:ring-indigo-500
                                   focus:border-indigo-500">
                            <option value="">-- Sélectionner --</option>
                            @foreach ($etats as $etat)
                                <option value="{{ $etat->id }}"
                                    {{ old('id_etat') == $etat->id
                                        ? 'selected' : '' }}>
                                    {{ $etat->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('id_etat')"
                                       class="mt-2" />
                    </div>

                    <div class="mt-8 flex gap-4">
                        <x-primary-button id="btn-submit">
                            Enregistrer le paiement
                        </x-primary-button>
                        <a href="{{ route('paiements.index') }}"
                            class="bg-gray-100 text-gray-700 px-4 py-2
                                   rounded-md text-sm hover:bg-gray-200">
                            Annuler
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @vite('resources/js/paiement-validation.js')

</x-app-layout>
