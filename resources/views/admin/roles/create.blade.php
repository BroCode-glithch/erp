@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Create Role</h1>

    <form method="POST" action="#">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium">Role Name</label>
            <input type="text" name="name" class="mt-1 p-2 border rounded w-full" placeholder="e.g., Admin">
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
