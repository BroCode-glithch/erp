<!-- Nav Component or Welcome Page Nav -->
<nav x-data="{ open: false }"
     class="fixed top-0 left-0 right-0 z-50 backdrop-blur-md bg-white/70 border-b border-gray-200 transition-all">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo & App Name -->
            <div class="flex items-center space-x-3">
                <a href="{{ url('/') }}">
                    <x-application-logo class="block h-9 w-auto text-indigo-600" />
                </a>
                <a href="{{ url('/') }}">
                    <span class="text-xl font-bold text-gray-100">{{ env('APP_NAME') }}</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden sm:flex space-x-6 items-center">
                @guest
                    <a href="{{ route('login') }}"
                       class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="text-sm p-4 font-medium text-gray-600 hover:text-indigo-600 transition">
                            Register
                        </a>
                    @endif
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}"
                       class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">
                        Dashboard
                    </a>
                @endauth

                <a href="#features"
                   class="text-sm p-2 font-medium text-gray-600 hover:text-indigo-600 transition">
                    Features
                </a>
            </div>

            <!-- Mobile Toggle Button -->
            <div class="flex sm:hidden">
                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
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
         class="sm:hidden px-4 pb-4 transition-all duration-300 ease-in-out origin-top bg-white border-t border-gray-200">
        <div class="pt-2 space-y-2">
            <a href="#features"
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 transition">
                Features
            </a>

            @guest
                <a href="{{ route('login') }}"
                   class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 transition">
                    Login
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 transition">
                        Register
                    </a>
                @endif
            @endguest

            @auth
                <a href="{{ route('dashboard') }}"
                   class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 transition">
                    Dashboard
                </a>
            @endauth
        </div>
    </div>
</nav>
