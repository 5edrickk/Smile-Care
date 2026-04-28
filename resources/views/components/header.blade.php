@vite(['resources/css/app.css', 'resources/js/app.js'])
@use('App\Models\Roles', 'Roles')
@use('Illuminate\Support\Facades\File', 'File')

@if (auth()->user() === null)
    <script>window.location = "{{ route('login') }}";</script>
@endif

<div class="sticky top-0 min-w-full h-[20vh]
            bg-linear-to-t from-[#009CCF] to-[#B0EEFF]
            flex
            text-white font-bold
            p-0">

    <!-- Panneau des Dentistes/Administrateurs -->
    <div class="min-w-[20%] min-h-full
                text-[1.5rem]
                h-full
                border-r-2 border-[#EBEBEB]
                flex flex-col items-center justify-center">
        @if(auth()->user() != null)
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
                <a href="{{ route('profile.edit') }}" class="ml-6 w-[15%] rounded-[100px]" alt="Logo"><img src="{{ asset('img/userIcon.png') }}"></a>
            @else
                <a href="{{ route('profile.edit') }}" class="ml-6 w-[15%] rounded-[100px]"><img src="{{ asset('img/UsersImages/' . auth()->user()->photo) }}"
                    alt="Logo"></a>
            @endif
        @endif
    </div>
</div>
