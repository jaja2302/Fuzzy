<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuzzy Time Series</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
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
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                    Logout
                                </button>
                            </form>
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

        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto">
                <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                    <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                        <div class="sm:text-center lg:text-left">
                            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                                <span class="block xl:inline">Advanced</span>
                                <span class="block text-indigo-600 xl:inline">Fuzzy Logic</span>
                                <span class="block xl:inline">System</span>
                            </h1>
                            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                Experience the power of fuzzy time series analysis for accurate predictions and intelligent decision-making. 
                                Our system combines advanced algorithms with user-friendly interfaces.
                            </p>
                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                <div class="rounded-md shadow">
                                    <a href="{{ route('fuzzy-time-series.index') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                        <i class="fas fa-play mr-2"></i>
                                        Try Fuzzy Analysis
                                    </a>
                                </div>
                                <div class="mt-3 sm:mt-0 sm:ml-3">
                                    <a href="{{ route('public.results') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-10">
                                        <i class="fas fa-chart-line mr-2"></i>
                                        View Results
                                    </a>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Features</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Everything you need for fuzzy analysis
                    </p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                        Our comprehensive system provides all the tools needed for effective fuzzy time series analysis and prediction.
                    </p>
                </div>

                <div class="mt-10">
                    <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                        <div class="relative">
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <i class="fas fa-brain text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Fuzzy Logic Engine</p>
                            <p class="mt-2 ml-16 text-base text-gray-500">
                                Advanced fuzzy logic algorithms for handling uncertainty and imprecision in time series data.
                            </p>
                        </div>

                        <div class="relative">
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <i class="fas fa-chart-line text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Time Series Analysis</p>
                            <p class="mt-2 ml-16 text-base text-gray-500">
                                Comprehensive time series analysis with visualization and prediction capabilities.
                            </p>
                        </div>

                        <div class="relative">
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">User Management</p>
                            <p class="mt-2 ml-16 text-base text-gray-500">
                                Secure user authentication and role-based access control for your data and analysis.
                            </p>
                        </div>

                        <div class="relative">
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <i class="fas fa-database text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Data Management</p>
                            <p class="mt-2 ml-16 text-base text-gray-500">
                                Efficient CRUD operations for managing wilayah and stunting data with full validation.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Public Data Section -->
        <div class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Public Data</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Access insights without registration
                    </p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                        Explore our public data and results to see the power of fuzzy logic analysis in action.
                    </p>
                </div>

                <div class="mt-10">
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-chart-line text-indigo-600 text-3xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-900">Analysis Results</h3>
                                        <p class="text-sm text-gray-500">View the latest fuzzy time series results</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('public.results') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                        View Results
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-child text-green-600 text-3xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-900">Stunting Data</h3>
                                        <p class="text-sm text-gray-500">Explore public stunting statistics</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('public.stunting-data') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                        View Data
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-map-marker-alt text-blue-600 text-3xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-900">Regional Data</h3>
                                        <p class="text-sm text-gray-500">Browse wilayah information</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('public.wilayah-data') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                        View Data
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-indigo-700">
            <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    <span class="block">Ready to get started?</span>
                    <span class="block">Start your fuzzy analysis today.</span>
                </h2>
                <p class="mt-4 text-lg leading-6 text-indigo-200">
                    Join thousands of users who trust our fuzzy logic system for accurate predictions and insights.
                </p>
                <div class="mt-8 flex justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 sm:w-auto">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-500 border border-transparent rounded-md hover:bg-indigo-600 sm:w-auto">
                            <i class="fas fa-user-plus mr-2"></i>
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center">
                            <i class="fas fa-brain text-indigo-400 text-2xl"></i>
                            <span class="ml-2 text-xl font-bold text-white">Fuzzy System</span>
                        </div>
                        <p class="mt-4 text-gray-300">
                            Advanced fuzzy logic system for time series analysis and prediction. 
                            Experience the power of intelligent algorithms.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Features</h3>
                        <ul class="mt-4 space-y-4">
                            <li><a href="{{ route('fuzzy-time-series.index') }}" class="text-base text-gray-300 hover:text-white">Fuzzy Analysis</a></li>
                            <li><a href="{{ route('public.results') }}" class="text-base text-gray-300 hover:text-white">Public Results</a></li>
                            <li><a href="{{ route('public.stunting-data') }}" class="text-base text-gray-300 hover:text-white">Stunting Data</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Account</h3>
                        <ul class="mt-4 space-y-4">
                            @auth
                                <li><a href="{{ url('/dashboard') }}" class="text-base text-gray-300 hover:text-white">Dashboard</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-base text-gray-300 hover:text-white bg-transparent border-0 p-0">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li><a href="{{ route('login') }}" class="text-base text-gray-300 hover:text-white">Login</a></li>
                                <li><a href="{{ route('register') }}" class="text-base text-gray-300 hover:text-white">Register</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-700 pt-8">
                    <p class="text-base text-gray-400 text-center">
                        &copy; 2024 Fuzzy System. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>
