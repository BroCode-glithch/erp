<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $appearance['direction'] ?? 'ltr' }}" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO Meta Tags --}}
    <meta name="description"
        content="Care Support Dashboard for {{ setting('general.site_name') }} ERP. Manage support tickets, user queries, and provide efficient help desk services.">
    <meta name="keywords" content="ERP, Care Support, Help Desk, User Support, Dashboard, Laravel, Notifications">
    <meta name="author" content="Lerion Jake Nwauda Digital Innovations">
    setting('general.site_name')
    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="Care Support Dashboard | {{ setting('general.site_name') }}">
    <meta property="og:description"
        content="Efficient care support dashboard for managing user queries and support tickets in your ERP system.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/erp-og-image.png') }}">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <title>Care Support Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100">
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
            class="fixed z-50 px-6 py-4 text-white transition duration-500 ease-in-out transform bg-green-500 border border-green-700 rounded-lg shadow-lg bottom-6 right-6">
            <div class="text-lg font-semibold">
                {{ session('message') }}
            </div>
        </div>
    @endif
    <!-- Include the header -->
    @include('partials._header')

    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
        <div class="text-6xl font-bold text-gray-800 animate-wavy-text">
            <span class="wave">E</span>
            <span class="delay-100 wave">R</span>
            <span class="delay-200 wave">P</span>
        </div>
    </div>

    <main>
        <div class="flex mt-16">

            <!-- SweetAlert notifications -->
            @include('sweetalert::alert')

            <!-- Sidebar -->
            @include('partials._sidebar')

            <main class="flex-1 p-6">
                <!-- Page content goes here -->
                {{ $slot }}
            </main>
        </div>
    </main>

    <!-- Include the footer -->
    @include('partials._footer')

    <script>
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            preloader.classList.add('opacity-0');
            setTimeout(() => preloader.style.display = 'none', 500);
        });
    </script>

</body>

</html>
