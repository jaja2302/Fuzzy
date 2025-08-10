<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Fuzzy System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
                    <div class="ml-4">
                        <h1 class="text-xl font-semibold text-gray-900">Fuzzy System</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Welcome, {{ $user->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-sign-out-alt mr-1"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                <h2 class="text-2xl font-bold mb-2">Welcome to your Dashboard</h2>
                <p class="text-indigo-100">Manage your data and view fuzzy time series results</p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-blue-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Wilayah</p>
                            <p class="text-2xl font-semibold text-gray-900">Manage</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-chart-line text-green-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Stunting Data</p>
                            <p class="text-2xl font-semibold text-gray-900">Manage</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-brain text-purple-600 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Fuzzy Results</p>
                            <p class="text-2xl font-semibold text-gray-900">View</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Wilayah Management -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-map-marker-alt text-blue-600 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold text-gray-900">Wilayah Management</h3>
                    </div>
                    <p class="text-gray-600 mb-4">Manage geographical regions and administrative areas</p>
                    <div class="space-y-2">
                        <a href="{{ route('wilayah.index') }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                            <i class="fas fa-list mr-2"></i>View All
                        </a>
                        <a href="{{ route('wilayah.create') }}" class="block w-full text-center bg-blue-100 hover:bg-blue-200 text-blue-700 font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                            <i class="fas fa-plus mr-2"></i>Add New
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stunting Management -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-chart-line text-green-600 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold text-gray-900">Stunting Data</h3>
                    </div>
                    <p class="text-gray-600 mb-4">Manage stunting data and measurements</p>
                    <div class="space-y-2">
                        <a href="{{ route('stunting.index') }}" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                            <i class="fas fa-list mr-2"></i>View All
                        </a>
                        <a href="{{ route('stunting.create') }}" class="block w-full text-center bg-green-100 hover:bg-green-200 text-green-700 font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                            <i class="fas fa-plus mr-2"></i>Add New
                        </a>
                    </div>
                </div>
            </div>

            <!-- Fuzzy Results -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-brain text-purple-600 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold text-gray-900">Fuzzy Results</h3>
                    </div>
                    <p class="text-gray-600 mb-4">View and analyze fuzzy time series results</p>
                    <div class="space-y-2">
                        <a href="{{ route('fuzzy-time-series.index') }}" class="block w-full text-center bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                            <i class="fas fa-chart-bar mr-2"></i>View Results
                        </a>
                        <a href="{{ route('fuzzy-time-series.data') }}" class="block w-full text-center bg-purple-100 hover:bg-purple-200 text-purple-700 font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                            <i class="fas fa-database mr-2"></i>Raw Data
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Public Access Notice -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-blue-600 text-xl mr-3"></i>
                <div>
                    <h3 class="text-lg font-semibold text-blue-900">Public Access</h3>
                    <p class="text-blue-700">Fuzzy Time Series results are publicly accessible. Anyone can view the analysis results without logging in.</p>
                    <a href="{{ route('fuzzy-time-series.index') }}" class="inline-block mt-2 text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fas fa-external-link-alt mr-1"></i>View Public Results
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
