@extends('layouts.admin')

@section('title', 'Create Report | Admin | ' . setting('general.site_name'))

@section('content')
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">

            <!-- Header -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Create Report</h2>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.reports.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="mt-1 block w-full px-3 py-2 border dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 @error('title') border-red-500 @enderror"
                        required>
                    @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="mt-1 block w-full px-3 py-2 border dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 @error('description') border-red-500 @enderror"
                        required>{{ old('description') }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Type -->
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                    <select name="type" id="type"
                        class="mt-1 block w-full px-3 py-2 border dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                        <option value="">Select Type</option>
                        <option value="attendance" {{ old('type') == 'attendance' ? 'selected' : '' }}>Attendance</option>
                        <option value="performance" {{ old('type') == 'performance' ? 'selected' : '' }}>Performance</option>
                        <option value="summary" {{ old('type') == 'summary' ? 'selected' : '' }}>Summary</option>
                    </select>
                    @error('type') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Filters -->
                <div class="mb-4">
                    <label for="filters" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filters (optional)</label>
                    <input type="text" name="filters" id="filters" value="{{ old('filters') }}"
                        placeholder='e.g., {"department":"Science"}'
                        class="mt-1 block w-full px-3 py-2 border dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                    @error('filters') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- File Upload -->
                <div class="mb-4">
                    <label for="file_path" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload File (optional)</label>
                    <input type="file" name="file_path" id="file_path"
                        class="mt-1 block w-full text-gray-800 dark:text-gray-100">
                    @error('file_path') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-end mt-6 space-x-2">
                    <a href="{{ route('admin.reports.index') }}"
                        class="px-4 py-2 text-sm text-gray-700 border border-gray-300 rounded-md dark:border-gray-600 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
