<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Users: Line Chart -->
        <x-admin.chart-card title="User Growth (Monthly)" chart-id="userChart" />

        <!-- Roles: Doughnut Chart -->
        <x-admin.chart-card title="Roles Distribution" chart-id="roleChart" />

        <!-- Programs: Bar Chart -->
        <x-admin.chart-card title="Programs by Students" chart-id="programChart" />

        <!-- Departments: Pie Chart -->
        <x-admin.chart-card title="Departments by Program Count" chart-id="departmentChart" />
    </div>
</div>
