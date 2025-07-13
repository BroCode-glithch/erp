@extends('layouts.admin')

@section('title', 'Roles | Admin | ' . config('app.name'))

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">

        <!-- Header: Title + Actions -->
        <div class="flex flex-col gap-4 p-4 border-b border-gray-200 dark:border-gray-700 md:flex-row md:items-center md:justify-between">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Roles Management</h2>

            <div class="flex flex-col w-full gap-2 md:flex-row md:w-auto">
                {{-- Optional search bar --}}
                <input type="text" placeholder="Search roles..." class="w-full px-3 py-2 text-sm text-gray-800 placeholder-gray-400 bg-white border border-gray-300 rounded-md md:w-64 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" />

                {{-- Action Buttons --}}
                <div class="flex flex-wrap gap-2">
                    <a href="#" class="px-3 py-2 text-sm text-white bg-red-600 rounded-md hover:bg-red-700">Export PDF</a>
                    <a href="#" class="px-3 py-2 text-sm text-white bg-green-600 rounded-md hover:bg-green-700">Export Excel</a>
                    <a href="#" class="px-3 py-2 text-sm text-white bg-yellow-500 rounded-md hover:bg-yellow-600">Export XML</a>
                    <a href="{{ route('admin.roles.create') }}" class="px-4 py-2 text-sm text-white bg-blue-600 rounded-md hover:bg-blue-700">Add Role</a>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">ID</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">Role</th>
                        <th class="px-6 py-3 text-xs font-medium text-right text-gray-500 uppercase dark:text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @foreach(range(1, 5) as $id)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $id }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">Role {{ $id }}</td>
                            <td class="px-6 py-4 space-x-2 text-sm text-right">
                                <a href="{{ route('admin.roles.edit', $id) }}" class="px-3 py-1 text-blue-500 border border-blue-500 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900">
                                    Edit
                                </a>
                                <a href="{{ route('admin.permissions.edit', $id) }}" class="px-3 py-1 text-green-500 border border-green-500 rounded-md hover:bg-green-50 dark:hover:bg-green-900">
                                    Permissions
                                </a>
                                <button class="px-3 py-1 text-red-500 border border-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
