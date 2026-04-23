 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Liste des services') }}
        </h2>
    </x-slot>

    <div >
                    @foreach ($typesServices as $categorie)
                        <div>
                            <p class="font-semibold text-lg">{{ $categorie->name }}
                                <a class="service font-normal text-base text-sky-700 underline" href="">
                                {{ __('V') }}</a>
                            </p>
                            <div>
                                <?php $categorie->id ?>
                            </div>
                        </div>

                    @endforeach
    </div>
</x-app-layout>
