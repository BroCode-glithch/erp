<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))"
    :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO Meta Tags --}}
    <meta name="description"
        content="Welcome to {{ setting('general.site_name') }} ERP. Streamline your administrative and academic operations with real-time data, role-based access, and beautiful dashboards.">
    <meta name="keywords"
        content="ERP, Enterprise Resource Planning, Admin Dashboard, Role-Based Access, Laravel, Academic Management, Department Management, Secure Authentication">
    <meta name="author" content="Lerion Jake Nwauda Digital Innovations">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="Welcome | {{ setting(key: 'general.site_name') }} ERP">
    <meta property="og:description"
        content="All-in-one ERP system for efficient, transparent, and secure management of your organization.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset('images/erp-og-image.png') }}">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <title>Welcome | {{ setting('general.site_name') }}</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data="{ darkMode: false }" :class="{ 'dark': darkMode }"
    class="antialiased text-gray-800 bg-gray-100 dark:bg-gray-900 dark:text-white">


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

    <div class="flex flex-col items-center justify-center min-h-screen px-6 py-12 mt-8">

        <!-- Hero Section -->
        <div class="max-w-4xl text-center animate-fade-in-up">
            <h1 class="mb-4 text-5xl font-extrabold leading-tight text-indigo-600 dark:text-indigo-400">
                Welcome to <br> {{ setting('general.site_name') }} ERP!!!
            </h1>
            <p class="text-lg text-gray-700 dark:text-gray-300">
                Our all-in-one <strong>Enterprise Resource Planning (ERP)</strong> system streamlines your
                <span class="font-semibold">administrative and academic operations</span>.
                With real-time data, role-based access, and beautiful dashboards, {{ setting('general.site_name') }}
                empowers your team with
                efficiency, transparency, and total control.
            </p>
        </div>

        <!-- Feature Highlights -->
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
                <div class="flex items-start p-6 space-x-4 transition-transform duration-300 transform bg-white rounded-lg shadow-md dark:bg-gray-800 feature-card hover:scale-105"
                    style="animation-delay: {{ $index * 0.2 }}s;">
                    <span class="text-xl text-green-500 dark:text-green-400">✅</span>
                    <p class="text-sm">{{ $feature }}</p>
                </div>
            @endforeach
        </div>

        <!-- Call to Action -->
        <div class="mt-12 space-x-4">
            @guest
                <a href="{{ route('register') }}"
                    class="inline-block px-8 py-3 text-lg font-semibold text-white transition bg-indigo-600 rounded-lg shadow hover:bg-indigo-700">
                    Register
                </a>
                @if (Route::has('login'))
                    <a href="{{ route('login') }}"
                        class="inline-block px-8 py-3 text-lg font-semibold text-white transition bg-indigo-600 rounded-lg shadow hover:bg-indigo-700">
                        Login to {{ setting('general.site_name') }}
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
                        $dashboardRoute = url('/'); // fallback
                    }
                @endphp

                <a href="{{ $dashboardRoute }}"
                    class="inline-block px-8 py-3 text-lg font-semibold text-white transition bg-indigo-600 rounded-lg shadow hover:bg-indigo-700">
                    Go to Dashboard
                </a>
            @endauth
        </div>

        <!-- Testimonials -->
        <section class="w-full max-w-6xl mt-20">
            <h2 class="mb-6 text-2xl font-bold text-center text-indigo-600 dark:text-indigo-400">What Users Are Saying
            </h2>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ([['name' => 'Chinedu A.', 'comment' => 'This ERP made managing our students and departments so easy. Highly recommended!', 'role' => 'Registrar'], ['name' => 'Fatima B.', 'comment' => 'Real-time dashboards helped us make better decisions. Game changer!', 'role' => 'Admin Officer'], ['name' => 'Tolu K.', 'comment' => 'The user access controls are excellent. Everyone sees only what they need.', 'role' => 'HR Manager']] as $review)
                    <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <p class="mb-2 text-sm italic text-gray-700 dark:text-gray-300">"{{ $review['comment'] }}"</p>
                        <div class="mt-2 text-xs text-right text-gray-500 dark:text-gray-400">
                            — {{ $review['name'] }}, <span class="font-medium">{{ $review['role'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="w-full max-w-4xl mt-20">
            <h2 class="mb-6 text-2xl font-bold text-center text-indigo-600 dark:text-indigo-400">Frequently Asked
                Questions</h2>
            <div x-data="{ open: null }" class="space-y-4">
                @foreach ([['q' => 'Is the ERP mobile responsive?', 'a' => 'Yes, the UI adapts beautifully to mobile, tablet, and desktop devices.'], ['q' => 'How secure is user data?', 'a' => 'We use Laravel best practices with encryption, roles, and location-aware login monitoring.'], ['q' => 'Can it be integrated with other tools?', 'a' => 'Yes! Our system is built on Laravel, making API integration simple.']] as $i => $faq)
                    <div class="border rounded-lg dark:border-gray-600">
                        <button @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                            class="flex items-center justify-between w-full px-4 py-3 text-left">
                            <span class="font-medium">{{ $faq['q'] }}</span>
                            <svg x-show="open !== {{ $i }}" class="w-4 h-4 text-gray-500" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            <svg x-show="open === {{ $i }}" class="w-4 h-4 text-gray-500" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>
                        <div x-show="open === {{ $i }}"
                            class="px-4 pb-4 text-sm text-gray-600 dark:text-gray-300">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Contact CTA -->
        <section class="w-full max-w-4xl mt-24 text-center">
            <h2 class="mb-4 text-2xl font-bold text-indigo-700 dark:text-indigo-400">Need Support or a Demo?</h2>
            <p class="mb-4 text-gray-600 dark:text-gray-300">
                We're here to help you get started or answer any technical questions.
            </p>
            <a href="mailto:{{ setting('general.system_email') }}"
                class="inline-block px-6 py-3 text-white bg-indigo-600 rounded-lg shadow hover:bg-indigo-700">
                Contact Us
            </a>
        </section>


        <!-- Footer -->
        <footer class="w-full mt-24 border-t bg-gray-100 dark:bg-gray-900 dark:border-gray-700">
            <div
                class="flex flex-col items-center justify-between px-4 py-8 text-sm text-gray-500 sm:flex-row dark:text-gray-400">
                <div>
                    &copy; {{ date('Y') }} <a href="http://lerionjakenwauda.com/" target="_blank"
                        class="font-medium hover:underline">Lerion Jake Nwauda Digital Innovations</a>.
                </div>
                <div class="flex gap-4 mt-2 sm:mt-0">
                    <a href="{{ route('policy') }}" class="hover:underline">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="hover:underline">Terms</a>
                    <a href="mailto:{{ setting('general.system_email') }}" class="hover:underline">Contact</a>
                </div>
            </div>
        </footer>

    </div>
</body>

</html>
