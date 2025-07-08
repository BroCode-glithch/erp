@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    {{-- Notifications --}}
    @if (auth()->user()->notifications->count())
        <div class="mb-6 p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                    @svg('heroicon-s-bell', 'w-5 h-5 text-blue-500')
                    Recent Notifications
                </h3>
                <form action="{{ route('admin.notifications.read') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Mark all as read
                    </button>
                </form>
            </div>

            <ul class="space-y-2">
                @foreach (auth()->user()->notifications->take(3) as $notification)
                    <li class="px-4 py-3 bg-gray-50 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                {{ $notification->data['message'] ?? 'You have a new notification.' }}
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Quick Actions --}}
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
        @php
            $cards = [
                ['title' => 'Roles & Permissions', 'desc' => 'Manage user roles.', 'link' => route('admin.roles.index'), 'color' => 'blue', 'icon' => 'heroicon-s-shield-check'],
                ['title' => 'User Management', 'desc' => 'Add/edit users.', 'link' => route('admin.users.index'), 'color' => 'green', 'icon' => 'heroicon-s-users'],
                ['title' => 'Departments', 'desc' => 'Manage departments.', 'link' => route('admin.departments.index'), 'color' => 'yellow', 'icon' => 'heroicon-s-building-office'],
                ['title' => 'Settings', 'desc' => 'Configure app.', 'link' => route('admin.settings.index'), 'color' => 'purple', 'icon' => 'heroicon-s-cog-6-tooth'],
                ['title' => 'Reports', 'desc' => 'Generate reports.', 'link' => route('admin.reports.index'), 'color' => 'red', 'icon' => 'heroicon-s-chart-bar'],
            ];
        @endphp


        @foreach ($cards as $card)
            <div class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm hover:shadow-md transition duration-300 group">
                <div class="flex items-center justify-between">
                    <!-- Icon -->
                    <div class="p-2 rounded-full bg-{{ $card['color'] }}-100 text-{{ $card['color'] }}-600 dark:bg-{{ $card['color'] }}-900 dark:text-{{ $card['color'] }}-300">
                        @svg($card['icon'], 'w-6 h-6')
                    </div>

                    <!-- Manage Button -->
                    <a href="{{ $card['link'] }}"
                    class="text-sm font-medium text-{{ $card['color'] }}-600 dark:text-{{ $card['color'] }}-300 border border-transparent hover:border-{{ $card['color'] }}-300 hover:bg-{{ $card['color'] }}-50 dark:hover:bg-{{ $card['color'] }}-800 rounded-lg px-3 py-1.5 transition">
                        Manage
                    </a>
                </div>

                <h3 class="mt-4 text-lg font-semibold text-gray-800 dark:text-white group-hover:text-{{ $card['color'] }}-700 dark:group-hover:text-{{ $card['color'] }}-300 transition">
                    {{ $card['title'] }}
                </h3>

                <p class="text-sm mt-1 text-gray-500 dark:text-gray-400">
                    {{ $card['desc'] }}
                </p>
            </div>
        @endforeach
    </div>
</div>

{{-- Analytics & Charts --}}
<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Line Chart -->
        <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
            <h4 class="mb-4 text-base font-semibold text-gray-700 dark:text-gray-100">User Growth (Monthly)</h4>
            <div class="relative h-64">
                <canvas id="userGrowthChart"></canvas>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
            <h4 class="mb-4 text-base font-semibold text-gray-700 dark:text-gray-100">User Roles Distribution</h4>
            <div class="relative h-64">
                <canvas id="rolePieChart"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Department --}}
<div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <!-- Header with Title, Search, and Button -->
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Departments</h2>
            <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                <input type="text" placeholder="Search by name, ID, or description..." class="w-full md:w-64 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm text-gray-800 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <div class="flex flex-wrap gap-2">
                    <a href="#" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm">
                        Export PDF
                    </a>

                    <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-sm">
                        Export Excel
                    </a>

                    <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-md text-sm">
                        Export XML
                    </a>
                    
                    <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm">
                        Add Department
                    </a>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Description</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">1</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">Human Resources</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">Handles hiring, onboarding, and HR policies.</td>
                        <td class="px-6 py-4 text-sm text-right space-x-2">
                            <button class="px-3 py-1 border border-blue-500 text-blue-500 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900">
                                Edit
                            </button>
                            <button class="px-3 py-1 border border-red-500 text-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">2</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">IT Services</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">Responsible for infrastructure, support, and systems.</td>
                        <td class="px-6 py-4 text-sm text-right space-x-2">
                            <button class="px-3 py-1 border border-blue-500 text-blue-500 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900">
                                Edit
                            </button>
                            <button class="px-3 py-1 border border-red-500 text-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Users --}}
<div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <!-- Header: Title, Search, and Button -->
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Users</h2>
            <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                <input type="text" placeholder="Search by name, email, or role..." class="w-full md:w-64 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm text-gray-800 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <div class="flex flex-wrap gap-2">
                    <a href="#" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm">
                        Export PDF
                    </a>

                    <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-sm">
                        Export Excel
                    </a>

                    <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-md text-sm">
                        Export XML
                    </a>
                    
                    <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm">
                        Add User
                    </a>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Role</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">1</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">John Doe</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">john@example.com</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">Admin</td>
                        <td class="px-6 py-4 text-sm text-right space-x-2">
                            <button class="px-3 py-1 border border-blue-500 text-blue-500 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900">
                                Edit
                            </button>
                            <button class="px-3 py-1 border border-red-500 text-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">2</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">Jane Smith</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">jane@example.com</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">Editor</td>
                        <td class="px-6 py-4 text-sm text-right space-x-2">
                            <button class="px-3 py-1 border border-blue-500 text-blue-500 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900">
                                Edit
                            </button>
                            <button class="px-3 py-1 border border-red-500 text-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Programs --}}
<div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <!-- Header: Title, Search, and Button -->
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Programs</h2>
            <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                <input type="text" placeholder="Search programs..." class="w-full md:w-64 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm text-gray-800 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <div class="flex flex-wrap gap-2">
                    <a href="#" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm">
                        Export PDF
                    </a>

                    <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-sm">
                        Export Excel
                    </a>

                    <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-md text-sm">
                        Export XML
                    </a>
                    
                    <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm">
                        Create Program
                    </a>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Program Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Description</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">1</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">Onboarding Program</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">Human Resources</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">Introduces new employees to the company.</td>
                        <td class="px-6 py-4 text-sm text-right space-x-2">
                            <button class="px-3 py-1 border border-blue-500 text-blue-500 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900">
                                Edit
                            </button>
                            <button class="px-3 py-1 border border-red-500 text-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">2</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">Cybersecurity Training</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">IT Services</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">Teaches best practices for data security.</td>
                        <td class="px-6 py-4 text-sm text-right space-x-2">
                            <button class="px-3 py-1 border border-blue-500 text-blue-500 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900">
                                Edit
                            </button>
                            <button class="px-3 py-1 border border-red-500 text-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


{{-- Chart Scripts --}}
@push('scripts')
<script>
    const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
    new Chart(userGrowthCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Users Joined',
                data: [10, 20, 30, 25, 40, 60],
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    const rolePieCtx = document.getElementById('rolePieChart').getContext('2d');
    new Chart(rolePieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Admin', 'Editor', 'Viewer'],
            datasets: [{
                data: [5, 8, 12],
                backgroundColor: ['#10B981', '#FBBF24', '#EF4444'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endpush
@endsection
