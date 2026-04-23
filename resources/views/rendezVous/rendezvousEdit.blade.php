<x-header/>
<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-[100%] min-h-[80vh]">
        <x-article/>
        <div class="py-8 w-[80%]">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <div class="overflow-hidden rounded-lg bg-white shadow-md">
                    <div class="bg-cyan-500 px-6 py-5 text-white">
                        <span class="text-base font-semibold">{{ __('Détails du rendez-vous') }}</span>
                    </div>

                    <form action="{{ route('rendezvousUpdate', ['id' => $rendezVous->id]) }}" method="POST"
                        class="space-y-4 px-6 py-6 shadow-2xl">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Dentiste') }}<span
                                    class="text-red-500">*</span></label>
                            <select name="id_dentiste" required
                                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400">
                                <option value="">{{ __('Sélectionner un dentiste') }}</option>
                                @foreach ($dentistes as $dentiste)
                                    <option value="{{ $dentiste->id }}"
                                        {{ old('id_dentiste', $rendezVous->id_dentiste) == $dentiste->id ? 'selected' : '' }}>
                                        {{ $dentiste->name }} {{ $dentiste->prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('État') }}<span
                                    class="text-red-500">*</span></label>
                            <select name="id_etat" required
                                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400">
                                <option value="">{{ __('Sélectionner un état') }}</option>
                                @foreach ($etatsRendezVous as $etat)
                                    <option value="{{ $etat->id }}"
                                        {{ old('id_etat', $rendezVous->id_etat) == $etat->id ? 'selected' : '' }}>
                                        {{ $etat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Service') }}<span
                                    class="text-red-500">*</span></label>
                            <select name="id_service" required
                                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400">
                                <option value="">{{ __('Sélectionner un service') }}</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ old('id_service', $rendezVous->id_service) == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Source: https://techsolutionstuff.com/post/how-to-use-flatpickr-in-laravel-10 --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Date et heure') }}<span
                                    class="text-red-500">*</span></label>
                            <input type="datetime-local" name="heure_date" id="heure_date" required
                                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400"
                                value="{{ old('heure_date', $rendezVous->heure_date) }}" />
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

                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Commentaire') }}</label>
                            <textarea name="commentaire" rows="3"
                                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400">{{ old('commentaire', $rendezVous->commentaire) }}</textarea>
                        </div>

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
</body
