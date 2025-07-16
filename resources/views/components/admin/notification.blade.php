 {{-- Notifications --}}
        @if (auth()->user()->notifications->count())
            <div class="mb-6 p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                        @svg('heroicon-s-bell', 'w-5 h-5 text-blue-500')
                        {{ __('Recent Notifications') }}
                    </h3>
                    <form action="{{ route('admin.notifications.read') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            {{ __('Mark all as read') }}
                        </button>
                    </form>
                </div>
                <ul class="space-y-2">
                    @foreach (auth()->user()->notifications->take(3) as $notification)
                        <li class="px-4 py-3 bg-gray-50 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-700 dark:text-gray-300">
                                    {{ $notification->data['message'] ?? 'You have a new notification.' }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif