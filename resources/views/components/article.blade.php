<div class="bg-[#006E8C]
            min-w-[20%]
            border-r-[2px] border-[#EBEBEB]">

            <!-- ADD ROUTES -->
    <div class="sticky top-[20vh]
                flex flex-col justify-center
                font-bold text-[#00C8F8]">

        @if(auth()->user() != null)
        <!-- ADMINISTRATEUR -->
            @if(auth()->user()->id_role === 1)
                <!-- LES DENTISTES -->
                @if(str_contains(url()->full(), '/utilisateurs/4'))
                    <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1
                                bg-[#C9F1FD] rounded-lg border-[4px] border-[#00A4D3]">
                        <img src="{{ asset('img/dent.png') }}" class="h-[100%]">
                        <p>Les dentistes</p>
                    </div>
                @else
                    <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1">
                        <img src="{{ asset('img/dent.png') }}" class="h-[100%]">
                        <p>Les dentistes</p>
                    </div>
                @endif

                @if(str_contains(url()->full(), '/utilisateurs/5'))
                    <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1
                                bg-[#C9F1FD] rounded-lg border-[4px] border-[#00A4D3]">
                        <img src="{{ asset('img/liste.png') }}" class="h-[100%]">
                        <p>Les clients</p>
                    </div>
                @else
                    <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1">
                        <img src="{{ asset('img/liste.png') }}" class="h-[100%]">
                        <p>Les clients</p>
                    </div>
                @endif
            @endif

        <!-- DENTISTES -->
            @if(auth()->user()->id_role === 4)
                <!-- MES CLIENTS -->
                @if(str_contains(url()->full(), '/utilisateurs/5'))
                    <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1
                                bg-[#C9F1FD] rounded-lg border-[4px] border-[#00A4D3]">
                        <img src="{{ asset('img/liste.png') }}" class="h-[100%]">
                        <p>Mes clients</p>
                    </div>
                @else
                    <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1">
                        <img src="{{ asset('img/liste.png') }}" class="h-[100%]">
                        <p>Mes clients</p>
                    </div>
                @endif
            @endif

            <!-- RENDEZ-VOUS -->
            <!-- METTRE LES HIGHLIGHTS QUAND LA PAGE DES RENDEZ-VOUS SERA FAIT -->
            <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1">
                <img src="{{ asset('img/rendez-vous-medical.png') }}" class="h-[100%]">
                <p>Rendez-vous</p>
            </div>

            @if(auth()->user()->id_role === 4 || auth()->user()->id_role === 1)
                <!-- TRAITEMENTS ET SERVICES -->
                <!-- METTRE LES HIGHLIGHTS QUAND LA PAGE DES TRAITEMENTS ET SERVICES SERA FAIT -->
                <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1">
                    <img src="{{ asset('img/listeClipBoard.png') }}" class="h-[100%]">
                    <p class="text-right">Traitements & Services</p>
                </div>
            @endif

        <!-- GLOBALE -->
            <!-- QUARTS DE TRAVAIL -->
            <!-- METTRE LES HIGHLIGHTS QUAND LA PAGE DES QUARTS DE TRAVAIL SERA FAIT -->
            <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1">
                <img src="{{ asset('img/quart.png') }}" class="h-[100%]">
                <p>Quarts de travail</p>
            </div>
        @endif
    </div>
</div>
