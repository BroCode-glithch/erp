@extends('layouts.admin')

@section('content')
<div x-data="{ showModal: false, deleteUrl: '', loading: false }" class="px-4 py-6 sm:px-6 lg:px-8">

    <!-- Delete Confirmation Modal -->
    <div x-cloak x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div @click.outside="showModal = false" class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Confirm Deletion</h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Are you sure you want to delete this department?</p>
            <div class="flex justify-end mt-4 space-x-2">
                <button @click="showModal = false"
                        class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-200 rounded hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300">
                    Cancel
                </button>
                <form :action="deleteUrl" method="POST" @submit="loading = true">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700"
                            :disabled="loading">
                        <span x-show="!loading">Delete</span>
                        <span x-show="loading">Deleting...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Card -->
    <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
        <!-- Header -->
        <div class="flex flex-col gap-4 p-4 border-b border-gray-200 dark:border-gray-700 md:flex-row md:items-center md:justify-between">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Departments Management</h2>

            <a href="{{ route('admin.departments.create') }}"
               class="px-4 py-2 text-sm text-white bg-blue-600 rounded-md hover:bg-blue-700">
                Add Department
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">ID</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">Name</th>
                        <th class="px-6 py-3 text-xs font-medium text-right text-gray-500 uppercase dark:text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @forelse($departments as $department)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $department->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $department->name }}</td>
                            <td class="px-6 py-4 space-x-2 text-sm text-right">
                                <a href="{{ route('admin.departments.edit', $department->id) }}"
                                   class="px-3 py-1 text-blue-500 border border-blue-500 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900">
                                    Edit
                                </a>
                                <button
                                    @click="showModal = true; deleteUrl = '{{ route('admin.departments.destroy', $department->id) }}'"
                                    class="px-3 py-1 text-red-500 border border-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                                No departments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
