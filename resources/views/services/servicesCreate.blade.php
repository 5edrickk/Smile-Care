<x-app-layout>
    <div class="flex justify-center">
        <div class="w-[75%]">
            <form action="{{ route('services.store') }}" method="" class="flex flex-col">
                    <input type="text" name="service_name" id="service_name" placeholder="Nom du service" required>

                    <input type="text" name="service_description" id="service_description" placeholder="Description">

                    <select type="text" name="service_categorie" id="service_categorie" required>
                        @foreach ($id_type as $categorie)
                            <option value={{ $categorie->name }}>{{ $categorie->name }}</option>
                        @endforeach
                    </select>

                    <input type="text" name="service_duree" id="service_duree" placeholder="Durée">

                    <button type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
</x-app-layout>
