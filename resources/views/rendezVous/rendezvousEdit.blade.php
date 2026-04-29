<x-header />

<body class="bg-[#EBEBEB]">
    <div class="flex min-h-[80vh] max-w-full">
        <x-article />
        <div class="w-[80%] py-8">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <div class="overflow-hidden rounded-lg bg-white shadow-md">
                    <div class="bg-cyan-500 px-6 py-5 text-white">
                        <span class="text-base font-semibold">{{ __('Détails du rendez-vous') }}</span>
                    </div>

                    <form action="{{ route('rendezvousUpdate', ['id' => $rendezVous->id]) }}" method="POST"
                        class="space-y-4 px-6 py-6 shadow-2xl" id="form-rendez-vous">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Client --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Client') }}<span
                                    class="text-red-500">*</span></label>
                            <select name="id_user" required
                                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400"
                                id="id_user">
                                <option value="">{{ __('Sélectionner un client') }}</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}"
                                        {{ old('id_user', $rendezVous->id_user) == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }} {{ $client->prenom }} ({{ $client->email }})
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 hidden text-sm text-red-600" id="erreur-id_user"></p>
                            <x-input-error :messages="$errors->get('id_user')" class="mt-2" />
                        </div>

                        {{-- Dentiste --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Dentiste') }}<span
                                    class="text-red-500">*</span></label>
                            <select name="id_dentiste" required
                                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400"
                                id="id_dentiste">
                                <option value="">{{ __('Sélectionner un dentiste') }}</option>
                                @foreach ($dentistes as $dentiste)
                                    <option value="{{ $dentiste->id }}"
                                        {{ old('id_dentiste', $rendezVous->id_dentiste) == $dentiste->id ? 'selected' : '' }}>
                                        {{ $dentiste->name }} {{ $dentiste->prenom }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 hidden text-sm text-red-600" id="erreur-id_dentiste"></p>
                            <x-input-error :messages="$errors->get('id_dentiste')" class="mt-2" />
                        </div>

                        {{-- État --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('État') }}<span
                                    class="text-red-500">*</span></label>
                            <select name="id_etat" required
                                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400"
                                id="id_etat">
                                <option value="">{{ __('Sélectionner un état') }}</option>
                                @foreach ($etatsRendezVous as $etat)
                                    <option value="{{ $etat->id }}"
                                        {{ old('id_etat', $rendezVous->id_etat) == $etat->id ? 'selected' : '' }}>
                                        {{ $etat->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 hidden text-sm text-red-600" id="erreur-id_etat"></p>
                            <x-input-error :messages="$errors->get('id_etat')" class="mt-2" />
                        </div>

                        {{-- Service --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Service') }}<span
                                    class="text-red-500">*</span></label>
                            <select name="id_service" required
                                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400"
                                id="id_service">
                                <option value="">{{ __('Sélectionner un service') }}</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ old('id_service', $rendezVous->id_service) == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 hidden text-sm text-red-600" id="erreur-id_service"></p>
                            <x-input-error :messages="$errors->get('id_service')" class="mt-2" />
                        </div>

                        {{-- Date et heure --}}
                        {{-- Source: https://techsolutionstuff.com/post/how-to-use-flatpickr-in-laravel-10 --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Date et heure') }}<span
                                    class="text-red-500">*</span></label>
                            <input type="datetime-local" name="heure_date" id="heure_date" required
                                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400"
                                id="heure_date" value="{{ old('heure_date', $rendezVous->heure_date) }}" />
                            <p class="mt-1 hidden text-sm text-red-600" id="erreur-heure_date"></p>
                            <x-input-error :messages="$errors->get('heure_date')" class="mt-2" />
                        </div>
                        <script>
                            // Initialize Flatpickr
                            flatpickr("#heure_date", {
                                enableTime: true, // Set to true if you want to include time selection
                                dateFormat: "Y-m-d H:i", // Customize the date format as needed
                                minDate: "{{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}",
                                maxDate: "{{ \Carbon\Carbon::now()->addDays(30)->format('Y-m-d') }}",
                                minTime: "8:00",
                                maxTime: "17:00",

                                disable: [ //ajouter une fonction qui verifie les heures deja prises et les desactive, pas toute la journee comme live
                                    @foreach ($heures as $heure)
                                        @if ($heure->heure_date)
                                            {
                                                from: "{{ \Carbon\Carbon::parse($heure->heure_date)->format('Y-m-d') }}",
                                                to: "{{ \Carbon\Carbon::parse($heure->heure_date)->format('Y-m-d') }}"
                                            },
                                        @endif
                                    @endforeach
                                ]
                            });
                        </script>

                        {{-- Commentaire --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Commentaire') }}</label>
                            <textarea name="commentaire" rows="3"
                                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400">{{ old('commentaire', $rendezVous->commentaire) }}</textarea>
                        </div>

                        {{-- Boutons --}}
                        <div class="flex items-center justify-end gap-3 pt-2">
                            <a href="{{ route('rendezvousID', ['id' => $rendezVous->id]) }}"
                                class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                {{ __('Annuler') }}
                            </a>
                            <button type="submit"
                                class="rounded-lg bg-cyan-500 px-4 py-2 text-sm font-semibold text-white hover:bg-cyan-600">
                                {{ __('Modifier') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/rendezVous-validation.js')
</body
