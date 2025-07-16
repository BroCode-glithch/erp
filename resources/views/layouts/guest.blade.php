<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $appearance['direction'] ?? 'ltr' }}"
    x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO Meta Tags --}}
    <meta name="description"
        content="Login and access {{ setting('general.site_name') }} ERP. Secure authentication for users, admins, and support staff.">
    <meta name="keywords" content="ERP, Login, Authentication, Secure Access, Laravel, User Portal">
    <meta name="author" content="Lerion Jake Nwauda Digital Innovations">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="Login | {{ setting('general.site_name') }}">
    <meta property="og:description"
        content="Access your ERP dashboard securely and manage your organization efficiently.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/erp-og-image.png') }}">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <title>@yield('title', 'Login | ' . setting('general.site_name'))</title>

    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))" :class="{ 'dark': darkMode }"
    class="antialiased text-gray-800 bg-gray-100 dark:bg-gray-900 dark:text-white min-h-screen flex flex-col">

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
            class="fixed z-50 px-6 py-4 text-white transition duration-500 ease-in-out transform bg-green-500 border border-green-700 rounded-lg shadow-lg bottom-6 right-6">
            <div class="text-lg font-semibold">
                {{ session('message') }}
            </div>
        </div>
    @endif

    @include('layouts.navigation')

    <main class="flex flex-1 flex-col items-center justify-center pt-12 pb-12 sm:pt-16 sm:pb-16">
        <div
            class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:max-w-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full border-t bg-gray-100 dark:bg-gray-900 dark:border-gray-700">
        <div
            class="flex flex-col items-center justify-between px-4 py-8 text-sm text-gray-500 dark:text-gray-400 sm:flex-row">
            <div>
                &copy; {{ date('Y') }} <a href="http://lerionjakenwauda.com/" target="_blank"
                    class="font-medium hover:underline">Lerion Jake Nwauda Digital Innovations</a>.
            </div>
            <div class="flex gap-4 mt-2 sm:mt-0">
                <a href="{{ route('policy') }}" class="hover:underline">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="hover:underline">Terms</a>
                <a href="mailto:emmaariyom1@gmail.com" class="hover:underline">Contact</a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @vite('resources/js/app.js')
</body>

</html>
