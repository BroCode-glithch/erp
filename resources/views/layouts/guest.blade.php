<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }"
      x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))"
      :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Login | '. config('app.name'))</title>

    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }"
      x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))"
      :class="{ 'dark': darkMode }"
      class="antialiased text-gray-800 bg-gray-100 dark:bg-gray-900 dark:text-white min-h-screen flex flex-col">

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            class="fixed z-50 px-6 py-4 text-white transition duration-500 ease-in-out transform bg-green-500 border border-green-700 rounded-lg shadow-lg bottom-6 right-6"
        >
            <div class="text-lg font-semibold">
                {{ session('message') }}
            </div>
        </div>
    @endif

    @include('layouts.navigation')

    <main class="flex flex-1 flex-col items-center justify-center pt-12 pb-12 sm:pt-16 sm:pb-16">
        <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:max-w-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full border-t dark:border-gray-700">
        <div class="flex flex-col items-center justify-between px-4 py-8 text-sm text-gray-500 sm:flex-row dark:text-gray-400">
            <div>
                &copy; {{ date('Y') }} <a href="http://lerionjakenwauda.com/" target="_blank" class="font-medium hover:underline">Lerion Jake Nwauda Digital Innovations</a>.
            </div>
            <div class="flex gap-4 mt-2 sm:mt-0">
                <a href="#" class="hover:underline">Privacy Policy</a>
                <a href="#" class="hover:underline">Terms</a>
                <a href="mailto:emmaariyom1@gmail.com" class="hover:underline">Contact</a>
            </div>
        </div>
    </footer>
</body>
</html>