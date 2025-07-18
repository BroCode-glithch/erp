@props(['title', 'chartId'])

<div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
    <h4 class="mb-4 text-base font-semibold text-gray-700 dark:text-gray-100">{{ $title }}</h4>
    <div class="relative h-64">
        <canvas id="{{ $chartId }}"></canvas>
    </div>
</div>
