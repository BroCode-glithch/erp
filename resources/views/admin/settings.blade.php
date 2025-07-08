<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Admin Settings</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">Admin Settings</h1>

        <table class="w-full table-auto border">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-2">Name</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">2FA</th>
                    <th class="p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b">
                        <td class="p-2">{{ $user->name }}</td>
                        <td class="p-2">{{ $user->email }}</td>
                        <td class="p-2">
                            @if ($user->two_factor_enabled)
                                <span class="text-green-600 font-semibold">Enabled</span>
                            @else
                                <span class="text-red-600 font-semibold">Disabled</span>
                            @endif
                        </td>
                        <td class="p-2">
                            <form method="POST" action="{{ route('admin.users.toggle2fa', $user) }}">
                                @csrf
                                <button type="submit" class="px-4 py-1 rounded text-white {{ $user->two_factor_enabled ? 'bg-red-500' : 'bg-green-500' }}">
                                    {{ $user->two_factor_enabled ? 'Disable' : 'Enable' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if (session('status'))
            <div class="mt-4 text-green-600">{{ session('status') }}</div>
        @endif
    </div>
</x-admin-layout>
