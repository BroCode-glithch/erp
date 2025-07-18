@extends('layouts.admin')

@section('title', 'Dashboard | Admin | ' . setting('general.site_name'))

@section('content')
    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">

        {{-- Notifications --}}
        <x-admin.notification />

        {{-- Quick Actions --}}
        <x-admin.quick-actions />

        {{-- Quick Tour --}}
        {{--  <x-admin.quick-tour-actions />  --}}

        {{-- Stats Cards --}}
        <x-admin.stats-card :counts="$counts" />

        {{-- ERP Update Notice --}}
        <div class="mt-6 p-4 text-sm text-blue-800 bg-blue-100 border border-blue-300 rounded-md dark:bg-blue-900 dark:text-blue-200 dark:border-blue-700">
            🚀 Stay tuned for more updates and exciting new features in our {{setting('general.site_name')}} ERP!
        </div>

    </div>

    {{-- Analytics & Charts --}}
    <x-admin.analytics-et-charts />


    {{-- Department --}}
    <x-admin.departments :departments="$departments" />

    <x-admin.users :users="$users" />

    {{-- Programs --}}
    <x-admin.programs :programs="$programs" />

    {{-- Chart Scripts --}}
    @push('scripts')

        <script>

            {{--  // Define one-step tour
            window.startAdminTour = () => {
                introJs().setOptions({
                    steps: [],
                    nextLabel: 'Finish',
                    doneLabel: 'Finish',
                    showProgress: false,
                    showStepNumbers: false,
                }).start();
            };

            // Auto-start only once per admin
            document.addEventListener("DOMContentLoaded", () => {
                if (localStorage.getItem("adminTourDone") !== "yes") {
                    window.startAdminTour();
                    localStorage.setItem("adminTourDone", "yes");
                }
            });  --}}
            

            const chartData = @json($chartData);

            // User Growth - Line Chart
            new Chart(document.getElementById('userChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: chartData.users.labels,
                    datasets: [{
                        label: 'Users Joined',
                        data: chartData.users.data,
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });

            // Role Distribution - Doughnut Chart
            new Chart(document.getElementById('roleChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: chartData.roles.labels,
                    datasets: [{
                        data: chartData.roles.data,
                        backgroundColor: ['#10B981', '#F59E0B', '#EF4444', '#6366F1'],
                    }]
                },
                options: {
                    plugins: { legend: { position: 'bottom' } },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Programs - Single Bar Chart
            new Chart(document.getElementById('programChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: chartData.programs.labels,
                    datasets: [{
                        label: 'Total Programs',
                        data: chartData.programs.data,
                        backgroundColor: '#FBBF24',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            // Departments - Pie Chart with Single Slice (for visual consistency)
            new Chart(document.getElementById('departmentChart').getContext('2d'), {
                type: 'pie',
                data: {
                    labels: chartData.departments.labels,
                    datasets: [{
                        data: chartData.departments.data,
                        backgroundColor: ['#8B5CF6'],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>
    @endpush
@endsection
