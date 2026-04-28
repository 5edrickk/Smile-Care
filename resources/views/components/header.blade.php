@vite(['resources/css/app.css', 'resources/js/app.js'])
@use('App\Models\Roles', 'Roles')
@use('Illuminate\Support\Facades\File', 'File')
<div class="sticky top-0 flex h-[20vh] min-w-full bg-gradient-to-t from-[#009CCF] to-[#B0EEFF] p-0 font-bold text-white">

    <!-- Panneau des Dentistes/Administrateurs -->
    <div
        class="flex h-full min-h-full min-w-[20%] flex-col items-center justify-center border-r-[2px] border-[#EBEBEB] text-[1.5rem]">
        @if (auth()->user() != null)
            <p>Panneau</p>
            <p>{{ Str::lower(Roles::where('id', '=', auth()->user()->id_role)->value('name')) }} </p>
        @endif
    </div>

    <!-- [Logo] SmileCare -->
    <div class="justify-left flex min-w-[50%] items-center">
        <img src="{{ asset('img/logo.png') }}" class="ml-[25px] max-h-[95%] max-w-[15%]" alt="Logo">
        <p class="text-[3rem]">Smile Care</p>
    </div>

    <!-- Bienvenu _______ -->
    <div class="flex min-w-[30%] items-center text-right">
        <div class="min-w-[75%]">
            @if (auth()->user() != null)
                <p>Bienvenu, {{ auth()->user()->prenom . ' ' . auth()->user()->name }} !</p>
                <p class="text-[#D6D6D6]">{{ Roles::where('id', '=', auth()->user()->id_role)->value('name') }}</p>
            @else
                <p>Vous n'êtes pas connecté !</p>
            @endif
        </div>
        @if (auth()->user() != null)
            @if (File::exists(public_path('img/UsersImages/' . auth()->user()->photo)))
                <img src="{{ asset('img/userIcon.png') }}" class="ml-6 w-[15%] rounded-[100px]" alt="Logo">
            @else
                <img src="{{ asset('img/UsersImages/' . auth()->user()->photo) }}" class="ml-6 w-[15%] rounded-[100px]"
                    alt="Logo">
            @endif
        @endif
    </div>
</div>
