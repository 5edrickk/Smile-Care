<x-header/>
<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-full min-h-[80vh]">
        <x-article/>

        <div class="min-h-[70%] w-[80%] flex justify-center flex-col">
            <div>
                <p>===X===</p>
                <a href="{{ route('services.create') }}" class="bg-white-500 p-5">Ajouter service</a>
                <p>___MOD___</p>
            </div>

            <div class="w-[75%] m-auto">
                @foreach ($typesServices as $categorie)
                    <div class="service bg-white rounded-lg m-5">
                        <div class="bg-[#00C8F8] rounded-lg font-semibold text-lg p-2">{{ $categorie->name }}</div>
                        <div class="p-3 hidden" id="servicesSecrets{{$categorie->id}}">
                            <p class="mb-3"><?php echo $categorie->description; ?></p>
                            <p class="font-bold">Traitements et services:</p>
                            @foreach ($services as $service)
                                @if ($service->id_type == $categorie->id )
                                    <p class="pl-3 m-1">🦷 {{ $service->name }}</p>
                                @endif

                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
