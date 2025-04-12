<header class="p-4 text-white bg-gray-800">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.dashboard') }}">
            <h1 class="text-xl font-semibold">{{ env('APP_NAME') }}</h1>
        </a>

        <!-- User Dropdown for Profile, Notifications & Logout -->
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                    <!-- Profile Picture (Empty for now) -->
                    <div class="flex items-center justify-center w-8 h-8 bg-gray-300 rounded-full">
                        <!-- Placeholder profile picture, can replace with actual user image later -->
                        <span class="text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>

                    <div class="ml-2">{{ Auth::user()->name }}</div>

                    <div class="ms-1">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <!-- Notification Bell Icon with unread count -->
                <div class="flex items-center px-4 py-1 space-x-3">
                    <a href="#" class="relative" data-dropdown-toggle="notificationsDropdown">
                        <i class="text-2xl fas fa-bell"></i>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute top-0 right-0 inline-block w-5 h-5 text-xs text-center text-gray-800 bg-red-500 rounded-full">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>
                </div>

                <!-- Notifications Dropdown (toggle visibility on click) -->
                <div id="notificationsDropdown" class="absolute right-0 hidden w-64 mt-2 bg-white border rounded-md shadow-md">
                    <ul class="p-3 space-y-2">
                        <!-- Mark All as Read Button -->
                        <form action="{{ route('admin.notifications.read') }}" method="POST" class="mb-3">
                            @csrf
                            <button type="submit" class="w-full text-sm text-left text-blue-600 hover:underline">
                                Mark all as read
                            </button>
                        </form> 

                        @if(auth()->user()->unreadNotifications->isEmpty())
                            <li class="p-3 text-sm text-gray-600 border border-gray-200 rounded-md bg-gray-50">
                                No new notifications.
                            </li>
                        @else
                            @foreach (auth()->user()->unreadNotifications as $notification)
                                <li class="p-3 text-sm text-gray-600 border border-gray-200 rounded-md bg-gray-50">
                                    <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full text-left">
                                            {{ $notification->data['message'] ?? 'New activity on your account.' }}
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- User Profile Link -->
                <x-dropdown-link :href="route('admin.profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>

<!-- Add JavaScript to toggle notification dropdown -->
<script>
    document.querySelector('[data-dropdown-toggle="notificationsDropdown"]').addEventListener('click', function () {
        const dropdown = document.getElementById('notificationsDropdown');
        dropdown.classList.toggle('hidden');
    });

    // Optionally, add a close handler when clicking outside of the dropdown
    window.addEventListener('click', function(e) {
        if (!e.target.closest('[data-dropdown-toggle="notificationsDropdown"]') && !e.target.closest('#notificationsDropdown')) {
            const dropdown = document.getElementById('notificationsDropdown');
            if (!dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        }
    });
</script>
