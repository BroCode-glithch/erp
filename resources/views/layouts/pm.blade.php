<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Manager Dashboard</title>
    <!--  CSS or JS  -->

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @if (session()->has('message'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            class="fixed bottom-6 right-6 z-50 px-6 py-4 bg-green-500 border border-green-700 text-white rounded-lg shadow-lg transition transform duration-500 ease-in-out"
        >
            <div class="font-semibold text-lg">
                {{ session('message') }}
            </div>
        </div>
    @endif
    <!-- SweetAlert notifications -->
    @include('sweetalert::alert')

    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
        <div class="text-6xl font-bold text-gray-800 animate-wavy-text">
            <span class="wave">E</span>
            <span class="delay-100 wave">R</span>
            <span class="delay-200 wave">P</span>
        </div>
    </div>

    <!-- Include the header -->
    @include('partials.pm._header')

    <main>
        <div class="flex mt-16">

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

    <script>
        window.addEventListener('load', function () {
            const preloader = document.getElementById('preloader');
            preloader.classList.add('opacity-0');
            setTimeout(() => preloader.style.display = 'none', 500);
        });
    </script>


</body>
</html>
