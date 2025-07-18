@extends('layouts.admin')

@section('title', 'Reports | Admin | ' . setting('general.site_name'))

@section('content')
<div x-data="{ showModal: false, deleteUrl: '', loading: false }" class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">

        <!-- Delete Confirmation Modal -->
        <div x-cloak x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div @click.outside="showModal = false" class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Confirm Deletion</h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Are you sure you want to delete this report?</p>
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

        <!-- Header -->
        <div class="flex flex-col gap-4 p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Manage Reports</h2>

            <div class="flex flex-col-reverse gap-4 md:flex-row md:items-center md:justify-between">
                <!-- Search Form -->
                <form action="{{ route('admin.reports.index') }}" method="GET"
                    class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-2 w-full md:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search reports..."
                        class="w-full px-3 py-2 text-sm text-gray-800 placeholder-gray-400 bg-white border border-gray-300 rounded-md sm:w-64 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 w-full sm:w-auto">
                        Search
                    </button>
                </form>

                <!-- Export Buttons -->
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('admin.reports.export.pdf') }}"
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
                    <a href="{{ route('admin.reports.create') }}"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        + New Report
                    </a>
                </div>

                <div class="flex items-center gap-2 px-4 py-3 mt-4 text-sm text-gray-700 bg-gray-100 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                    <svg class="w-5 h-5 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 12a9 9 0 110-18 9 9 0 010 18z"/>
                    </svg>
                    <span>Chart-based reports are coming soon. Stay tuned!</span>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="px-4 mt-4">
            {{ $reports->appends(request()->except('page'))->links() }}
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">#</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">Title</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">Description</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">Type</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">Filters</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">File</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-300">Created</th>
                        <th class="px-6 py-3 text-xs font-medium text-right text-gray-500 uppercase dark:text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @forelse($reports as $report)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $report->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $report->description }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ ucfirst($report->type) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $report->filters ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                @if ($report->file_path)
                                    <a href="{{ Storage::url($report->file_path) }}" target="_blank" class="text-blue-600 hover:underline">View</a>
                                @else
                                    <span class="text-gray-400">No file</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $report->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 space-x-2 text-sm text-right">
                                <a href="{{ route('admin.reports.edit', $report->id) }}"
                                class="px-3 py-1 text-blue-500 border border-blue-500 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900">Edit</a>
                                <button
                                    @click="showModal = true; deleteUrl = '{{ route('admin.reports.destroy', $report->id) }}'"
                                    class="px-3 py-1 text-red-500 border border-red-500 rounded-md hover:bg-red-50 dark:hover:bg-red-900">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
