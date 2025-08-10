<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Wilayah - Fuzzy Time Series</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-brain text-indigo-600 text-2xl"></i>
                    </div>
                    <div class="ml-2 text-xl font-bold text-gray-900">Fuzzy System</div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                        <i class="fas fa-home mr-1"></i>
                        Home
                    </a>
                    <a href="{{ route('public.results') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                        <i class="fas fa-chart-line mr-1"></i>
                        Results
                    </a>
                    <a href="{{ route('public.stunting-data') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                        <i class="fas fa-child mr-1"></i>
                        Stunting Data
                    </a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Public Regional Data</h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Explore demographic and socioeconomic data across different regions
                    </p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('public.results') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-chart-line mr-2"></i>
                        View Results
                    </a>
                    <a href="{{ route('public.stunting-data') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-child mr-2"></i>
                        Stunting Data
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-blue-600 text-3xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Regions</dt>
                                <dd class="text-lg font-medium text-gray-900">15</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users text-green-600 text-3xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Population</dt>
                                <dd class="text-lg font-medium text-gray-900">2.1M</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-hospital text-purple-600 text-3xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Healthcare Facilities</dt>
                                <dd class="text-lg font-medium text-gray-900">127</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-graduation-cap text-indigo-600 text-3xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Education Level</dt>
                                <dd class="text-lg font-medium text-gray-900">High</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Population Distribution Chart -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Population Distribution by Region</h3>
                <canvas id="populationChart" width="400" height="200"></canvas>
            </div>

            <!-- Healthcare Access Chart -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Healthcare Access by Region</h3>
                <canvas id="healthcareChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Regional Data Table -->
        <div class="bg-white shadow rounded-lg mb-8">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Regional Demographic Data</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Region</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Population</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Area (km²)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Density</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Healthcare</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Education</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Jakarta Pusat</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1,056,896</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">48.13</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">21,956</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Excellent
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        High
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Jakarta Selatan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2,226,544</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">141.27</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15,756</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Good
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Medium
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Jakarta Barat</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2,434,511</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">129.54</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">18,799</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Good
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Medium
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Jakarta Timur</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2,843,816</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">187.73</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15,154</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Fair
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Medium
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Jakarta Utara</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1,747,315</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">146.66</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">11,916</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Good
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        High
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Infrastructure and Services -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Infrastructure Overview</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Roads (km)</span>
                        <span class="text-sm font-medium text-gray-900">2,847</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Bridges</span>
                        <span class="text-sm font-medium text-gray-900">156</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Public Transportation</span>
                        <span class="text-sm font-medium text-gray-900">24 routes</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Water Supply</span>
                        <span class="text-sm font-medium text-gray-900">98.5%</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Electricity Coverage</span>
                        <span class="text-sm font-medium text-gray-900">99.8%</span>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Social Services</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Schools</span>
                        <span class="text-sm font-medium text-gray-900">1,247</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Hospitals</span>
                        <span class="text-sm font-medium text-gray-900">23</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Clinics</span>
                        <span class="text-sm font-medium text-gray-900">104</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Police Stations</span>
                        <span class="text-sm font-medium text-gray-900">45</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Fire Stations</span>
                        <span class="text-sm font-medium text-gray-900">18</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Economic Indicators -->
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Economic Indicators</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="text-2xl font-bold text-indigo-600">$12,847</div>
                    <div class="text-sm text-gray-500">Average Income</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">4.2%</div>
                    <div class="text-sm text-gray-500">Unemployment Rate</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600">$45.2B</div>
                    <div class="text-sm text-gray-500">GDP Contribution</div>
                </div>
            </div>
        </div>

        <!-- Environmental Data -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Environmental Quality</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Air Quality Index</span>
                        <span class="text-sm font-medium text-yellow-600">Moderate</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Green Space</span>
                        <span class="text-sm font-medium text-gray-900">12.3%</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Waste Management</span>
                        <span class="text-sm font-medium text-green-600">Good</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Water Quality</span>
                        <span class="text-sm font-medium text-blue-600">Fair</span>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Development Projects</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <i class="fas fa-tools text-blue-500 mr-3"></i>
                        <span class="text-sm text-gray-600">Smart City Infrastructure</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-leaf text-green-500 mr-3"></i>
                        <span class="text-sm text-gray-600">Green Building Initiative</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-wifi text-purple-500 mr-3"></i>
                        <span class="text-sm text-gray-600">Digital Connectivity</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-bus text-orange-500 mr-3"></i>
                        <span class="text-sm text-gray-600">Public Transport Enhancement</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 mt-12">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-base text-gray-400">
                    &copy; 2024 Fuzzy System. Public data for educational and research purposes.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Population Distribution Chart
        const populationCtx = document.getElementById('populationChart').getContext('2d');
        new Chart(populationCtx, {
            type: 'doughnut',
            data: {
                labels: ['Jakarta Pusat', 'Jakarta Selatan', 'Jakarta Barat', 'Jakarta Timur', 'Jakarta Utara'],
                datasets: [{
                    data: [1056896, 2226544, 2434511, 2843816, 1747315],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(139, 92, 246, 0.8)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(239, 68, 68, 1)',
                        'rgba(139, 92, 246, 1)'
                    ],
                    borderWidth: 2
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

        // Healthcare Access Chart
        const healthcareCtx = document.getElementById('healthcareChart').getContext('2d');
        new Chart(healthcareCtx, {
            type: 'bar',
            data: {
                labels: ['Jakarta Pusat', 'Jakarta Selatan', 'Jakarta Barat', 'Jakarta Timur', 'Jakarta Utara'],
                datasets: [{
                    label: 'Healthcare Facilities per 100k',
                    data: [45, 32, 28, 22, 35],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(16, 185, 129, 0.8)'
                    ],
                    borderColor: [
                        'rgba(16, 185, 129, 1)',
                        'rgba(59, 130, 246, 1)',
                        'rgba(59, 130, 246, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(16, 185, 129, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 50
                    }
                }
            }
        });
    </script>
</body>
</html>
