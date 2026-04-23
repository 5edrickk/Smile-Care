 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Liste des services') }}
        </h2>
    </x-slot>

    <div class="flex justify-center">
        <p>===X===</p>
        <p>___MOD___</p>
        <div class="w-[75%]">
            @foreach ($typesServices as $categorie)
                <div class="service bg-white rounded-lg m-5">
                    <div class="bg-[#00C8F8] rounded-lg font-semibold text-lg p-2">{{ $categorie->name }}</div>
                    <div class="p-3 hidden" id="servicesSecrets{{$categorie->id}}">
                        <p class="mb-3"><?php echo $categorie->description; ?></p>
                        @if ()

                        @endif
                        <p class="font-bold">Traitements et services:</p>
                            <?php $bool = 0?>
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
</x-app-layout>
