<div>
    @if (session('success') || session('error'))
        <div id="toast"
            class="fixed z-50 flex items-start max-w-xs p-4 space-x-3 text-gray-100 bg-indigo-900 border border-gray-300 rounded-lg shadow-lg bottom-6 right-6 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100 animate-slide-in">
            <div class="flex-1">
                <strong class="font-semibold">
                    {{ session('success') ? 'Success' : 'Error' }}
                </strong>
                <div class="mt-1 text-sm">
                    {{ session('success') ?? session('error') }}
                </div>
            </div>
            <button onclick="closeToast()" class="ml-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                &times;
            </button>

            <!-- Progress Bar -->
            <div class="absolute bottom-0 left-0 h-1 bg-white animate-progress"></div>
        </div>

        <script>
            function closeToast() {
                document.getElementById('toast')?.remove();
            }

            setTimeout(() => {
                closeToast();
            }, 5000); // 5 seconds
        </script>

        <style>
            @keyframes slide-in {
                from {
                    opacity: 0;
                    transform: translateX(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
            .animate-slide-in {
                animation: slide-in 0.5s ease-out;
            }

            @keyframes progress {
                from {
                    width: 100%;
                }
                to {
                    width: 0%;
                }
            }
            .animate-progress {
                animation: progress 5s linear forwards;
            }
        </style>
    @endif

</div>
