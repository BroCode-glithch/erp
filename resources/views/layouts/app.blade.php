<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <!-- SweetAlert notifications -->
        @include('sweetalert::alert')

        <!-- Preloader -->
        <div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
            <div class="text-6xl font-bold text-gray-800 animate-wavy-text">
                <span class="wave">E</span>
                <span class="delay-100 wave">R</span>
                <span class="delay-200 wave">P</span>
            </div>
        </div>

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
            window.addEventListener('load', function () {
                const preloader = document.getElementById('preloader');
                preloader.classList.add('opacity-0');
                setTimeout(() => preloader.style.display = 'none', 500);
            });
        </script>

    </body>
</html>
