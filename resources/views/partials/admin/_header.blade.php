<!-- resources/views/partials/admin/_header.blade.php -->
<header class="p-4 text-white bg-gray-800">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Admin Dashboard</h1>
        <div class="flex items-center">
            <!-- Example user profile section -->
            <span class="mr-4">Welcome, {{ Auth::user()->name }}</span>
            <a href="{{ route('logout') }}" class="text-sm">Logout</a>
        </div>
    </div>
</header>
