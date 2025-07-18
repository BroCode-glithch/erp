    <footer class="w-full bg-gray-100 border-t dark:bg-gray-900 dark:border-gray-700">
        <div
            class="flex flex-col items-center justify-between px-4 py-8 text-sm text-gray-500 dark:text-gray-400 sm:flex-row">
            <div>
                &copy; {{ now()->year }}
                <a href="{{ config('app.url') }}">
                    <span class="font-semibold">{{ setting('general.site_name') ?? 'ERP System' }}</span>
                </a>
                <span class="ml-2 px-2 py-0.5 text-xs bg-blue-100 text-blue-800 rounded-md dark:bg-blue-800 dark:text-blue-100">
                    v1.0
                </span>
                . Developed with <a target="_blank" href="https://github.com/BroCode-glithch">❤️</a>. All rights reserved.
            </div>

            <div class="flex gap-4 mt-2 sm:mt-0">
                <a href="{{ route('policy') }}" class="hover:underline">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="hover:underline">Terms</a>
                <a href="mailto:emmaariyom1@gmail.com" class="hover:underline">Contact</a>
            </div>
        </div>
    </footer>