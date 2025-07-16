<div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <!-- Header: Title, Search, and Button -->
            <div
                class="p-4 border-b border-gray-200 dark:border-gray-700 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    {{ __('Users Management') }}
                </h2>
                <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                    <input type="text" placeholder="Search users..."
                        class="w-full md:w-64 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm text-gray-800 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.users.export.pdf') }}"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm">
                            {{ __('Export PDF') }}
                        </a>
                        <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-sm">
                            {{ __('Export Excel') }}
                        </a>
                        <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-md text-sm">
                            {{ __('Export XML') }}
                        </a>
                        <a href="{{ route('admin.users.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm">
                            {{ __('Add User') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                #</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                Roles</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
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
