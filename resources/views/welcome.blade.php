<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | {{ env('APP_NAME') }}</title>
    @vite('resources/css/app.css')
</head>

<body class="antialiased text-gray-800 bg-gray-100">

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

    @include('layouts.navigation')

    <div class="flex flex-col items-center justify-center min-h-screen px-6 py-12 mt-8">

        <!-- Hero Section -->
        <div class="max-w-4xl text-center animate-fade-in-up">
            <h1 class="mb-4 text-5xl font-extrabold leading-tight text-indigo-600">
                Welcome to the <br> {{ env('APP_NAME') }}!
            </h1>
            <p class="text-lg text-gray-700">
                Our all-in-one <strong>Enterprise Resource Planning (ERP)</strong> solution is designed to streamline
                <span class="font-semibold">administrative and academic operations</span> in institutions and organizations.
                With real-time data, role-based access, and beautiful dashboards, ERP empowers your team with
                efficiency, transparency, and total control.
            </p>
        </div>

        <!-- Feature Highlights (Wave Bounce + Hover Scale) -->
        <div class="grid w-full max-w-6xl grid-cols-1 gap-6 mt-12 sm:grid-cols-2 lg:grid-cols-3">
            @php
                $features = [
                    'Role-Based Access Control using Spatie',
                    'Department and Program Management',
                    'Secure User Authentication with Email Verification',
                    'Admin Dashboard with Analytics and CRUD Operations',
                    'Location-aware Login Notifications',
                    'Responsive UI powered by Tailwind CSS',
                ];
            @endphp

            @foreach ($features as $index => $feature)
                <div
                    class="flex items-start p-6 space-x-4 transition duration-300 transform bg-white rounded-lg shadow-md cursor-pointer feature-card hover:scale-105"
                    style="animation-delay: {{ $index * 0.3 }}s;">
                    <span class="text-xl text-green-500">✅</span>
                    <p class="text-sm text-gray-800">{{ $feature }}</p>
                </div>
            @endforeach
        </div>



        <!-- Call to Action -->
        <div class="mt-10">
            @guest
                <a href="{{ route('register') }}"
                    class="inline-block px-8 py-3 text-lg font-semibold text-white transition bg-indigo-600 rounded-lg shadow hover:bg-indigo-700">
                    Register
                </a>
            @if (Route::has('register'))
                <a href="{{ route('login') }}"
                    class="inline-block px-8 py-3 text-lg font-semibold text-white transition bg-indigo-600 rounded-lg shadow hover:bg-indigo-700">
                    Login to ERP
                </a>
            @endif
            @endguest

            @auth
            @php
                $user = Auth::user();
                if ($user->hasRole('admin')) {
                    $dashboardRoute = route('admin.dashboard');
                } elseif ($user->hasRole('care-support')) {
                    $dashboardRoute = route('care.dashboard');
                } elseif ($user->hasRole('program-manager')) {
                    $dashboardRoute = route('pm.dashboard');
                } else {
                    $dashboardRoute = url('/'); // fallback or maybe a generic dashboard
                }
            @endphp

            <a href="{{ $dashboardRoute }}"
                class="inline-block px-8 py-3 text-lg font-semibold text-white transition bg-indigo-600 rounded-lg shadow hover:bg-indigo-700">
                Dashboard
            </a>
        @endauth
        </div>

        <!-- Footer -->
        <footer class="mt-20 text-sm text-center text-gray-500">
            &copy; {{ date('Y') }} Assessment from: <a href="http://lerionjakenwauda.com/" target="_blank"><strong>Lerion Jake Nwauda Digital Innovations</strong></a>. All rights reserved.
        </footer>

    </div>
</body>

</html>
