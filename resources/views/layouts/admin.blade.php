<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - ERP System</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- CDN Chat.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('styles')
</head>
<body x-data="{ sidebarOpen: window.innerWidth >= 768 }" x-cloak class="h-full bg-gray-100 text-gray-800">

    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-white transition-opacity duration-500">
        <div class="text-5xl font-extrabold text-gray-700 animate-bounce space-x-1">
            <span class="wave">E</span><span class="wave delay-100">R</span><span class="wave delay-200">P</span>
        </div>
    </div>

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

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        @include('partials.admin._sidebar')

        <!-- Overlay for mobile -->
        <div class="fixed inset-0 bg-black bg-opacity-40 z-40 md:hidden" x-show="sidebarOpen" @click="sidebarOpen = false" x-transition></div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden relative z-10">

            <!-- Header -->
            @include('partials.admin._header')

            <!-- Page content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>

            <!-- Footer -->
            @include('partials.admin._footer')

        </div>
    </div>

    <!-- Preloader Script -->
    <script>
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            preloader.classList.add('opacity-0');
            setTimeout(() => preloader.style.display = 'none', 500);
        });
    </script>

    @stack('scripts')
</body>
</html>
