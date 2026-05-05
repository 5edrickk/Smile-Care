@vite(['resources/js/services-validation.js'])
<x-header/>

<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-full min-h-[80vh]">
        <x-article/>

        <div class="min-h-[70%] w-[80%] flex justify-center flex-col">
            <div class="overflow-hidden rounded-lg bg-white shadow-md m-auto w-[50%]">
                <div class="bg-cyan-500 px-6 py-5 text-white font-bold">
                    Ajouter un service
                </div>
                <form action="{{ route('services.store') }}" method="POST" id="form-services" class="space-y-4 px-6 py-6 shadow-2xl">
                    @csrf
                    <label for="sname" class="text-sm font-medium">Nom du service<span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="service_name"
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400">
                    <p id="erreur-service_name" class="hidden text-red-700 text-sm"></p>

                    <label for="categorie" class="text-sm font-medium">Catégorie<span class="text-red-500">*</span></label>
                    <select type="text" name="categorie" id="service_categorie"
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400">
                        @foreach ($id_type as $categorie)
                            <option value={{ $categorie->id }}>
                                {{ old('id_type') == $categorie->id ? 'selected' : '' }}{{ $categorie->name }}
                            </option>
                        @endforeach
                    </select>
                    <p id="erreur-service_categorie" class="hidden text-red-700 text-sm"></p>

                    <label for="duree" class="text-sm font-medium">Durée<span class="text-red-500">*</span></label>
                    <input type="text" name="duree" id="service_duree"
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400">
                    <p id="erreur-service_duree" class="hidden text-red-700 text-sm"></p>

                    <label for="description" class="text-sm font-medium">Description</label>
                    <textarea type="text" name="description" id="service_description"
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400"></textarea>
                    <p id="erreur-service_description" class="hidden text-red-700 text-sm m-0"></p>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <a href="{{ route('services') }}"
                            class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            Annuler
                        </a>
                        <button type="submit"
                            class="rounded-lg bg-cyan-500 px-4 py-2 text-sm font-semibold text-white hover:bg-cyan-600">
                            Enregistrer
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

<x-footer/>
