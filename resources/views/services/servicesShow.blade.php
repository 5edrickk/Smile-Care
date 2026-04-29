<x-header/>
<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-full min-h-[80vh]">
        <x-article/>
        <div class="py-8 w-[80%]">
            <div class="flex flex-col justify-center mx-auto w-[100%] h-[100%] px-4 sm:px-6 lg:px-8">
                    <div class="w-[80%] bg-white rounded-lg mx-auto shadow-md">
                        <div class="flex justify-between bg-bluepain rounded-lg font-semibold text-lg p-2 text-white">
                            <span>
                                {{ $service->name }}
                            </span>
                            <span class="flex justify-end-safe w-[20%]">
                                <a href="{{ route('services.edit', ['id' => $service->id])}}" class="w-[15%] ml-5 flex justify-center align-middle">
                                <svg class="text-white hover:text-hospitalfashion" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path></svg>
                                </a>
                                <a href="{{ route('services.destroy', $service->id) }}" class="w-[15%] mx-2 flex justify-center align-middle">
                                    <x-heroicon-o-trash class="text-red-500 hover:text-[#FDC9C9]"/>
                                </a>
                            </span>
                        </div>
                        <p class="pl-3 m-1 flex">Catégorie: {{ $categorie->name }}</p>
                        <p class="pl-3 m-1 flex">Durée: {{ $service->duree }}h</p>
                        <p class="pb-3 pl-3 m-1 flex">Description: {{ $service->description }}</p>
                    </div>
                    <a href="{{ route('services') }}"
                        class="m-2 mx-auto w-25 rounded-lg border border-gray-500 bg-white px-4 py-2.5 text-sm shadow-sm hover:bg-gray-50">
                        Retourner
                    </a>
            </div>
        </div>
    </div>
</body>
