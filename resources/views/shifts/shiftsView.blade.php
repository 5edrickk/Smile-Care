@use('Carbon\Carbon', 'Carbon')

<x-header/>
<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-full min-h-[80vh]">
        <x-article/>

        <div class="h-[70%] w-[80%]">

            <div class="p-6 w-[100%] h-[100%]">
                <div class="flex
                            w-[100%] h-[auto]">
                    @if (count($shifts) > 0)
                        @if ($shifts[0]->state === "exit")
                            <a href="{{ route('shiftPunch') }}" class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[30%] m-auto p-1
                                                                        bg-green-100 rounded-lg border-4 border-green-500 text-green-500">
                                <x-heroicon-o-arrow-right-end-on-rectangle class="h-full"/>
                                <p>Punch in</p>
                            </a>
                        @elseif ($shifts[0]->state === "enter")
                            <a href="{{ route('shiftPunch') }}" class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[30%] m-auto p-1
                                                                        bg-red-100 rounded-lg border-4 border-red-500 text-red-500">
                                    <x-heroicon-o-arrow-left-start-on-rectangle class="h-full"/>
                                    <p>Punch out</p>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('shiftPunch') }}" class="flex justify-between items-center mt-4 mb-4 h-[55px] w-[30%] m-auto p-1
                                                                    bg-green-100 rounded-lg border-4 border-green-500 text-green-500">
                            <x-heroicon-o-arrow-right-end-on-rectangle class="h-full"/>
                            <p>Punch in</p>
                        </a>
                    @endif
                </div>

                @for ($i = 0; $i < count($shifts); $i++)
                    @if ($shifts[$i]->state === "enter")
                        <div class="w-[100%] h-[50px]
                                    bg-green-100 rounded-lg border-4 border-green-500 text-green-500
                                    flex flex-col justify-center">
                            <p>{{ $shifts[$i]->heure_punch }} - {{ $shifts[$i]->state }}</p>
                        </div>
                    @elseif ($shifts[$i]->state === "exit")
                        <div class="w-[100%] h-[50px]
                                    bg-red-100 rounded-lg border-4 border-red-500 text-red-500
                                    flex flex-col justify-center">
                            <p>{{ $shifts[$i]->heure_punch }} - {{ $shifts[$i]->state }}</p>
                        </div>
                    @endif
                    @if ($i < count($shifts) - 1)
                        @if (Carbon::parse($shifts[$i]->heure_punch)->diffInDays(Carbon::parse($shifts[$i + 1]->heure_punch)) < -1)
                            <p class="w-[100%] h-[3px] mt-4 mb-4 shadow-xs"></p>
                        @endif
                    @endif
                @endfor
            </div>
        </div>
    </div>
</body>
