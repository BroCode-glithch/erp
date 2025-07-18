<aside x-data="{ openMenu: null }"
       x-show="sidebarOpen || window.innerWidth >= 768"
       @click.away="sidebarOpen = false"
       class="fixed inset-y-0 left-0 z-40 w-64 overflow-y-auto text-gray-800 transition-transform duration-200 ease-in-out transform bg-white border-r border-gray-200 shadow-md dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 md:translate-x-0 md:static md:inset-0"
       ::class="{ '-translate-x-full': !sidebarOpen && window.innerWidth < 768 }">

    <!-- Logo & App Name -->
    <div class="flex items-center px-4 py-4 space-x-3">
        <a href="{{ url('/') }}">
            <div class="logo-circle">
                <img src="{{ asset('logo.png') }}" alt="ERP Logo" style="width: 48px; height: 48px;">
            </div>
        </a>
        
        <a href="{{ url('/') }}">
            <span class="text-xl font-bold text-gray-800 dark:text-white">{{ setting('general.site_name') }}</span>
        </a>
    </div>

    <nav class="px-4 py-4 space-y-2">
        <!-- Dashboard (common to all roles) -->
        @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-2 px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
                @svg('heroicon-s-home', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                {{ __('Dashboard') }}
            </a>
        @elseif (auth()->user()->hasRole('program-manager'))
            <a href="{{ route('pm.dashboard') }}"
            class="flex items-center gap-2 px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
                @svg('heroicon-s-home', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                {{ __('Dashboard') }}
            </a>
        @elseif (Auth::user()->hasRole('support'))
            <a href="{{ route('care.dashboard') }}"
            class="flex items-center gap-2 px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
                @svg('heroicon-s-home', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                {{ __('Dashboard') }}
            </a>
        @endif

        <!-- Admin-only: Roles & Permissions -->
        @role('admin')
            <div>
                <button @click="openMenu === 'roles' ? openMenu = null : openMenu = 'roles'"
                        class="flex items-center justify-between w-full px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white focus:outline-none">
                    <div class="flex items-center gap-2">
                        @svg('heroicon-s-shield-check', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                        {{ __('Roles & Permissions') }}
                    </div>
                    <svg :class="{'rotate-180': openMenu === 'roles'}"
                        class="w-4 h-4 text-gray-400 transition-transform duration-200 transform dark:text-gray-300"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="openMenu === 'roles'" x-collapse class="mt-2 ml-4 space-y-1 text-sm">
                    <a href="{{ route('admin.roles.index') }}"
                    class="block px-2 py-1 text-gray-600 rounded dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                        {{ __('All Roles') }}
                    </a>
                    <a href="{{ route('admin.permissions.index') }}"
                    class="block px-2 py-1 text-gray-600 rounded dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                        {{ __('Permissions') }}
                    </a>
                </div>
            </div>
        @endrole

        <!-- Admin + Support: Users & Departments -->
        @if(auth()->user()->hasAnyRole(['admin', 'support']))
            <a href="{{ route('admin.users.index') }}"
            class="flex items-center gap-2 px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
                @svg('heroicon-s-users', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                {{ __('User Management') }}
            </a>

            <a href="{{ route('admin.departments.index') }}"
            class="flex items-center gap-2 px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
                @svg('heroicon-s-building-office', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                {{ __('Departments') }}
            </a>
        @endif

        <!--Admin + Program Manager -->
            @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.programs.index') }}"
                class="flex items-center gap-2 px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
                    @svg('heroicon-s-academic-cap', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                    {{ __('Programs') }}
                </a>
            @elseif (auth()->user()->hasRole('program-manager'))
                <a href="{{ route('pm.programs.index') }}"
                class="flex items-center gap-2 px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
                    @svg('heroicon-s-academic-cap', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                    {{ __('Programs') }}
                </a>
            @endif

        <!-- Settings (admin only) -->
        @role('admin')
            <div>
                <button @click="openMenu === 'settings' ? openMenu = null : openMenu = 'settings'"
                        class="flex items-center justify-between w-full px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white focus:outline-none">
                    <div class="flex items-center gap-2">
                        @svg('heroicon-s-cog-6-tooth', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                        {{ __('Settings') }}
                    </div>
                    <svg :class="{'rotate-180': openMenu === 'settings'}"
                        class="w-4 h-4 text-gray-400 transition-transform duration-200 transform dark:text-gray-300"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="openMenu === 'settings'" x-collapse class="mt-2 ml-4 space-y-1 text-sm">
                    <a href="{{ route('admin.settings.general') }}"
                    class="block px-2 py-1 text-gray-600 rounded dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                        {{ __('General') }}
                    </a>
                    <a href="{{ route('admin.settings.appearance') }}"
                    class="block px-2 py-1 text-gray-600 rounded dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                        {{ __('Appearance') }}
                    </a>
                </div>
            </div>
        @endrole

        <!-- Reports (admin + program-manager) -->
        @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('admin.reports.index') }}"
            class="flex items-center gap-2 px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
                @svg('heroicon-s-chart-bar', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                {{ __('Reports') }}
            </a>
        @elseif (auth()->user()->hasRole('program-manager'))
            <a href="{{ route('pm.reports.index') }}"
            class="flex items-center gap-2 px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
                @svg('heroicon-s-chart-bar', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                {{ __('Reports') }}
            </a>
        @endif

    </nav>

</aside>
