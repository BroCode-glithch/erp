    <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Line Chart -->
            <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
               <h4 class="mb-4 text-base font-semibold text-gray-700 dark:text-gray-100">User Growth (Monthly)</h4>
                <div class="relative h-64">
                    <canvas id="userGrowthChart"></canvas>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <h4 class="mb-4 text-base font-semibold text-gray-700 dark:text-gray-100">User Roles Distribution</h4>
                <div class="relative h-64">
                    <canvas id="rolePieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
