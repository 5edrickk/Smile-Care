@vite(['resources/css/app.css', 'resources/js/app.js'])
@use('Illuminate\Support\Facades\File', 'File')

@if (auth()->user() === null)
    <script>
        window.location = "{{ route('login') }}";
    </script>
@endif

<div class="bg-linear-to-t sticky top-0 flex h-[20vh] min-w-full from-[#009CCF] to-[#B0EEFF] p-0 font-bold text-white">

    <!-- Panneau des Dentistes/Administrateurs -->
    <div
        class="flex h-full min-h-full min-w-[20%] flex-col items-center justify-center border-r-2 border-[#EBEBEB] text-[1.5rem]">
        @if (auth()->user() != null)
            <p>{{ __('Panneau') }}</p>
            <p>{{ auth()->user()->role->name }} </p>
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
                <p>{{ __('Bienvenu') }}, {{ auth()->user()->prenom . ' ' . auth()->user()->name }} !</p>
                <p class="text-[#D6D6D6]">{{ auth()->user()->role->name }}</p>
            @else
                <p>{{ __("Vous n'êtes pas connecté !") }}</p>
            @endif
        </div>
        @if (auth()->user() != null)
            @if (File::exists(public_path('img/UsersImages/' . auth()->user()->photo)))
                <a href="{{ route('profile.edit') }}" class="ml-6 w-[15%] rounded-[100px]" alt="Logo"><img
                        src="{{ asset('img/userIcon.png') }}"></a>
            @else
                <a href="{{ route('profile.edit') }}" class="ml-6 w-[15%] rounded-[100px]"><img
                        src="{{ asset('img/UsersImages/' . auth()->user()->photo) }}" alt="Logo"></a>
            @endif
        @endif
    </div>
</div>
