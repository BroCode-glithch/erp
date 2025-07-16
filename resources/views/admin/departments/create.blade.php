@extends('layouts.admin')

@section('title', 'Create Department | Admin | ' . setting('general.site_name'))

@section('content')
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="max-w-xl p-6 mx-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h2 class="mb-4 text-xl font-semibold text-gray-800 dark:text-gray-100">Add Department</h2>

            <form action="{{ route('admin.departments.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Department
                        Name</label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('admin.departments.index') }}"
                        class="px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded hover:bg-gray-300 dark:text-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
