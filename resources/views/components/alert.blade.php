@props(['type' => 'info', 'message'])

@php
$colors = [
    'success' => 'bg-green-100 text-green-800',
    'error' => 'bg-red-100 text-red-800',
    'warning' => 'bg-yellow-100 text-yellow-800',
    'info' => 'bg-blue-100 text-blue-800',
];
@endphp

<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 4000)"
    class="{{ $colors[$type] ?? $colors['info'] }} px-4 py-2 rounded mb-4"
>
    {{ $message }}
</div>
