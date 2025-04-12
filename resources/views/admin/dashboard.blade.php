<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Admin Dashboard</h2>
    </x-slot>

    @if (auth()->user()->notifications->count())
        <div class="px-4 mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h3 class="mb-2 text-lg font-semibold text-gray-700">Recent Notifications</h3>
                <ul class="space-y-2">
                    <form action="{{ route('admin.notifications.read') }}" method="POST" class="mb-3">
                        @csrf
                        <button type="submit" class="text-sm text-blue-600 hover:underline">Mark all as read</button>
                    </form>                    
                    @foreach (auth()->user()->notifications->take(2) as $notification)
                        <li class="p-3 text-sm text-gray-600 border border-gray-200 rounded-md bg-gray-50">
                            {{ $notification->data['message'] ?? 'New activity on your account.' }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="py-6">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Roles -->
                <div class="p-6 transition bg-blue-100 border-l-4 border-blue-500 rounded-lg shadow hover:shadow-lg">
                    <h3 class="text-lg font-semibold text-blue-800">Roles & Permissions</h3>
                    <p class="text-sm text-blue-700">Manage user roles and access levels.</p>
                    <a href="#" class="inline-block mt-3 text-sm font-semibold text-blue-600 hover:underline">Manage Roles</a>
                </div>

                <!-- Users -->
                <div class="p-6 transition bg-green-100 border-l-4 border-green-500 rounded-lg shadow hover:shadow-lg">
                    <h3 class="text-lg font-semibold text-green-800">User Management</h3>
                    <p class="text-sm text-green-700">Add/edit users and assign roles.</p>
                    <a href="#" class="inline-block mt-3 text-sm font-semibold text-green-600 hover:underline">Manage Users</a>
                </div>

                <!-- Departments -->
                <div class="p-6 transition bg-yellow-100 border-l-4 border-yellow-500 rounded-lg shadow hover:shadow-lg">
                    <h3 class="text-lg font-semibold text-yellow-800">Departments</h3>
                    <p class="text-sm text-yellow-700">Manage organizational departments.</p>
                    <a href="#" class="inline-block mt-3 text-sm font-semibold text-yellow-600 hover:underline">Manage Departments</a>
                </div>

                <!-- Settings -->
                <div class="p-6 transition bg-purple-100 border-l-4 border-purple-500 rounded-lg shadow hover:shadow-lg">
                    <h3 class="text-lg font-semibold text-purple-800">Settings</h3>
                    <p class="text-sm text-purple-700">Update app logo, name, and general info.</p>
                    <a href="#" class="inline-block mt-3 text-sm font-semibold text-purple-600 hover:underline">Go to Settings</a>
                </div>

                <!-- Reports -->
                <div class="p-6 transition bg-red-100 border-l-4 border-red-500 rounded-lg shadow hover:shadow-lg">
                    <h3 class="text-lg font-semibold text-red-800">Reports</h3>
                    <p class="text-sm text-red-700">Generate PDF/Excel reports and view insights.</p>
                    <a href="#" class="inline-block mt-3 text-sm font-semibold text-red-600 hover:underline">View Reports</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
