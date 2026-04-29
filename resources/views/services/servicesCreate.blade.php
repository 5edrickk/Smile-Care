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
                <form action="{{ route('services.store') }}" method="POST" class="space-y-4 px-6 py-6 shadow-2xl">
                    @csrf
                    <label for="service_name" class="text-sm font-medium">Nom du service<span class="text-red-500">*</span></label>
                    <input type="text" name="service_name" id="service_name" required maxlength="255"
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400">

                    <label for="service_categorie" class="text-sm font-medium">Catégorie<span class="text-red-500">*</span></label>
                    <select type="text" name="service_categorie" id="service_categorie" required
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400">
                        @foreach ($id_type as $categorie)
                            <option value={{ $categorie->id }}>
                                {{ old('id_type') == $categorie->id ? 'selected' : '' }}{{ $categorie->name }}
                            </option>
                        @endforeach
                    </select>

                    <label for="service_duree" class="text-sm font-medium">Durée<span class="text-red-500">*</span></label>
                    <input type="number" name="service_duree" id="service_duree" required min="1"
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400">

                    <label for="service_description" class="text-sm font-medium">Description</label>
                    <textarea type="text" name="service_description" id="service_description" maxlength="255"
                        class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400"></textarea>

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
