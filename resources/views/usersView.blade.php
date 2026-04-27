@use('Carbon\Carbon', 'Carbon')
@use('Illuminate\Support\Number', 'Number')
<x-header/>
<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-full min-h-[80vh]">
        <x-article/>

        <div class="min-h-[70%] w-[80%]">
            @if($max_pages > 0)
                <!-- SEARCHBAR -->
                <form action="{{ route('utilisateursSearch', ['id_role' => $id_role, 'num_page' => $num_page]) }}" method="POST"
                        class="mb-6 flex justify-center gap-2
                            min-h-[2%]
                            mt-8">
                    @csrf
                    <div class="flex flex-row justify-center align-middle
                                w-[75%]">
                        <input placeholder="Chercher par nom..." name="searchNom" id="searchNom"
                            class="w-full rounded-l-lg border border-gray-500 bg-white px-3 py-2.5 text-lg">
                        <input placeholder="Chercher par prénom..." name="searchPrenom" id="searchPrenom"
                            class="w-full rounded-r-lg border border-gray-500 bg-white px-3 py-2.5 text-lg">
                    </div>

                    <button type="submit"
                        class="w-25 rounded-lg border border-gray-500 bg-white px-4 py-2.5 text-sm shadow-sm hover:bg-gray-50">
                        Rechercher
                    </button>
                </form>
            @endif

            <div class="pl-25 pr-25 pt-6 pb-6
                        grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-6 p-10
                        min-h-[75%] w-[100%]">

                @foreach($users as $user)
                    <div class="min-w-[33%] h-[300px]
                                bg-[#FFFFFF]
                                ml-2 mr-2
                                rounded-[15px] border-2 shadow-xs">
                        <div class="bg-[#00C8F8]
                            rounded-t-[15px]
                            p-4
                            text-lg font-bold
                            shadow-xs
                            flex justify-between">
                            <div class="w-[50%]">
                                {{ $user->name . ' ' . $user->prenom }}
                                <br>
                                {{ Number::format(Carbon::parse($user->dateNaissance)->diffInYears(now()), precision:0) . ' ans'}}
                            </div>
                            <div class="w-[50%]
                                        flex justify-end">
                                @if(auth()->user()->id_role === 1)
                                    <a href="{{ route('utilisateurForm', $user->id) }}" class="w-[12%] mr-2 ml-2 flex justify-center align-middle">
                                        <x-heroicon-o-pencil-square class="text-[#006E8C] hover:text-[#C9F1FD]"/>
                                    </a>
                                    <a href="{{ route('utilisateurDelete', $user->id) }}" class="w-[12%] mr-2 ml-2 flex justify-center align-middle">
                                        <x-heroicon-o-trash class="text-red-500 hover:text-[#FDC9C9]"/>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="w-full h-[66%]
                                    flex">
                            <div class="w-[35%]
                                        flex items-center">
                                @if(File::exists(public_path('img/UsersImages/' . $user->photo)))
                                    <img src="{{ asset('img/userIcon.png') }}" class="w-full p-3 rounded-[100px]" alt="Logo">
                                @else
                                    <img src="{{ asset('img/UsersImages/' . $user->photo) }}" class="w-full p-3 rounded-[100px]" alt="Logo">
                                @endif
                            </div>
                            <div class="w-[65%]
                                        flex flex-col justify-center">
                                <p><strong>Téléphone : </strong> {{ " " . $user->telephone }}</p>
                                <p><strong>Addresse : </strong> {{ " " . $user->addresse }}</p>

                                {{-- @if(str_contains(url()->full(), '/utilisateurs/5'))
                                    @if($user->id_role === 5 && (auth()->user()->id_role === 1 || auth()->user()->id_role === 4))
                                        <p><strong>Prochain traitement : </strong><br>{{ $service->name }}</p>
                                        <p><strong>Date du prochain traitement : </strong><br>{{ $traitement->heure_date }}</p>
                                    @endif
                                @endif --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

@if($max_pages > 0)
    <!-- PAGE PRÉCÉDENTE/SUIVANT -->
    <div class="sticky bottom-5
                flex justify-center align-middle
                h-[3%]
                mt-[-30px] ml-[20%]">

        @if($num_page > 0)
            <a href="{{ route('utilisateurs', ['id_role' => $id_role, 'num_page' => ($num_page - 1)]) }}"
                class="h-[100%] w-[2%]">
                <x-heroicon-o-backward class="text-blue-500 fill-blue-500
                                                hover:text-blue-200 hover:fill-blue-200
                                                font-bold"/>
            </a>
        @else
            <x-heroicon-o-backward class="text-[#9e9e9e] fill-[#9e9e9e]
                                    font-bold"/>
        @endif

        <span class="flex items-center justify-center m-2">
            <p class="text-blue-500 font-bold">{{ $num_page }} / {{ $max_pages }}</p>
        </span>

        @if($num_page < $max_pages)
            <a href="{{ route('utilisateurs', ['id_role' => $id_role, 'num_page' => ($num_page + 1)]) }}"
                class="h-[100%] w-[2%]">
                <x-heroicon-o-forward class="text-blue-500 fill-blue-500
                                                hover:text-blue-200 hover:fill-blue-200
                                                font-bold"/>
            </a>
        @else
            <x-heroicon-o-forward class="text-[#9e9e9e] fill-[#9e9e9e]
                                    font-bold"/>
        @endif
    </div>
@endif

<!-- BOUTON ADD -->
<a href="{{ route('utilisateurForm', -1) }}" class="w-[15%]
                bg-green-100 border-t-[2px] border-l-[2px] border-r-[2px] border-green-500
                mt-[-50px]
                sticky bottom-0 left-[100%] p-4
                rounded-t-lg
                text-green-500
                flex justify-center align-middle">
    <p>Ajouter un utilisateur</p>
</a>
