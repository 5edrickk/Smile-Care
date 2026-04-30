<x-header/>
<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-full min-h-[80vh]">
        <x-article/>
        <div class="py-8 w-[80%]">
            <div class="mx-auto w-[100%] h-[100%] px-4 sm:px-6 lg:px-8">
                <div>
                    <a href="{{ route('services.create') }}" class="fixed bottom-10 right-3 w-35 rounded-lg hover:border bg-white px-4 py-2.5 text-sm text-bluepain shadow-sm font-bold">Ajouter service</a>
                </div>

                <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 max-h-[80vh]">
                @foreach ($typesServices as $categorie)
                    <div class="hover:border service bg-white rounded-lg m-5 shadow-md">
                        <div class="bg-bluepain rounded-lg font-semibold text-lg p-2 text-white">{{ $categorie->name }}</div>
                        <div class="p-3 hidden" id="servicesSecrets{{$categorie->id}}">
                            <p class="mb-3"><?php echo $categorie->description; ?></p>
                            <p class="font-bold">Traitements et services:</p>
                            @foreach ($services as $service)
                                @if ($service->id_type == $categorie->id )
                                    <p class="pl-3 m-1 flex">🦷
                                        <a href="{{ route('services.show', $service->id) }}" class="mx-1">{{ $service->name }}</a>
                                    </p>
                                @endif

                            @endforeach
                        </div>
                    </div>
                @endforeach
                </div>

            </div>
        </div>
    </div>
</body>

<x-footer/>
