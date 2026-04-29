<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Liste des services') }}
        </h2>
    </x-slot>

    <div class="flex justify-center">
        <div class="w-[75%]">
                    <h2>{{ $typeService->name }}</h2>
                    <div class="p-3 hidden" id="servicesSecrets{{$typeService->id}}">
                        <p class="mb-3"><?php echo $typeService->description; ?></p>
                        <p class="font-bold">Traitements et services:</p>
                            <?php $bool = 0?>
                            @foreach ($services as $service)

                                    <p class="pl-3 m-1">● {{ $service->name }}</p>


                            @endforeach
                    </div>
        </div>
    </div>
</x-app-layout>

<x-footer/>
