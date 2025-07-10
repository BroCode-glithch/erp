@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Edit User</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
            <input type="text" name="name" id="name"
                   class="mt-1 block w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-100 @error('name') border-red-500 @enderror"
                   value="{{ old('name', $user->name) }}" required>
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" name="email" id="email"
                   class="mt-1 block w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-100 @error('email') border-red-500 @enderror"
                   value="{{ old('email', $user->email) }}" required>
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password <span class="text-gray-500 text-xs">(Leave blank to keep current)</span></label>
            <input type="password" name="password" id="password"
                   class="mt-1 block w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-100 @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Roles -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Roles</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                @foreach($roles as $role)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="roles[]"
                               value="{{ $role->id }}"
                               class="rounded text-blue-600 dark:bg-gray-700 dark:border-gray-600"
                               {{ $user->roles->pluck('id')->contains($role->id) ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-800 dark:text-gray-200">{{ $role->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end">
            <a href="{{ route('admin.users.index') }}"
               class="text-gray-600 dark:text-gray-300 hover:underline mr-4">Cancel</a>
            <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Update User
            </button>
        </div>
    </form>
</div>
@endsection
