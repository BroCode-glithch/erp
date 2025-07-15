<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $appearance['direction'] ?? 'ltr' }}" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin Panel | ' . config('app.name'))
    </title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- CDN Chat.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('styles')

    <style>
        [x-cloak] { display: none !important; }
    </style>

</head>
{{--  <body x-data="{ sidebarOpen: window.innerWidth >= 768 }" x-cloak class="h-full text-gray-800 bg-gray-100">  --}}
<body
    x-data="{
        sidebarOpen: window.innerWidth >= 768,
        updateSidebar() {
            this.sidebarOpen = window.innerWidth >= 768;
        }
    }"
    x-init="
        updateSidebar();
        window.addEventListener('resize', updateSidebar);
    "
    x-cloak
    class="h-full text-gray-800 bg-gray-100"
>

    <!-- Preloader -->
    <x-preloader />

    <!-- Notification -->
    @if (session()->has('message'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 4000)"
             x-show="show"
             x-transition
             class="fixed z-50 px-6 py-4 text-white bg-green-600 border border-green-700 rounded-lg shadow-lg bottom-6 right-6">
            <div class="text-lg font-semibold">{{ session('message') }}</div>
        </div>
    @endif

    @include('sweetalert::alert')

    <!-- Confirm Delete Modal -->
    <x-confirm-modal />

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        @include('partials._sidebar')

        <!-- Overlay for mobile -->
        <div class="fixed inset-0 z-40 bg-black bg-opacity-40 md:hidden" x-show="sidebarOpen" @click="sidebarOpen = false" x-transition></div>

        <!-- Main content -->
        <div class="relative z-10 flex flex-col flex-1 overflow-hidden">

            <!-- Header -->
            @include('partials._header')

            <!-- Page content -->
            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')
            </main>

            <!-- Flash Notification -->
            <x-notification />

            <!-- Footer -->
            @include('partials._footer')

        </div>
    </div>

    @stack('scripts')

</body>
</html>
