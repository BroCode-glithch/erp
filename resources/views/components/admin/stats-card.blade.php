        <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 mt-8">
            <div
                class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm flex flex-col items-center">
                @svg('heroicon-s-shield-check', 'w-8 h-8 text-blue-500 mb-2')
                <div class="text-2xl font-bold text-blue-600 dark:text-blue-300">{{ $counts['roleCount'] }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Roles</div>
            </div>
            <div
                class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm flex flex-col items-center">
                @svg('heroicon-s-key', 'w-8 h-8 text-purple-500 mb-2')
                <div class="text-2xl font-bold text-purple-600 dark:text-purple-300">{{ $counts['permissionCount'] }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Permissions</div>
            </div>
            <div
                class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm flex flex-col items-center">
                @svg('heroicon-s-users', 'w-8 h-8 text-green-500 mb-2')
                <div class="text-2xl font-bold text-green-600 dark:text-green-300">{{ $counts['userCount'] }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Users</div>
            </div>
            <div
                class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm flex flex-col items-center">
                @svg('heroicon-s-building-office', 'w-8 h-8 text-yellow-500 mb-2')
                <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-300">{{ $counts['departmentCount'] }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Departments</div>
            </div>
            <div
                class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm flex flex-col items-center">
                @svg('heroicon-s-academic-cap', 'w-8 h-8 text-red-500 mb-2')
                <div class="text-2xl font-bold text-red-600 dark:text-red-300">{{ $counts['programCount'] }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Programs</div>
            </div>
        </div>