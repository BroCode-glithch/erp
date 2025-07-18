<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $appearance['direction'] ?? 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- SEO Meta Tags --}}
        <meta name="description" content="Secure and modern ERP system for managing users, departments, programs, and analytics.">
        <meta name="keywords" content="ERP, Dashboard, User Management, Department Management, Analytics, Laravel, Secure Authentication">
        <meta name="author" content="Lerion Jake Nwauda Digital Innovations">

        {{-- Open Graph Meta Tags --}}
        <meta property="og:title" content="{{ setting('general.site_name', 'ERP SYSTEM') }}">
        <meta property="og:description" content="All-in-one ERP solution for efficient and secure organizational management.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ asset('images/erp-og-image.png') }}">

        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        
        <title>{{ setting('general.site_name', 'ERP SYSTEM') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @PwaHead
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-800">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-gray-800 shadow">
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

        @RegisterServiceWorkerScript

    </body>
</html>
