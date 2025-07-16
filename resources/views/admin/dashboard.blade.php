@extends('layouts.admin')

@section('title', 'Dashboard | Admin | ' . setting('general.site_name'))

@section('content')
    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">

        {{-- Notifications --}}
        <x-admin.notification />

        {{-- Quick Actions --}}
        <x-admin.quick-actions />

        {{-- Stats Cards --}}
        <x-admin.stats-card :counts="$counts" />

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
            const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
            new Chart(userGrowthCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Users Joined',
                        data: [10, 20, 30, 25, 40, 60],
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            const rolePieCtx = document.getElementById('rolePieChart').getContext('2d');
            new Chart(rolePieCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Admin', 'Editor', 'Viewer'],
                    datasets: [{
                        data: [5, 8, 12],
                        backgroundColor: ['#10B981', '#FBBF24', '#EF4444'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection
