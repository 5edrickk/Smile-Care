@use('Carbon\Carbon', 'Carbon')
@use('Illuminate\Support\Number', 'Number')
<x-header/>
<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-[100%] min-h-[80vh]">
        <x-article/>
        <div class="pl-25 pr-25 pt-6 pb-6
                    grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-6 p-10
                    min-h-[70%] w-[80%]">
            <!-- HERE TO FILTER IF USER SHOULD SEE THESE USERS -->
            @foreach($users as $user)
                <div class="min-w-[33%] h-[300px]
                            bg-[#FFFFFF]
                            ml-2 mr-2
                            rounded-[15px] border-[2px] shadow-xs">
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
                                <x-heroicon-o-pencil-square class="w-[12%] mr-2 ml-2 text-[#006E8C] hover:text-[#C9F1FD]"/>
                                <a href="{{ route('utilisateurDelete', $user->id) }}" class="w-[12%] mr-2 ml-2">
                                    <x-heroicon-o-trash class="text-red-500 hover:text-[#FDC9C9]"/>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="w-[100%] h-[66%]
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
                            @if($user->id_role === 5)
                                <p><strong>Prochain traitement : </strong><br>Traitement</p>
                                <p><strong>Date du prochain traitement : </strong><br>Traitement date</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
