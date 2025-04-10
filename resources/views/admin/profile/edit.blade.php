<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-4">  
                <!-- Profile Information -->
                <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                    <div class="text-sm text-gray-500 dark:text-gray-300">
                        @include('admin.profile.partials.update-profile-information-form')
                    </div>
                </div>
        
                <!-- Update Password -->
                <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                   <div class="text-sm text-gray-500 dark:text-gray-300">
                        @include('admin.profile.partials.update-password-form')
                    </div>
                </div>
        
                <!-- Delete User -->
                <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                    <div class="text-sm text-gray-500 dark:text-gray-300">
                        @include('admin.profile.partials.delete-user-form')
                    </div>
                </div>
        
                <!-- Profile Image (placeholder for now) -->
                <div class="flex items-center justify-center p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                    <div class="text-center">
                        <div class="w-24 h-24 mx-auto mb-2 overflow-hidden bg-gray-300 rounded-full"></div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Profile Picture</p>
                        <p class="text-xs text-gray-400">Upload coming soon</p>
                    </div>
                </div>
        
            </div>
        </div>        
    </div>
</x-admin-layout>
