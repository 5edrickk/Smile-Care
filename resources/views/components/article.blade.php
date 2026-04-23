<div class="bg-[#006E8C]
            min-w-[20%]
            border-r-[2px] border-[#EBEBEB]">

            <!-- ADD ROUTES -->
    <div class="sticky top-[20vh]
                flex flex-col justify-center
                font-bold text-[#00C8F8]">

        @if(auth()->user() != null)
        <!-- ADMINISTRATEUR -->
            @if(auth()->user()->id_role === 1 || auth()->user()->id_role === 3)
                <!-- LES DENTISTES -->
                <a href="{{ route('utilisateurs', ['id_role' => 4]) }}">
                    @if(str_contains(url()->full(), '/utilisateurs/4'))
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1
                                    bg-[#C9F1FD] rounded-lg border-[4px] border-[#00A4D3]">
                            <x-heroicon-o-users class="h-[100%]"/>
                            <p>Les dentistes</p>
                        </div>
                    @else
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1">
                            <x-heroicon-o-users class="h-[100%]"/>
                            <p>Les dentistes</p>
                        </div>
                    @endif
                </a>

                <!-- LES CLIENTS -->
                <a href="{{ route('utilisateurs', ['id_role' => 5]) }}">
                    @if(str_contains(url()->full(), '/utilisateurs/5'))
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1
                                    bg-[#C9F1FD] rounded-lg border-[4px] border-[#00A4D3]">
                            <x-heroicon-o-user-group class="h-[100%]"/>
                            <p>Les clients</p>
                        </div>
                    @else
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1">
                            <x-heroicon-o-user-group class="h-[100%]"/>
                            <p>Les clients</p>
                        </div>
                    @endif
                </a>
            @endif

        <!-- DENTISTES -->
            @if(auth()->user()->id_role === 4)
                <!-- MES CLIENTS -->
                <a href="{{ route('utilisateurs', ['id_role' => 5]) }}">
                    @if(str_contains(url()->full(), '/utilisateurs/5'))
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1
                                    bg-[#C9F1FD] rounded-lg border-[4px] border-[#00A4D3]">
                            <x-heroicon-o-user-group class="h-[100%]"/>
                            <p>Mes clients</p>
                        </div>
                    @else
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1">
                            <x-heroicon-o-user-group class="h-[100%]"/>
                            <p>Mes clients</p>
                        </div>
                    @endif
                </a>
            @endif

            <!-- RENDEZ-VOUS -->
            <a href="{{ route('rendezvous') }}">
                @if(str_contains(url()->full(), '/rendezvous'))
                    <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1
                                bg-[#C9F1FD] rounded-lg border-[4px] border-[#00A4D3]">
                        <x-heroicon-o-calendar class="h-[100%]"/>
                        <p>Rendez-Vous</p>
                    </div>
                @else
                    <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1">
                        <x-heroicon-o-calendar class="h-[100%]"/>
                        <p>Rendez-Vous</p>
                    </div>
                @endif
            </a>

            @if(auth()->user()->id_role === 4 || auth()->user()->id_role === 1)
                <!-- TRAITEMENTS ET SERVICES -->
                <!-- METTRE LES HIGHLIGHTS QUAND LA PAGE DES TRAITEMENTS ET SERVICES SERA FAIT -->
                <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1">
                    <x-heroicon-o-clipboard-document-list class="h-[100%]"/>
                    <p class="text-right">Traitements & Services</p>
                </div>
            @endif

            <!-- PAIEMENTS -->
            @if(auth()->user()->id_role === 3)
                <!-- A CHANGER LA ROUTE -->
                <a href="{{ route('rendezvous') }}">
                    @if(str_contains(url()->full(), '/paiements'))
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1
                                    bg-[#C9F1FD] rounded-lg border-[4px] border-[#00A4D3]">
                            <x-heroicon-o-banknotes class="h-[100%]"/>
                            <p>Paiements</p>
                        </div>
                    @else
                        <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1">
                            <x-heroicon-o-banknotes class="h-[100%]"/>
                            <p>Paiements</p>
                        </div>
                    @endif
                </a>
            @endif

        <!-- GLOBALE -->
            <!-- QUARTS DE TRAVAIL -->
            <!-- METTRE LES HIGHLIGHTS QUAND LA PAGE DES QUARTS DE TRAVAIL SERA FAIT -->
            <div class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[85%] m-[auto] p-1">
                <x-heroicon-o-calendar-date-range class="h-[100%]"/>
                <p>Quarts de travail</p>
            </div>
        @endif
    </div>
</div>
