@extends('layouts.admin')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">

        <!-- Header -->
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Create Program</h2>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.programs.store') }}" method="POST" class="p-6">
            @csrf

            <!-- Program Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Program Name
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name') }}"
                       placeholder="e.g., edit-posts"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                       required>

                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-end mt-6 space-x-2">
                <a href="{{ route('admin.programs.index') }}"
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
