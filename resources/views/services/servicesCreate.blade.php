<x-header/>
<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-full min-h-[80vh]">
        <x-article/>

        <div class="min-h-[70%] w-[80%] flex justify-center flex-col">
            <form action="{{ route('services.store') }}" method="POST" class="flex flex-col">
                @csrf
                    <input type="text" name="service_name" id="service_name" placeholder="Nom du service" required>

                    <input type="text" name="service_description" id="service_description" placeholder="Description">

                    <select type="text" name="service_categorie" id="service_categorie" required>
                        @foreach ($id_type as $categorie)
                            <option value={{ $categorie->id }}>
                                {{ old('id_type') == $categorie->id ? 'selected' : '' }}{{ $categorie->name }}
                            </option>
                        @endforeach
                    </select>

                    <input type="number" name="service_duree" id="service_duree" placeholder="Durée">

                    <button type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
</body>
