<aside x-data="{ openMenu: null }"
       x-show="sidebarOpen || window.innerWidth >= 768"
       @click.away="sidebarOpen = false"
       class="fixed inset-y-0 left-0 z-40 w-64 overflow-y-auto text-gray-800 transition-transform duration-200 ease-in-out transform bg-white border-r border-gray-200 shadow-md dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 md:translate-x-0 md:static md:inset-0"
       ::class="{ '-translate-x-full': !sidebarOpen && window.innerWidth < 768 }">

    <!-- Logo & App Name -->
    <div class="px-4 py-4 flex items-center space-x-3">
        <a href="{{ url('/') }}">
            {{--  <x-application-logo class="block w-auto text-indigo-600 h-9 dark:text-indigo-400" />  --}}
            <div class="logo-circle">ERP</div>
        </a>
        <a href="{{ url('/') }}">
            <span class="text-xl font-bold text-gray-800 dark:text-white">{{ config('app.name') }}</span>
        </a>
    </div>

    <nav class="px-4 py-4 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
        class="flex items-center gap-2 px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
            @svg('heroicon-s-home', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
            Dashboard
        </a>

        <!-- Roles & Permissions -->
        <div>
            <button @click="openMenu === 'roles' ? openMenu = null : openMenu = 'roles'"
                    class="flex items-center justify-between w-full px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white focus:outline-none">
                <div class="flex items-center gap-2">
                    @svg('heroicon-s-shield-check', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                    Roles & Permissions
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
                    All Roles
                </a>
                <a href="{{ route('admin.permissions.index') }}"
                class="block px-2 py-1 text-gray-600 rounded dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                    Permissions
                </a>
            </div>
        </div>

        <!-- User Management -->
        <a href="{{ route('admin.users.index') }}"
        class="flex items-center gap-2 px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
            @svg('heroicon-s-users', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
            User Management
        </a>

        <!-- Departments -->
        <a href="{{ route('admin.departments.index') }}"
        class="flex items-center gap-2 px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
            @svg('heroicon-s-building-office', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
            Departments
        </a>

        <!-- Programs -->
        <a href="{{ route('admin.programs.index') }}"
        class="flex items-center gap-2 px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
            @svg('heroicon-s-academic-cap', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
            Programs
        </a>

        <!-- Settings -->
        <div>
            <button @click="openMenu === 'settings' ? openMenu = null : openMenu = 'settings'"
                    class="flex items-center justify-between w-full px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white focus:outline-none">
                <a href="{{ route('admin.settings.index') }}">
                    <div class="flex items-center gap-2">
                        @svg('heroicon-s-cog-6-tooth', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                        Settings
                    </div>
                </a>
                <svg :class="{'rotate-180': openMenu === 'settings'}"
                    class="w-4 h-4 text-gray-400 transition-transform duration-200 transform dark:text-gray-300"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="openMenu === 'settings'" x-collapse class="mt-2 ml-4 space-y-1 text-sm">
                <a href="{{ route('admin.settings.general') }}"
                class="block px-2 py-1 text-gray-600 rounded dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                    General
                </a>
                <a href="{{ route('admin.settings.appearance') }}"
                class="block px-2 py-1 text-gray-600 rounded dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                    Appearance
                </a>
            </div>
        </div>

        <!-- Reports -->
        <a href="{{ route('admin.reports.index') }}"
        class="flex items-center gap-2 px-3 py-2 font-medium text-gray-700 rounded dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
            @svg('heroicon-s-chart-bar', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
            Reports
        </a>
    </nav>

</aside>
