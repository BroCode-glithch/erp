<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Add your CSS or JS links here -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Include the header -->
    @include('partials.admin._header')

    <main>
        <div class="flex mt-16">
            <!-- Sidebar -->
            <aside class="fixed top-0 left-0 hidden w-full h-screen text-white bg-gray-700 md:w-64 md:relative md:block">
                @include('partials.admin._sidebar')
            </aside>
            <main class="flex-1 p-6">
                <!-- Page content goes here -->
                {{ $slot }}
            </main>
        </div>
    </main>

    <!-- Include the footer -->
    @include('partials.admin._footer')

</body>
</html>
