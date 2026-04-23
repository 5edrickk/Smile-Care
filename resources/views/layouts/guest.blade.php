<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SmileCare') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="bg-linear-to-b from-hospitalfashion to-lighttooth min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <div class="text-center">
                        <div class="flex justify-center items-center">
                            <img src="{{ asset('img/BigMouth.png') }}" alt="A pixel art of tooth with eyes" class="w-25">
                            <h1 class="text-white text-6xl m-5">Smile Care</h1>
                        </div>
                </div>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
