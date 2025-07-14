<header class="bg-white dark:bg-gray-900 shadow-sm z-30">
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Left: Logo / Menu -->
            <div class="flex items-center space-x-4">
                <!-- Mobile menu toggle -->
                {{--  <button @click="sidebarOpen = ! sidebarOpen" class="md:hidden text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>  --}}
                <!-- Mobile Hamburger -->
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2">
                    @svg('heroicon-s-bars-3', 'w-6 h-6 text-gray-700 dark:text-gray-200')
                </button>


                <!-- Logo -->
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-semibold text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">
                    {{ __('ERP Admin') }}
                </a>
            </div>

            <!-- Right: User Menu -->
            <div class="flex items-center space-x-4">
                <!-- Notification -->
                <button class="relative focus:outline-none text-gray-500 dark:text-gray-300 hover:text-gray-600 dark:hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 00-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-600 rounded-full"></span>
                </button>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 text-sm focus:outline-none">
                        <img class="w-8 h-8 rounded-full object-cover"
                             src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name) }}"
                             alt="User Photo">
                        <span class="hidden sm:block font-medium text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</span>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition
                         class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg py-1 z-50">
                        <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            {{ __('Profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
