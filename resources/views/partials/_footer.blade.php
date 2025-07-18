<footer class="w-full px-6 py-4 mt-8 border-t bg-white text-gray-600 dark:bg-gray-900 dark:text-gray-300">
    <div class="flex flex-col items-center justify-between space-y-2 md:flex-row md:space-y-0">

        <!-- Left -->
        <div class="text-sm">
            &copy; {{ now()->year }} <a href="{{ config('app.url') }}"><span class="font-semibold">{{ setting('general.site_name') ?? 'ERP System' }}</span></a>. Developed with <a target="_blank" href="https://github.com/BroCode-glithch">❤️</a>. All rights reserved.
        </div>

        <!-- Center (Optional links) -->
        <div class="flex space-x-4 text-sm">
            <a href="#" class="hover:text-blue-500 transition">
                {{ __('Privacy Policy') }}
            </a>
            <a href="#" class="hover:text-blue-500 transition">
                {{ __('Terms') }}
            </a>
            <a href="#" class="hover:text-blue-500 transition">
                {{ __('Support') }}
            </a>
        </div>

        <!-- Right (Dark mode toggle) -->
        <div x-data="{ dark: false }" x-init="dark = localStorage.getItem('theme') === 'dark';"
             class="flex items-center space-x-2">
            <span class="text-sm">
                {{ __('Dark Mode') }}
            </span>
            <label class="inline-flex relative items-center cursor-pointer">
                <input type="checkbox" x-model="dark" @change="document.documentElement.classList.toggle('dark', dark); localStorage.setItem('theme', dark ? 'dark' : 'light')"
                       class="sr-only peer">
                <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer dark:bg-gray-600 peer-checked:bg-blue-600 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
            </label>
        </div>

    </div>
</footer>
