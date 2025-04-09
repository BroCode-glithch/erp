<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Manager Dashboard</title>
    <!--  CSS or JS  -->

    <!-- NotifyCss -->
    @notifyCss

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Include the header -->
    @include('partials.pm._header')

    <main>
        <div class="flex mt-16">
            <!-- Show success message only if there is one -->
            @if (session('success'))
                <x-alert type="success" :message="session('success')" />
            @endif

            <!-- Show error message only if there is one -->
            @if (session('error'))
                <x-alert type="error" :message="session('error')" />
            @endif

            <!-- Sidebar -->
            <aside class="fixed top-0 left-0 hidden w-full h-screen text-white bg-gray-700 md:w-64 md:relative md:block">
                @include('partials.pm._sidebar')
            </aside>
            <main class="flex-1 p-6">
                <!-- Page content goes here -->
                {{ $slot }}
            </main>
        </div>
    </main>

    <!-- Include the footer -->
    @include('partials.pm._footer')

    @notifyJs
    <x:notify-messages />
</body>
</html>
