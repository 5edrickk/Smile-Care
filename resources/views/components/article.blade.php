<div class="min-w-[20%] border-r-2 border-[#EBEBEB] bg-[#006E8C]">

    <!-- ADD ROUTES -->
    <div class="sticky top-[20vh] flex flex-col justify-center font-bold text-[#00C8F8]">

        @if (auth()->user() != null)
            <!-- ADMINISTRATEUR -->
            @if (auth()->user()->id_role === 1 || auth()->user()->id_role === 3)
                <!-- LES EMPLOYÉS -->
                <a href="{{ route('utilisateurs', ['id_role' => 2, 'num_page' => 0]) }}">
                    @if (str_contains(url()->full(), '/utilisateurs/2'))
                        <div
                            class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between rounded-lg border-4 border-[#00A4D3] bg-[#C9F1FD] p-1">
                            <x-heroicon-o-users class="h-full" />
                            <p>{{ __('Les employés') }}</p>
                        </div>
                    @else
                        <div class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between p-1">
                            <x-heroicon-o-users class="h-full" />
                            <p>{{ __('Les employés') }}</p>
                        </div>
                    @endif
                </a>

                <!-- LES CLIENTS -->
                <a href="{{ route('utilisateurs', ['id_role' => 5, 'num_page' => 0]) }}">
                    @if (str_contains(url()->full(), '/utilisateurs/5'))
                        <div
                            class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between rounded-lg border-4 border-[#00A4D3] bg-[#C9F1FD] p-1">
                            <x-heroicon-o-user-group class="h-full" />
                            <p>{{ __('Les clients') }}</p>
                        </div>
                    @else
                        <div class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between p-1">
                            <x-heroicon-o-user-group class="h-full" />
                            <p>{{ __('Les clients') }}</p>
                        </div>
                    @endif
                </a>
            @endif

            <!-- DENTISTES -->
            @if (auth()->user()->id_role === 4)
                <!-- MES CLIENTS -->
                <a href="{{ route('utilisateurs', ['id_role' => 5, 'num_page' => 0]) }}">
                    @if (str_contains(url()->full(), '/utilisateurs/5'))
                        <div
                            class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between rounded-lg border-4 border-[#00A4D3] bg-[#C9F1FD] p-1">
                            <x-heroicon-o-user-group class="h-full" />
                            <p>{{ __('Mes clients') }}</p>
                        </div>
                    @else
                        <div class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between p-1">
                            <x-heroicon-o-user-group class="h-full" />
                            <p>{{ __('Mes clients') }}</p>
                        </div>
                    @endif
                </a>
            @endif

            <!-- RENDEZ-VOUS -->
            <a href="{{ route('rendezvous') }}">
                @if (str_contains(url()->full(), '/rendezvous'))
                    <div
                        class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between rounded-lg border-4 border-[#00A4D3] bg-[#C9F1FD] p-1">
                        <x-heroicon-o-calendar class="h-full" />
                        <p>{{ __('Rendez-Vous') }}</p>
                    </div>
                @else
                    <div class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between p-1">
                        <x-heroicon-o-calendar class="h-full" />
                        <p>{{ __('Rendez-Vous') }}</p>
                    </div>
                @endif
            </a>

            @if (auth()->user()->id_role === 4 || auth()->user()->id_role === 1)
                <!-- TRAITEMENTS ET SERVICES -->
                <a href="{{ route('services') }}">
                    @if (str_contains(url()->full(), '/services'))
                        <div
                            class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between rounded-lg border-4 border-[#00A4D3] bg-[#C9F1FD] p-1">
                            <x-heroicon-o-clipboard-document-list class="h-full" />
                            <p class="text-right">{{ __('Traitements & Services') }}</p>
                        </div>
                    @else
                        <div class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between p-1">
                            <x-heroicon-o-clipboard-document-list class="h-full" />
                            <p class="text-right">{{ __('Traitements & Services') }}</p>
                        </div>
                    @endif
                </a>
            @endif

            <!-- PAIEMENTS -->
            @if (auth()->user()->id_role === 3)
                <!-- A CHANGER LA ROUTE -->
                <a href="{{ route('paiements.index') }}">
                    @if (str_contains(url()->full(), '/paiements'))
                        <div
                            class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between rounded-lg border-4 border-[#00A4D3] bg-[#C9F1FD] p-1">
                            <x-heroicon-o-banknotes class="h-full" />
                            <p>{{ __('Paiements') }}</p>
                        </div>
                    @else
                        <div class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between p-1">
                            <x-heroicon-o-banknotes class="h-full" />
                            <p>{{ __('Paiements') }}</p>
                        </div>
                    @endif
                </a>
            @endif

            <!-- GLOBALE -->
            <!-- QUARTS DE TRAVAIL -->
            <a href="{{ route('shifts') }}">
                @if (str_contains(url()->full(), '/shifts'))
                    <div
                        class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between rounded-lg border-4 border-[#00A4D3] bg-[#C9F1FD] p-1">
                        <x-heroicon-o-calendar-date-range class="h-full" />
                        <p>{{ __('Quarts de travail') }}</p>
                    </div>
                @else
                    <div class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between p-1">
                        <x-heroicon-o-calendar-date-range class="h-full" />
                        <p>{{ __('Quarts de travail') }}</p>
                    </div>
                @endif
            </a>
        @endif

        <a href="http://localhost/logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="m-auto mb-4 mt-4 flex h-[55px] w-[85%] items-center justify-between rounded-lg border-4 border-transparent bg-none p-1 text-red-500 hover:border-red-500 hover:bg-red-100">
                    <x-heroicon-o-home class="h-full" />
                    <p>{{ __('Déconnexion') }}</p>
                </button>
            </form>
        </a>
    </div>
</div>
