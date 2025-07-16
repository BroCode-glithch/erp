@extends('layouts.admin')

@section('title', 'View Users | Admin | ' . setting('general.site_name'))

@section('content')
    <div class="p-6">
        <div class="max-w-3xl mx-auto">

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden">
                <div class="p-6 space-y-6">
                    <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">User Profile</h1>
                    <!-- User Info Grid -->
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</dt>
                            <dd class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Address</dt>
                            <dd class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $user->email }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</dt>
                            <dd class="text-base text-gray-700 dark:text-gray-300">
                                {{ $user->created_at->format('F j, Y h:i A') }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Login</dt>
                            <dd class="text-base text-gray-700 dark:text-gray-300">
                                {{ $user->last_login_at ? $user->last_login_at->format('F j, Y h:i A') : 'Never' }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                            <dd>
                                @if ($user->is_active)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-700 dark:text-white">
                                        Active
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-700 dark:text-white">
                                        Inactive
                                    </span>
                                @endif
                            </dd>
                        </div>

                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Roles</dt>
                            <dd class="mt-1 flex flex-wrap gap-2">
                                @forelse($user->roles as $role)
                                    <span
                                        class="bg-blue-100 text-blue-800 dark:bg-blue-700 dark:text-white px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $role->name }}
                                    </span>
                                @empty
                                    <span class="text-sm text-gray-500 dark:text-gray-400">No roles assigned.</span>
                                @endforelse
                            </dd>
                        </div>
                    </dl>

                    <!-- Actions -->
                    <div
                        class="flex flex-wrap justify-between items-center pt-6 border-t border-gray-200 dark:border-gray-700 gap-2">
                        <!-- Edit -->
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
                            ✏️ Edit User
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium bg-red-600 hover:bg-red-700 text-white rounded-md transition">
                                🗑️ Delete
                            </button>
                        </form>

                        <!-- Back -->
                        <a href="{{ route('admin.users.index') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-md transition">
                            ← Back to User List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
