<x-header/>
<body class="bg-[#EBEBEB]">
    <div class="flex
                max-w-full min-h-[80vh]">
        <x-article/>

        <div class="py-12
                    flex mx-[auto]">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

                {{-- Informations du profil --}}
                <div class="bg-white p-4 shadow-sm sm:rounded-lg sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                {{-- Changement de mot de passe --}}
                <div class="bg-white p-4 shadow-sm sm:rounded-lg sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- Supprimer le compte --}}
                <div class="bg-white p-4 shadow-sm sm:rounded-lg sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

<x-footer/>
