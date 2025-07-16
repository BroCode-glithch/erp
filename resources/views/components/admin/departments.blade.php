    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="flex flex-col gap-4 p-4 border-b border-gray-200 dark:border-gray-700">

            <!-- Title -->
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                {{ __('Manage Departments') }}
            </h2>

            <!-- Search + Actions -->
            <div class="flex flex-col-reverse gap-4 md:flex-row md:items-center md:justify-between">

                <!-- Search Form -->
                <form action="{{ route('admin.departments.index') }}" method="GET"
                    class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-2 w-full md:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search departments..."
                        class="w-full px-3 py-2 text-sm text-gray-800 placeholder-gray-400 bg-white border border-gray-300 rounded-md sm:w-64 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" />

                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 w-full sm:w-auto">
                        Search
                    </button>
                </form>

                <!-- Export + Action Buttons -->
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('admin.departments.export.pdf') }}"
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
                    <a href="{{ route('admin.departments.create') }}"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        + New Department
                    </a>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="px-4 mt-4">
            {{ $departments->appends(request()->except('page'))->links() }}
        </div>


            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">#
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                Name</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($departments as $department)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $department->name }}</td>
                                <td class="px-6 py-4 text-sm text-right space-x-2">
                                    <a href="{{ route('admin.departments.edit', $department->id) }}"
                                        class="px-3 py-1 border border-blue-500 text-blue-500 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900">
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('admin.departments.destroy', $department->id) }}" method="POST"
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
                                <td colspan="3" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                                    {{ __('No departments found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>