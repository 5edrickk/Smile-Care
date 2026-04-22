@vite(['resources/css/app.css', 'resources/js/app.js'])
@use('App\Models\Roles', 'Roles')
@use('Illuminate\Support\Facades\File', 'File')
<div class="sticky top-0 min-w-full h-[20vh]
            bg-gradient-to-t from-[#009CCF] to-[#B0EEFF]
            flex
            text-white font-bold
            p-0">

    <!-- Panneau des Dentistes/Administrateurs -->
    <div class="min-w-[20%] min-h-full
                text-[1.5rem]
                h-full
                border-r-[2px] border-[#EBEBEB]
                flex flex-col items-center justify-center">
        @if(auth()->user() != null)
            <p>Panneau</p>
            <p>{{ Str::lower(Roles::where('id', '=', auth()->user()->id_role)->value('name')) }} </p>
        @endif
    </div>

    <!-- [Logo] SmileCare -->
    <div class="min-w-[50%]
                flex items-center justify-left">
        <img src="{{ asset('img/logo.png') }}" class="max-w-[15%] max-h-[95%] ml-[25px]" alt="Logo">
        <p class="text-[3rem]">Smile Care</p>
    </div>

    <!-- Bienvenu _______ -->
    <div class="min-w-[30%]
                flex text-right items-center">
        <div class="min-w-[75%]">
            @if(auth()->user() != null)
                <p>Bienvenu, {{ auth()->user()->prenom . ' ' . auth()->user()->name }} !</p>
                <p class="text-[#D6D6D6]">{{ Roles::where('id', '=', auth()->user()->id_role)->value('name') }}</p>
            @else
                <p>Vous n'êtes pas connecté !</p>
            @endif
        </div>
        @if(auth()->user() != null)
            @if(File::exists(public_path('img/UsersImages/' . auth()->user()->photo)))
                <img src="{{ asset('img/userIcon.png') }}" class="w-[15%] ml-6 rounded-[100px]" alt="Logo">
            @else
                <img src="{{ asset('img/UsersImages/' . auth()->user()->photo) }}" class="w-[15%] ml-6 rounded-[100px]" alt="Logo">
            @endif
        @endif
    </div>
</div>
