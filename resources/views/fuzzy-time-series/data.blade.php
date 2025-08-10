<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuzzy Time Series - Raw Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('fuzzy-time-series.index') }}" class="text-gray-900 hover:text-gray-700 font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Analysis
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-gray-700 font-medium">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('logout') }}" class="text-red-600 hover:text-red-800 font-medium">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Fuzzy Time Series - Raw Data</h1>
            <p class="mt-2 text-gray-600">View and analyze the raw stunting data used in fuzzy time series calculations</p>
        </div>

        <!-- Data Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-database text-blue-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Records</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $stuntingData->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-green-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Regions</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $wilayahs->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-calendar text-purple-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Year Range</p>
                            <p class="text-2xl font-semibold text-gray-900">
                                {{ $stuntingData->min('tahun') }} - {{ $stuntingData->max('tahun') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Stunting Data Records</h3>
                <p class="mt-1 text-sm text-gray-500">Complete dataset used for fuzzy time series analysis</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Region</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stunting Rate (%)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Population</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($stuntingData as $data)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $data->wilayah->nama_wilayah ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-500">{{ $data->wilayah->kode_wilayah ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->tahun }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $data->persentase_stunting >= 30 ? 'bg-red-100 text-red-800' : 
                                       ($data->persentase_stunting >= 20 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                    {{ number_format($data->persentase_stunting, 1) }}%
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($data->jumlah_penduduk) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $data->status_aktif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $data->status_aktif ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                <div class="flex flex-col items-center py-8">
                                    <i class="fas fa-database text-gray-300 text-4xl mb-4"></i>
                                    <p class="text-lg font-medium text-gray-900">No data available</p>
                                    <p class="text-gray-500">Stunting data has not been added yet.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Data Analysis Section -->
        @if($stuntingData->count() > 0)
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Stunting Rate Distribution -->
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Stunting Rate Distribution</h3>
                </div>
                <div class="p-6">
                    <canvas id="stuntingDistributionChart" width="400" height="200"></canvas>
                </div>
            </div>

            <!-- Yearly Trends -->
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Yearly Trends</h3>
                </div>
                <div class="p-6">
                    <canvas id="yearlyTrendsChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        @endif
    </div>

    <script>
        @if($stuntingData->count() > 0)
        // Stunting Rate Distribution Chart
        const stuntingCtx = document.getElementById('stuntingDistributionChart').getContext('2d');
        const stuntingData = @json($stuntingData->pluck('persentase_stunting'));
        
        const lowStunting = stuntingData.filter(rate => rate < 20).length;
        const mediumStunting = stuntingData.filter(rate => rate >= 20 && rate < 30).length;
        const highStunting = stuntingData.filter(rate => rate >= 30).length;
        
        new Chart(stuntingCtx, {
            type: 'doughnut',
            data: {
                labels: ['Low (< 20%)', 'Medium (20-30%)', 'High (≥ 30%)'],
                datasets: [{
                    data: [lowStunting, mediumStunting, highStunting],
                    backgroundColor: ['#10B981', '#F59E0B', '#EF4444'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Yearly Trends Chart
        const yearlyCtx = document.getElementById('yearlyTrendsChart').getContext('2d');
        const yearlyData = @json($stuntingData->groupBy('tahun')->map(function($group) {
            return $group->avg('persentase_stunting');
        }));
        
        new Chart(yearlyCtx, {
            type: 'line',
            data: {
                labels: Object.keys(yearlyData),
                datasets: [{
                    label: 'Average Stunting Rate (%)',
                    data: Object.values(yearlyData),
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
        @endif
    </script>
</body>
</html>
