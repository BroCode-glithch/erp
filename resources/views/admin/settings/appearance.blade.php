@extends('layouts.admin')

@section('title', 'Appearance Settings | Admin | ' . setting('general.site_name'))

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-3xl mx-auto">
    <h2 class="mb-6 text-2xl font-semibold text-gray-800 dark:text-gray-100">Appearance Settings</h2>

    <form action="{{ route('admin.settings.appearance.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Direction Setting -->
        <div>
            <label for="direction" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Layout Direction
            </label>
            <select name="direction" id="direction"
                    class="w-full px-4 py-2 mt-1 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                <option value="ltr" {{ $settings['system_default_direction'] === 'ltr' ? 'selected' : '' }}>Left to Right (LTR)</option>
                <option value="rtl" {{ $settings['system_default_direction'] === 'rtl' ? 'selected' : '' }}>Right to Left (RTL)</option>
            </select>
        </div>

        <!-- Language Setting -->
        <div>
            <label for="language" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                System Language
            </label>
            <select name="language" id="language"
                    class="w-full px-4 py-2 mt-1 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                <option value="en" {{ $settings['system_default_language'] === 'en' ? 'selected' : '' }}>English</option>
                <option value="ar" {{ $settings['system_default_language'] === 'ar' ? 'selected' : '' }}>Arabic</option>
                <option value="fr" {{ $settings['system_default_language'] === 'fr' ? 'selected' : '' }}>French</option>
                <!-- More language(s) would be added as system develops -->
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
