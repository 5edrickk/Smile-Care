<x-header/>
<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-full min-h-[80vh]">
        <x-article/>
        <div class="pl-25 pr-25 pt-2 pb-2
                    min-h-[70%] w-[80%]
                    flex justify-center">

            @if (auth()->user()->id_role === 1 || auth()->user()->id_role === 3 || auth()->user()->id_role === 4)
                <form action="{{ route('utilisateurAdd') }}" method="POST" class="w-[60%] space-y-2 px-4 py-4 shadow-2xl">
                    @csrf
                    @method('POST')

                    <div class="flex">
                        <div class="flex flex-col justify-center w-[50%]">
                            <label class="block text-sm font-medium text-gray-700">Prénom : </label>
                            <input type="text" name="prenom" id="prenom">
                        </div>
                        <div class="flex flex-col justify-center w-[50%]">
                            <label class="block text-sm font-medium text-gray-700">Nom : </label>
                            <input type="text" name="name" id="name">
                        </div>
                    </div>

                    <div class="flex flex-col justify-center">
                        <label class="block text-sm font-medium text-gray-700">Role : </label>
                        <select name="id_role" id="id_role" required>
                            @foreach($roles as $role)
                                @if ($role->name !== "Admin" && $role->name !== "Employé" && $role->name !== "Receptionniste" && $role->name !== "Dentiste")
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @elseif (auth()->user()->id_role === 1)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date de naissance : </label>
                        <input type="date" name="dateNaissance" id="dateNaissance"
                            class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-cyan-400"
                            value="{{ now() }}" />
                    </div>

                    <div class="flex flex-col justify-center">
                        <label class="block text-sm font-medium text-gray-700">Adresse : </label>
                        <input type="text" name="addresse" id="addresse">
                    </div>

                    <div class="flex flex-col justify-center">
                        <label class="block text-sm font-medium text-gray-700">Téléphone : </label>
                        <input type="tel" name="telephone" id="telephone">
                    </div>

                    <div class="flex flex-col justify-center">
                        <label class="block text-sm font-medium text-gray-700">Email : </label>
                        <input type="text" name="email" id="email">
                    </div>

                    <div class="flex">
                        <div class="flex flex-col justify-center
                                    w-[50%]">
                            <label class="block text-sm font-medium text-gray-700">Créer le mot de passe : </label>
                            <input type="password" name="password" id="password">
                        </div>

                        <div class="flex flex-col justify-center
                                    w-[50%]">
                            <label class="block text-sm font-medium text-gray-700">Votre mot de passe : </label>
                            <input type="password" name="myPassword" id="myPassword">
                        </div>
                    </div>

                    <div class="flex justify-end align-middle">
                        <button type="submit" class="bg-green-100 border-[2px] border-green-500 rounded-lg
                                                    pl-2 pr-2 pt-1 pb-1 mr-2
                                                    w-[20%]">
                                                    Confirmer</button>
                        <button type="reset" class="bg-red-100 border-[2px] border-red-500 rounded-lg
                                                    pl-2 pr-2 pt-1 pb-1 ml-2
                                                    w-[20%]">
                                                    Annuler</button>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="w-[15%]
                                bg-red-100 border-t-[2px] border-l-[2px] border-r-[2px] border-red-500
                                mt-[-25px]
                                absolute bottom-0 right-0 p-4
                                rounded-t-lg
                                text-red-800">
                        <p>Veuillez corriger l'erreur ou les erreurs suivante(s) :</p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-400">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                <div class="w-[15%]
                            bg-green-100 border-t-[2px] border-l-[2px] border-r-[2px] border-green-500
                            mt-[-25px]
                            absolute bottom-0 right-0 p-4
                            rounded-t-lg
                            text-green-500">
                    @session('success')
                        <div class="alert alert-success">
                            {{ $value }}
                        </div>
                    @endsession
                </div>
                @endif
            @else
                <div class="w-[60%] space-y-2 px-4 py-4 shadow-2xl
                            flex flex-col justify-center items-center">
                    <h1 class="text-center text-[2rem]">HALTE !</h1>
                    <img src="{{ asset('img/stop.png') }}" alt="stop" class="h-[50%] w-[50%]">
                    <h1 class="text-center">Vous n'avez pas les permissions pour accéder à cette page !</h1>
                    <h2 class="text-center text-[#5c5c5c]">Cette page est reservé uniquement au administrateurs, au besoin d'accès à cette page, contacter un administrateur certifié de Smile Care.</h2>
                    <br>
                    <h2 class="text-center text-[#5c5c5c]">Merci de votre coopération.</h3>
                </div>
            @endif
        </div>
    </div>
</body>
