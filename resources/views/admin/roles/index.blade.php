@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Roles</h1>

    <a href="{{ route('admin.roles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create Role</a>

    <div class="mt-6 bg-white shadow rounded">
        <table class="min-w-full text-sm">
            <thead>
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach(range(1, 5) as $id)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $id }}</td>
                        <td class="px-4 py-2">Role {{ $id }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('admin.roles.edit', $id) }}" class="text-blue-600">Edit</a>
                            <a href="{{ route('admin.roles.permissions.edit', $id) }}" class="text-green-600">Permissions</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
