<x-header/>
<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-full min-h-[80vh]">
        <x-article/>

        <div class="h-[100vh] min-h-[70%] w-[80%] flex justify-center flex-col">
            <div>
                <a href="{{ route('services.create') }}" class="fixed w-35 rounded-lg border border-bluepain bg-white px-4 py-2.5 text-sm text-bluepain shadow-sm font-bold">Ajouter service</a>
            </div>

            <div class="w-[75%] m-auto">
                @foreach ($typesServices as $categorie)
                    <div class="service bg-white rounded-lg m-5 shadow-md">
                        <div class="bg-bluepain rounded-lg font-semibold text-lg p-2 text-white">{{ $categorie->name }}</div>
                        <div class="p-3 hidden" id="servicesSecrets{{$categorie->id}}">
                            <p class="mb-3"><?php echo $categorie->description; ?></p>
                            <p class="font-bold">Traitements et services:</p>
                            @foreach ($services as $service)
                                @if ($service->id_type == $categorie->id )
                                    <p class="pl-3 m-1 flex">🦷 {{ $service->name }}
                                        <a href="{{ route('services.edit', ['id' => $service->id])}}" class="w-[2.5%] mx-2 flex justify-center align-middle">
                                            <svg class="text-bluepain hover:text-hospitalfashion" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path></svg>
                                        </a>
                                    </p>
                                @endif

                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

<x-footer/>
