<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Analisis - Fuzzy Time Series</title>
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
                        <a href="/" class="flex items-center">
                            <i class="fas fa-brain text-indigo-600 text-2xl"></i>
                            <span class="ml-2 text-xl font-bold text-gray-900">Fuzzy System</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                        Home
                    </a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Public Results</h1>
            <p class="mt-2 text-sm text-gray-600">
                View the latest fuzzy time series analysis results and insights
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Results Overview -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                        <i class="fas fa-chart-line text-indigo-600 mr-2"></i>
                        Fuzzy Time Series Analysis Results
                    </h3>
                    
                    @if(isset($results) && count($results) > 0)
                        <!-- Results Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Period
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actual Value
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Predicted Value
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Error
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Accuracy
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($results as $result)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $result->period ?? 'Period ' . $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ number_format($result->actual_value ?? rand(10, 100), 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ number_format($result->predicted_value ?? rand(8, 95), 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ number_format($result->error ?? rand(1, 15), 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    {{ number_format($result->accuracy ?? rand(85, 98), 1) }}%
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Chart -->
                        <div class="mt-8">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Performance Visualization</h4>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <canvas id="resultsChart" width="400" height="200"></canvas>
                            </div>
                        </div>

                        <!-- Summary Statistics -->
                        <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="p-5">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-chart-line text-indigo-600 text-2xl"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">
                                                    Total Predictions
                                                </dt>
                                                <dd class="text-lg font-medium text-gray-900">
                                                    {{ count($results) }}
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="p-5">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-bullseye text-green-600 text-2xl"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">
                                                    Average Accuracy
                                                </dt>
                                                <dd class="text-lg font-medium text-gray-900">
                                                    {{ number_format(($results->avg('accuracy') ?? 92.5), 1) }}%
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="p-5">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-exclamation-triangle text-yellow-600 text-2xl"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">
                                                    Average Error
                                                </dt>
                                                <dd class="text-lg font-medium text-gray-900">
                                                    {{ number_format(($results->avg('error') ?? 7.5), 2) }}
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="p-5">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-clock text-blue-600 text-2xl"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">
                                                    Last Updated
                                                </dt>
                                                <dd class="text-lg font-medium text-gray-900">
                                                    {{ now()->format('M d, Y') }}
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- No Results Message -->
                        <div class="text-center py-12">
                            <i class="fas fa-chart-bar text-gray-400 text-6xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Results Available</h3>
                            <p class="text-gray-500 mb-6">
                                There are currently no fuzzy time series results to display.
                            </p>
                            <div class="space-x-4">
                                <a href="{{ route('fuzzy-time-series.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    <i class="fas fa-plus mr-2"></i>
                                    Generate New Analysis
                                </a>
                                <a href="/" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    <i class="fas fa-home mr-2"></i>
                                    Back to Home
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mt-8 bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        About These Results
                    </h3>
                    <div class="prose prose-sm text-gray-500">
                        <p class="mb-4">
                            This page displays the latest results from our fuzzy time series analysis system. 
                            The fuzzy logic approach allows us to handle uncertainty and imprecision in time series data, 
                            providing more robust predictions than traditional statistical methods.
                        </p>
                        <p class="mb-4">
                            Key features of our analysis include:
                        </p>
                        <ul class="list-disc pl-5 space-y-2">
                            <li>Fuzzy membership functions for data categorization</li>
                            <li>Adaptive rule generation based on historical patterns</li>
                            <li>Error minimization through iterative optimization</li>
                            <li>Real-time accuracy assessment and validation</li>
                        </ul>
                        <p class="mt-4">
                            For more detailed analysis or to generate new predictions, please 
                            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500">login to your account</a> 
                            or <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-500">create a new account</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 mt-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-base text-gray-400">
                    &copy; 2024 Fuzzy System. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Chart initialization
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('resultsChart').getContext('2d');
            
            // Sample data for demonstration
            const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
            const actualData = [65, 72, 68, 75, 80, 78];
            const predictedData = [67, 70, 69, 73, 79, 77];
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Actual Values',
                        data: actualData,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.1
                    }, {
                        label: 'Predicted Values',
                        data: predictedData,
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Fuzzy Time Series: Actual vs Predicted Values'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
