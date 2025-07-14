<header class="z-30 bg-white shadow-sm dark:bg-gray-900">
    <div class="max-w-full px-4 mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Left: Logo / Menu -->
            <div class="flex items-center space-x-4">
                <!-- Mobile Hamburger -->
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 md:hidden">
                    @svg('heroicon-s-bars-3', 'w-6 h-6 text-gray-700 dark:text-gray-200')
                </button>

                <!-- Dynamic Logo Title -->
                <a href="#" class="text-xl font-semibold text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">
                    @if (Auth::user()->hasRole('admin'))
                        {{ __('ERP Admin') }}
                    @elseif (Auth::user()->hasRole('support'))
                        {{ __('ERP Support') }}
                    @elseif (Auth::user()->hasRole('program-manager'))
                        {{ __('ERP Program Manager') }}
                    @else
                        {{ __('ERP') }}
                    @endif
                </a>
            </div>

            <!-- Right: User Menu -->
            <div class="flex items-center space-x-4">
                <!-- Notification -->
                <button class="relative text-gray-500 focus:outline-none dark:text-gray-300 hover:text-gray-600 dark:hover:text-white">
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
                        <img class="object-cover w-8 h-8 rounded-full"
                             src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name) }}"
                             alt="User Photo">
                        <span class="hidden font-medium text-gray-700 sm:block dark:text-gray-200">{{ Auth::user()->name }}</span>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition
                         class="absolute right-0 z-50 w-48 py-1 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                        <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            {{ __('Profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 text-left text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
