@vite('resources/js/paiement-validation.js')
<x-header />

<body class="bg-[#EBEBEB]">
    <div class="flex min-h-[80vh] max-w-full">
        <x-article />

        <div class="min-h-[70%] w-[80%]">
            <div class="py-12">
                <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                    <div class="rounded-lg bg-white p-8 shadow-sm">

                        {{-- Erreurs --}}
                        @if ($errors->any())
                            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('paiements.store') }}" id="form-paiement">
                            @csrf

                            {{-- Montant --}}
                            <div>
                                <x-input-label for="montant" :value="__('Montant ($)')" />
                                <x-text-input id="montant" name="montant" type="text" class="mt-1 block w-full"
                                    :value="old('montant')" placeholder="ex: 99.99" />
                                <p class="mt-1 hidden text-sm text-red-600" id="erreur-montant"></p>
                                <x-input-error :messages="$errors->get('montant')" class="mt-2" />
                            </div>

                            {{-- Rendez-vous --}}
                            <div class="mt-4">
                                <x-input-label for="id_rendez_vous" :value="__('Rendez-vous')" />
                                <select id="id_rendez_vous" name="id_rendez_vous"
                                    class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-[#009CCF] focus:ring-[#009CCF]">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach ($rendezVous as $rdv)
                                        <option value="{{ $rdv->id }}"
                                            {{ old('id_rendez_vous') == $rdv->id ? 'selected' : '' }}>
                                            #{{ $rdv->id }} —
                                            {{ \Carbon\Carbon::parse($rdv->heure_date)->format('d/m/Y H:i') }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('id_rendez_vous')" class="mt-2" />
                            </div>

                            {{-- Type de paiement --}}
                            <div class="mt-4">
                                <x-input-label for="id_type" :value="__('Type de paiement')" />
                                <select id="id_type" name="id_type"
                                    class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-[#009CCF] focus:ring-[#009CCF]">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('id_type') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('id_type')" class="mt-2" />
                            </div>

                            {{-- État --}}
                            <div class="mt-4">
                                <x-input-label for="id_etat" :value="__('État')" />
                                <select id="id_etat" name="id_etat"
                                    class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-[#009CCF] focus:ring-[#009CCF]">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach ($etats as $etat)
                                        <option value="{{ $etat->id }}"
                                            {{ old('id_etat') == $etat->id ? 'selected' : '' }}>
                                            {{ $etat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('id_etat')" class="mt-2" />
                            </div>

                            <div class="mt-8 flex gap-4">
                                <x-primary-button id="btn-submit">
                                    Enregistrer le paiement
                                </x-primary-button>
                                <a href="{{ route('paiements.index') }}"
                                    class="rounded-md bg-gray-100 px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">
                                    Annuler
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<x-footer />
