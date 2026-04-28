<div class="bg-[#006E8C]
            min-w-[20%]
            border-r-2 border-[#EBEBEB]">

            <!-- ADD ROUTES -->
    <div class="sticky top-[20vh]
                flex flex-col justify-center
                font-bold text-[#00C8F8]">

        @if(auth()->user() != null)
        <!-- ADMINISTRATEUR -->
            @if(auth()->user()->id_role === 1 || auth()->user()->id_role === 3)
                <!-- LES EMPLOYÉS -->
                <a href="{{ route('utilisateurs', ['id_role' => 2, 'num_page' => 0]) }}">
                    @if(str_contains(url()->full(), '/utilisateurs/2'))
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-auto p-1
                                    bg-[#C9F1FD] rounded-lg border-4 border-[#00A4D3]">
                            <x-heroicon-o-users class="h-full"/>
                            <p>Les employés</p>
                        </div>
                    @else
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-auto p-1">
                            <x-heroicon-o-users class="h-full"/>
                            <p>Les employés</p>
                        </div>
                    @endif
                </a>

                <!-- LES CLIENTS -->
                <a href="{{ route('utilisateurs', ['id_role' => 5, 'num_page' => 0]) }}">
                    @if(str_contains(url()->full(), '/utilisateurs/5'))
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-auto p-1
                                    bg-[#C9F1FD] rounded-lg border-4 border-[#00A4D3]">
                            <x-heroicon-o-user-group class="h-full"/>
                            <p>Les clients</p>
                        </div>
                    @else
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-auto p-1">
                            <x-heroicon-o-user-group class="h-full"/>
                            <p>Les clients</p>
                        </div>
                    @endif
                </a>
            @endif

        <!-- DENTISTES -->
            @if(auth()->user()->id_role === 4)
                <!-- MES CLIENTS -->
                <a href="{{ route('utilisateurs', ['id_role' => 5, 'num_page' => 0]) }}">
                    @if(str_contains(url()->full(), '/utilisateurs/5'))
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-auto p-1
                                    bg-[#C9F1FD] rounded-lg border-4 border-[#00A4D3]">
                            <x-heroicon-o-user-group class="h-full"/>
                            <p>Mes clients</p>
                        </div>
                    @else
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-auto p-1">
                            <x-heroicon-o-user-group class="h-full"/>
                            <p>Mes clients</p>
                        </div>
                    @endif
                </a>
            @endif

            <!-- RENDEZ-VOUS -->
            <a href="{{ route('rendezvous') }}">
                @if(str_contains(url()->full(), '/rendezvous'))
                    <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-auto p-1
                                bg-[#C9F1FD] rounded-lg border-4 border-[#00A4D3]">
                        <x-heroicon-o-calendar class="h-full"/>
                        <p>Rendez-Vous</p>
                    </div>
                @else
                    <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-auto p-1">
                        <x-heroicon-o-calendar class="h-full"/>
                        <p>Rendez-Vous</p>
                    </div>
                @endif
            </a>

            @if(auth()->user()->id_role === 4 || auth()->user()->id_role === 1)
                <!-- TRAITEMENTS ET SERVICES -->
                <a href="{{ route('services') }}">
                    @if(str_contains(url()->full(), '/services'))
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-auto p-1
                                    bg-[#C9F1FD] rounded-lg border-4 border-[#00A4D3]">
                    <x-heroicon-o-clipboard-document-list class="h-full"/>
                    <p class="text-right">Traitements & Services</p>
                        </div>
                    @else
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-auto p-1">
                    <x-heroicon-o-clipboard-document-list class="h-full"/>
                    <p class="text-right">Traitements & Services</p>
                        </div>
                    @endif
                </a>
            @endif

            <!-- PAIEMENTS -->
            @if(auth()->user()->id_role === 3)
                <!-- A CHANGER LA ROUTE -->
                <a href="{{ route('rendezvous') }}">
                    @if(str_contains(url()->full(), '/paiements'))
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-auto p-1
                                    bg-[#C9F1FD] rounded-lg border-4 border-[#00A4D3]">
                            <x-heroicon-o-banknotes class="h-full"/>
                            <p>Paiements</p>
                        </div>
                    @else
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-auto p-1">
                            <x-heroicon-o-banknotes class="h-full"/>
                            <p>Paiements</p>
                        </div>
                    @endif
                </a>
            @endif

        <!-- GLOBALE -->
            <!-- QUARTS DE TRAVAIL -->
            <!-- METTRE LES HIGHLIGHTS QUAND LA PAGE DES QUARTS DE TRAVAIL SERA FAIT -->
                <a href="{{ route('shifts') }}">
                    @if(str_contains(url()->full(), '/shifts/'))
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-auto p-1
                                    bg-[#C9F1FD] rounded-lg border-4 border-[#00A4D3]">
                            <x-heroicon-o-calendar-date-range class="h-full"/>
                            <p>Quarts de travail</p>
                        </div>
                    @else
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-auto p-1">
                            <x-heroicon-o-calendar-date-range class="h-full"/>
                            <p>Quarts de travail</p>
                        </div>
                    @endif
                </a>
        @endif
    </div>
</div>
