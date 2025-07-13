<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @yield('title', config('app.name', 'Laravel'))
        </title>


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="//unpkg.com/alpinejs" defer></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>


    <body class="font-sans antialiased text-gray-900">

        @if (session()->has('message'))

        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            class="fixed z-50 px-6 py-4 text-white transition duration-500 ease-in-out transform bg-green-500 border border-green-700 rounded-lg shadow-lg bottom-6 right-6"
        >

            <div class="text-lg font-semibold">
                {{ session('message') }}
            </div>

        </div>

    @endif

        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-800 sm:justify-center sm:pt-0">

            <div>
                <a href="/">
                    {{--  <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />  --}}
                    <div class="logo-circle">ERP</div>
                </a>
            </div>

            <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
                {{ $slot }}
            </div>

        </div>

    </body>

</html>
