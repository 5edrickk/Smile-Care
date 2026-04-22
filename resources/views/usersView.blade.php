@use('Carbon\Carbon', 'Carbon')
@use('Illuminate\Support\Number', 'Number')
<x-header/>
<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-[100%] min-h-[80vh]">
        <x-article/>
        <div class="pl-25 pr-25 pt-6 pb-6
                    grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-6 p-10
                    min-h-[70%] min-w-[80%] max-w-[80%]">
            <!-- HERE TO FILTER IF USER SHOULD SEE THESE USERS -->
            @foreach($users as $user)
                <div class="min-w-[33%] h-[300px]
                            bg-[#FFFFFF]
                            ml-2 mr-2
                            rounded-[15px] border-[2px] shadow-xs">
                    <div class="bg-[#00C8F8]
                        rounded-t-[15px]
                        p-4
                        text-lg font-bold
                        shadow-xs">
                        {{ $user->prenom . ' ' . $user->name }}
                        <br>
                        {{ Number::format(Carbon::parse($user->dateNaissance)->diffInYears(now()), precision:0) . ' ans'}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
