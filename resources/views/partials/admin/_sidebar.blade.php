<aside x-data="{ openMenu: null }"
       x-show="sidebarOpen || window.innerWidth >= 768"
       @click.away="sidebarOpen = false"
       class="fixed inset-y-0 left-0 z-40 w-64 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 border-r border-gray-200 dark:border-gray-700 shadow-md overflow-y-auto transform transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0"
       ::class="{ '-translate-x-full': !sidebarOpen && window.innerWidth < 768 }">

    <div class="px-6 py-4 text-xl font-bold text-gray-800 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.dashboard') }}">
            <div class="logo-circle" style="width: 50px !important; height: 50px !important;">
                ERP
            </div>
        </a>
    </div>

    <nav class="px-4 py-4 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
        class="flex items-center gap-2 px-3 py-2 rounded font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
            @svg('heroicon-s-home', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
            Dashboard
        </a>

        <!-- Roles & Permissions -->
        <div>
            <button @click="openMenu === 'roles' ? openMenu = null : openMenu = 'roles'"
                    class="flex items-center justify-between w-full px-3 py-2 rounded font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white focus:outline-none">
                <div class="flex items-center gap-2">
                    @svg('heroicon-s-shield-check', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                    Roles & Permissions
                </div>
                <svg :class="{'rotate-180': openMenu === 'roles'}"
                    class="w-4 h-4 transform transition-transform duration-200 text-gray-400 dark:text-gray-300"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="openMenu === 'roles'" x-collapse class="ml-4 mt-2 space-y-1 text-sm">
                <a href="{{ route('admin.roles.index') }}"
                class="block px-2 py-1 text-gray-600 dark:text-gray-300 rounded hover:bg-gray-100 dark:hover:bg-gray-800">
                    All Roles
                </a>
                <a href="{{ route('admin.permissions.index') }}"
                class="block px-2 py-1 text-gray-600 dark:text-gray-300 rounded hover:bg-gray-100 dark:hover:bg-gray-800">
                    Permissions
                </a>
            </div>
        </div>

        <!-- User Management -->
        <a href="#"
        class="flex items-center gap-2 px-3 py-2 rounded font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
            @svg('heroicon-s-users', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
            User Management
        </a>

        <!-- Departments -->
        <a href="#"
        class="flex items-center gap-2 px-3 py-2 rounded font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
            @svg('heroicon-s-building-office', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
            Departments
        </a>

        <!-- Programs -->
        <a href="#"
        class="flex items-center gap-2 px-3 py-2 rounded font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
            @svg('heroicon-s-academic-cap', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
            Programs
        </a>

        <!-- Settings -->
        <div>
            <button @click="openMenu === 'settings' ? openMenu = null : openMenu = 'settings'"
                    class="flex items-center justify-between w-full px-3 py-2 rounded font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white focus:outline-none">
                <div class="flex items-center gap-2">
                    @svg('heroicon-s-cog-6-tooth', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
                    Settings
                </div>
                <svg :class="{'rotate-180': openMenu === 'settings'}"
                    class="w-4 h-4 transform transition-transform duration-200 text-gray-400 dark:text-gray-300"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="openMenu === 'settings'" x-collapse class="ml-4 mt-2 space-y-1 text-sm">
                <a href="#"
                class="block px-2 py-1 text-gray-600 dark:text-gray-300 rounded hover:bg-gray-100 dark:hover:bg-gray-800">
                    General
                </a>
                <a href="#"
                class="block px-2 py-1 text-gray-600 dark:text-gray-300 rounded hover:bg-gray-100 dark:hover:bg-gray-800">
                    Appearance
                </a>
            </div>
        </div>

        <!-- Reports -->
        <a href="#"
        class="flex items-center gap-2 px-3 py-2 rounded font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white">
            @svg('heroicon-s-chart-bar', 'w-5 h-5 shrink-0 text-gray-400 dark:text-gray-300')
            Reports
        </a>
    </nav>

</aside>
