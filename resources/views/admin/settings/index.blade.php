@extends('layouts.admin')

@section('title', 'Settings | Admin | ' . setting('general.site_name'))

@section('content')

    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h2 class="mb-6 text-2xl font-semibold text-gray-800 dark:text-gray-100">System Settings</h2>

            <div class="grid gap-6 sm:grid-cols-2">
                <!-- General Settings -->
                <a href="{{ route('admin.settings.general') }}"
                    class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-md dark:bg-gray-800 dark:border-gray-700 transition">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100">General Settings</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Manage system-wide general configurations.
                    </p>
                </a>

                <!-- Appearance Settings -->
                <a href="{{ route('admin.settings.appearance') }}"
                    class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-md dark:bg-gray-800 dark:border-gray-700 transition">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100">Appearance Settings</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Configure layout direction, language, and visual preferences.
                    </p>
                </a>
            </div>
        </div>
    </div>

@endsection
