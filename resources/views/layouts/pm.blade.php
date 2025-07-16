<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $appearance['direction'] ?? 'ltr' }}" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO Meta Tags --}}
    <meta name="description" content="Program Manager Panel for {{ setting('general.site_name') }} ERP. Manage programs, departments, analytics, and more with secure, role-based access.">
    <meta name="keywords" content="ERP, Program Manager, Dashboard, Analytics, Department Management, Laravel, Role-Based Access">
    <meta name="author" content="Lerion Jake Nwauda Digital Innovations">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="Program Manager Panel | {{ setting('general.site_name') }}">
    <meta property="og:description" content="Efficient program manager dashboard for managing academic programs and departments in your ERP system.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/erp-og-image.png') }}">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <title>
        @yield('title', 'Program Manager Dashboard | ' . setting('general.site_name'))
    </title>

    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('styles')

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body x-data="{
        sidebarOpen: window.innerWidth >= 768,
        updateSidebar() {
            this.sidebarOpen = window.innerWidth >= 768;
        }
    }"
    x-init="updateSidebar(); window.addEventListener('resize', updateSidebar);"
    x-cloak
    class="h-full text-gray-800 bg-gray-100">

    {{-- Preloader --}}
    <div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center transition-opacity duration-500 bg-white">
        <div class="space-x-1 text-5xl font-extrabold text-gray-700 animate-bounce">
            <span class="wave">E</span>
            <span class="delay-100 wave">R</span>
            <span class="delay-200 wave">P</span>
            <span class="delay-300 wave">.</span>
            <span class="delay-400 wave">.</span>
            <span class="delay-500 wave">.</span>
        </div>
    </div>

    {{-- Notifications --}}
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
            class="fixed z-50 px-6 py-4 text-white bg-green-600 border border-green-700 rounded-lg shadow-lg bottom-6 right-6">
            <div class="text-lg font-semibold">{{ session('message') }}</div>
        </div>
    @endif

    @include('sweetalert::alert')
    <x-confirm-modal />

    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar --}}
        @include('partials._sidebar')

        {{-- Overlay for mobile --}}
        <div class="fixed inset-0 z-40 bg-black bg-opacity-40 md:hidden" x-show="sidebarOpen" @click="sidebarOpen = false" x-transition></div>

        {{-- Main Content Area --}}
        <div class="relative z-10 flex flex-col flex-1 overflow-hidden">

            {{-- Header --}}
            @include('partials._header')

            {{-- Page Content --}}
            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('partials._footer')
        </div>
    </div>

    {{-- Preloader Script --}}
    <script>
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            preloader.classList.add('opacity-0');
            setTimeout(() => preloader.style.display = 'none', 500);
        });
    </script>

    {{-- Delete Modal Handler --}}
    <script>
        function openDeleteModal(form) {
            window.dispatchEvent(new CustomEvent('open-confirm-delete', {
                detail: {
                    form
                }
            }));
        }
    </script>

    @stack('scripts')

</body>
</html>
