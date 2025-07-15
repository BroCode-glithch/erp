<!-- Nav Component or Welcome Page Nav -->
<nav x-data="{ open: false }"
     class="fixed top-0 left-0 right-0 z-50 transition-all border-b border-gray-200 backdrop-blur-md bg-white/70 dark:bg-gray-900/70 dark:border-gray-700">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo & App Name -->
            <div class="flex items-center space-x-3">
                <a href="{{ url('/') }}">
                    {{--  <x-application-logo class="block w-auto text-indigo-600 h-9 dark:text-indigo-400" />  --}}
                    <div class="logo-circle">ERP</div>
                </a>
                <a href="{{ url('/') }}">
                    <span class="text-xl font-bold text-gray-800 dark:text-white">{{ config('app.name') }}</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="items-center hidden space-x-6 sm:flex">
                @guest
                    <a href="{{ route('login') }}"
                       class="text-sm font-medium text-gray-600 transition dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="p-4 text-sm font-medium text-gray-600 transition dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                            Register
                        </a>
                    @endif
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}"
                       class="text-sm font-medium text-gray-600 transition dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                        Dashboard
                    </a>
                @endauth

                <a href="#features"
                   class="text-sm font-medium text-gray-600 transition dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                    Features
                </a>

                <!-- Theme Toggle -->
                <button @click="darkMode = !darkMode" class="p-2">
                    <x-heroicon-o-sun id="theme-toggle-light" class="hidden size-5 text-yellow-500" />
                    <x-heroicon-o-moon id="theme-toggle-dark" class="size-5 text-gray-900 dark:text-gray-800" />
                </button>
            </div>

            <!-- Mobile Toggle Button -->
            <div class="flex sm:hidden">
                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 text-gray-600 rounded-md dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="w-6 h-6" :class="{ 'hidden': open, 'block': !open }" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="w-6 h-6" :class="{ 'block': open, 'hidden': !open }" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open"
         class="px-4 pb-4 transition-all duration-300 ease-in-out origin-top bg-white border-t border-gray-200 sm:hidden dark:bg-gray-900 dark:border-gray-700">
        <div class="pt-2 space-y-2">
            <a href="#features"
               class="block px-3 py-2 text-base font-medium text-gray-700 transition dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                Features
            </a>

            @guest
                <a href="{{ route('login') }}"
                   class="block px-3 py-2 text-base font-medium text-gray-700 transition dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                    Login
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="block px-3 py-2 text-base font-medium text-gray-700 transition dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                        Register
                    </a>
                @endif
            @endguest

            <!-- Theme Toggle -->
            <button @click="darkMode = !darkMode" class="p-2">
                <x-heroicon-o-sun id="theme-toggle-light" class="hidden size-5 text-yellow-500" />
                <x-heroicon-o-moon id="theme-toggle-dark" class="size-5 text-gray-900 dark:text-gray-800" />
            </button>

            @auth
            @php

                $user = Auth::user();
                if($user->hasRole('admin')) {
                    $dashboardRoute = route('admin.dashboard');
                } elseif($user->hasRole('care-support')) {
                    $dashboardRoute = route('care.dashboard');
                } elseif($user->hasRole('program-manager')) {
                    $dashboardRoute = route('pm.dashboard');
                } else {
                    $dashboardRoute = url('/');
                }

            @endphp
                <a href="{{ $dashboardRoute }}"
                   class="block px-3 py-2 text-base font-medium text-gray-700 transition dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                    Dashboard
                </a>
            @endauth
        </div>
    </div>
</nav>
