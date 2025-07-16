{{-- filepath: resources/views/features.blade.php --}}
<x-guest-layout>
    <div class="pt-4 bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col items-center pt-8 sm:pt-12">
            <div>
                <x-authentication-card-logo />
            </div>
            <div class="w-full sm:max-w-3xl mt-6 p-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                <h1 class="mb-6 text-3xl font-bold text-indigo-700 dark:text-indigo-400">Features</h1>
                <ul class="space-y-4 list-disc pl-6 text-gray-700 dark:text-gray-300">
                    <li>Role-Based Access Control using Spatie</li>
                    <li>Department and Program Management</li>
                    <li>Secure User Authentication with Email Verification</li>
                    <li>Admin Dashboard with Analytics and CRUD Operations</li>
                    <li>Location-aware Login Notifications</li>
                    <li>Responsive UI powered by Tailwind CSS</li>
                    <li>Export to PDF, Excel, XML</li>
                    <li>Light/Dark Mode Toggle</li>
                    <li>Activity Logs & Notifications</li>
                </ul>
            </div>
        </div>
    </div>
</x-guest-layout>