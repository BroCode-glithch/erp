@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-4">Edit Role</h1>

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Role Name</label>
            <input type="text" name="name" id="name"
                   class="mt-1 block w-full p-2 border rounded @error('name') border-red-500 @enderror"
                   value="{{ old('name', $role->name) }}" required>

            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.roles.index') }}" class="text-gray-600 hover:underline mr-4">Cancel</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Update Role
            </button>
        </div>
    </form>
</div>
@endsection
