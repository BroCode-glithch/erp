<div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
        <!-- Header -->
        <div class="flex flex-col gap-4 p-4 border-b border-gray-200 dark:border-gray-700">

            <!-- Title -->
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                {{ __('Manage Users') }}
            </h2>

            <!-- Search + Actions -->
            <div class="flex flex-col-reverse gap-4 md:flex-row md:items-center md:justify-between">

                <!-- Search Form -->
                <form action="{{ route('admin.departments.index') }}" method="GET"
                    class="flex flex-col w-full gap-2 sm:flex-row sm:items-center sm:gap-2 md:w-auto">
                    <input type="text" name="search" value="{{ request('user-search') }}" placeholder="Search users..."
                        class="w-full px-3 py-2 text-sm text-gray-800 placeholder-gray-400 bg-white border border-gray-300 rounded-md sm:w-64 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" />

                    <button type="submit"
                            class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 sm:w-auto">
                        Search
                    </button>
                </form>

                <!-- Export + Action Buttons -->
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('admin.users.export.pdf') }}"
                    class="px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                        Export PDF
                    </a>
                    <a href="#"
                    class="px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                        Export Excel
                    </a>
                    <a href="#"
                    class="px-3 py-2 text-sm font-medium text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                        Export XML
                    </a>
                    <a href="{{ route('admin.users.create') }}"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        + New User
                    </a>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="px-4 mt-4">
            {{ $users->appends(request()->except('page'))->links() }}
        </div>


            <!-- Users Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">
                                #</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">
                                Name</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">
                                Email</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">
                                Roles</th>
                            <th
                                class="px-6 py-3 text-xs font-medium text-right text-gray-500 uppercase dark:text-gray-300">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse($users as $user)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    @foreach ($user->roles as $role)
                                        <span
                                            class="inline-block px-2 py-1 text-xs font-semibold text-white bg-blue-500 rounded dark:bg-blue-600">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 space-x-2 text-sm text-right">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="px-3 py-1 text-blue-500 border border-blue-500 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900">
                                        {{ __('Edit') }}
                                    </a>
                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                        class="px-3 py-1 text-purple-500 border border-purple-500 rounded-md hover:bg-purple-50 dark:hover:bg-purple-900">
                                        {{ __('View') }}
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        class="inline-block delete-form"
                                        onsubmit="event.preventDefault(); openDeleteModal(this);">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 text-red-500 border border-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                                    {{ __('No users found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
