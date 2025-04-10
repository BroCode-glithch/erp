<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care Support Dashboard</title>
    <!-- Add your CSS or JS links here -->

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Include the header -->
    @include('partials.care._header')

    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
        <div class="text-6xl font-bold text-gray-800 animate-wavy-text">
            <span class="wave">E</span>
            <span class="delay-100 wave">R</span>
            <span class="delay-200 wave">P</span>
        </div>
    </div>

    <main>
        <div class="flex mt-16">

            <!-- SweetAlert notifications -->
            @include('sweetalert::alert')

            <!-- Sidebar -->
            <aside class="fixed top-0 left-0 hidden w-full h-screen text-white bg-gray-700 md:w-64 md:relative md:block">
                @include('partials.care._sidebar')
            </aside>
            <main class="flex-1 p-6">
                <!-- Page content goes here -->
                {{ $slot }}
            </main>
        </div>
    </main>

    <!-- Include the footer -->
    @include('partials.care._footer')

    <script>
        window.addEventListener('load', function () {
            const preloader = document.getElementById('preloader');
            preloader.classList.add('opacity-0');
            setTimeout(() => preloader.style.display = 'none', 500);
        });
    </script>

</body>
</html>
