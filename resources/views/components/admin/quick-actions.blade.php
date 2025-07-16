    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
            @php
                $cards = [
                    [
                        'title' => 'Roles & Permissions',
                        'desc' => 'Manage user roles.',
                        'link' => route('admin.roles.index'),
                        'color' => 'blue',
                        'icon' => 'heroicon-s-shield-check',
                    ],
                    [
                        'title' => 'User Management',
                        'desc' => 'Add/edit users.',
                        'link' => route('admin.users.index'),
                        'color' => 'green',
                        'icon' => 'heroicon-s-users',
                    ],
                    [
                        'title' => 'Departments',
                        'desc' => 'Manage departments.',
                        'link' => route('admin.departments.index'),
                        'color' => 'yellow',
                        'icon' => 'heroicon-s-building-office',
                    ],
                    [
                        'title' => 'Settings',
                        'desc' => 'Configure app.',
                        'link' => route('admin.settings.index'),
                        'color' => 'purple',
                        'icon' => 'heroicon-s-cog-6-tooth',
                    ],
                    [
                        'title' => 'Reports',
                        'desc' => 'Generate reports.',
                        'link' => route('admin.reports.index'),
                        'color' => 'red',
                        'icon' => 'heroicon-s-chart-bar',
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <div
                    class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm hover:shadow-md transition duration-300 group">
                    <div class="flex items-center justify-between">
                        <div
                            class="p-2 rounded-full bg-{{ $card['color'] }}-100 text-{{ $card['color'] }}-600 dark:bg-{{ $card['color'] }}-900 dark:text-{{ $card['color'] }}-300">
                            @svg($card['icon'], 'w-6 h-6')
                        </div>
                        <a href="{{ $card['link'] }}"
                            class="text-sm font-medium text-{{ $card['color'] }}-600 dark:text-{{ $card['color'] }}-300 border border-transparent hover:border-{{ $card['color'] }}-300 hover:bg-{{ $card['color'] }}-50 dark:hover:bg-{{ $card['color'] }}-800 rounded-lg px-3 py-1.5 transition">
                            {{ __('Manage') }}
                        </a>
                    </div>
                    <h3
                        class="mt-4 text-lg font-semibold text-gray-800 dark:text-white group-hover:text-{{ $card['color'] }}-700 dark:group-hover:text-{{ $card['color'] }}-300 transition">
                        {{ $card['title'] }}
                    </h3>
                    <p class="text-sm mt-1 text-gray-500 dark:text-gray-400">
                        {{ $card['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>