<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $appearance['direction'] ?? 'ltr' }}" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO Meta Tags --}}
    <meta name="description"
        content="Admin Panel for {{ setting('general.site_name') }} ERP. Manage users, departments, analytics, and more with secure, role-based access.">
    <meta name="keywords"
        content="ERP, Admin Panel, Dashboard, Analytics, User Management, Laravel, Role-Based Access, Department Management">
    <meta name="author" content="Lerion Jake Nwauda Digital Innovations">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="Admin Panel | {{ setting('general.site_name') }}">
    <meta property="og:description"
        content="Powerful admin dashboard for managing your ERP system efficiently and securely.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/erp-og-image.png') }}">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <!-- Intro.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css" />

    <!-- Intro.js JS -->
    <script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>


    <title>
        @yield('title', 'Admin Panel | ' . setting('general.site_name'))
    </title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- CDN Chat.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('styles')

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @PwaHead

</head>

<body x-data="{
    sidebarOpen: window.innerWidth >= 1024,
    updateSidebar() {
        this.sidebarOpen = window.innerWidth >= 1024;
    }
}" x-init="updateSidebar();
window.addEventListener('resize', updateSidebar);" class="h-full text-gray-800 bg-gray-100">

    <!-- Preloader -->
    <x-preloader />

    <!-- Notification -->
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
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
        <div class="fixed inset-0 z-40 bg-black bg-opacity-40 md:hidden" x-show="sidebarOpen"
            @click="sidebarOpen = false" x-transition></div>

        <!-- Main content -->
        <div class="relative z-10 flex flex-col flex-1 overflow-hidden">

            <!-- Header -->
            @include('partials._header')

            <!-- Page content -->
            <main class="flex-1 px-4 py-6 overflow-y-auto sm:px-6 md:px-8 lg:px-10">
                @yield('content')
            </main>

            <!-- Flash Notification -->
            <x-notification />

            <!-- Footer -->
            @include('partials._footer')

        </div>
    </div>

    <!-- inactivity Modal -->
    <div id="inactivityModal" style="display: none; position: fixed; z-index: 9999; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7);">
        <div style="background: white; color: black; padding: 2rem; max-width: 400px; margin: 20% auto; text-align: center; border-radius: 8px;">
            <h1 style="color: red">Inactive</h1>
            <p>You have been inactive for a while. You will be logged out in <span id="countdown">120</span> seconds.</p>
            <button id="stayLoggedIn" style="padding: 0.5rem 1rem; background: #3490dc; color: white; border: none; border-radius: 4px;">Stay Logged In</button>
        </div>
    </div>

    <form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>

    // This was taken from a previous project of mine
    <script>
        let inactivityTime = function () {
            let warningTimer;
            let logoutTimer;
            let modalIsVisible = false; // NEW FLAG

            const warningTime = 15 * 60* 1000;// 15 minutes
            const logoutTime = 2 * 60 * 1000;   // 2 minutes

            function resetTimer() {
                // If the modal is showing, don't reset just from mouse/key movement
                if (modalIsVisible) {
                    return;
                }

                clearTimeout(warningTimer);
                clearTimeout(logoutTimer);

                // Hide modal if it's open (precaution)
                document.getElementById('inactivityModal').style.display = 'none';

                warningTimer = setTimeout(showWarning, warningTime);
            }

            function showWarning() {
                const modal = document.getElementById('inactivityModal');
                const countdownEl = document.getElementById('countdown');
                let timeLeft = 120; // 2 minutes in seconds

                modal.style.display = 'block';
                modalIsVisible = true; // mark modal as visible
                countdownEl.textContent = timeLeft;

                // Start countdown
                const countdownInterval = setInterval(() => {
                    timeLeft--;
                    countdownEl.textContent = timeLeft;
                    if (timeLeft <= 0) {
                        clearInterval(countdownInterval);
                    }
                }, 1000);

                // Start logout timer
                logoutTimer = setTimeout(() => {
                    // ✅ Option to submit a logout form here instead of GET
                    document.getElementById('logoutForm').submit();
                }, logoutTime);
            }

            // List of events to consider as activity
            window.onload = resetTimer;
            document.onmousemove = resetTimer;
            document.onkeydown = resetTimer;
            document.onclick = resetTimer;
            document.onscroll = resetTimer;

            // Stay logged in button
            document.getElementById('stayLoggedIn').addEventListener('click', () => {
                modalIsVisible = false; // reset the modal flag
                resetTimer();
            });
        };

        inactivityTime();

    </script>

    @RegisterServiceWorkerScript
    @stack('scripts')

</body>
</html>
