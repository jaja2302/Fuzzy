@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Welcome Section -->
    <div class="bg-white shadow-md rounded-lg mb-6 overflow-hidden">
        <div class="p-6 bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
            <h2 class="text-2xl font-bold mb-2">Welcome to your Dashboard</h2>
            <p class="text-indigo-100">Manage your data and view fuzzy time series results</p>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-map-marker-alt text-blue-500 text-2xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-gray-500 mb-0">Wilayah</p>
                    <h5 class="font-medium mb-0">Manage</h5>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-chart-line text-green-500 text-2xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-gray-500 mb-0">Stunting Data</p>
                    <h5 class="font-medium mb-0">Manage</h5>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-brain text-blue-400 text-2xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-gray-500 mb-0">Fuzzy Results</p>
                    <h5 class="font-medium mb-0">View</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Wilayah Management -->
        <div class="bg-white rounded-lg shadow p-6 h-full">
            <div class="flex items-center mb-4">
                <i class="fas fa-map-marker-alt text-blue-500 text-3xl mr-3"></i>
                <h5 class="font-medium text-lg">Wilayah Management</h5>
            </div>
            <p class="text-gray-500 mb-4">Manage geographical regions and administrative areas</p>
            <a href="{{ route('wilayah.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                <i class="fas fa-arrow-right mr-2"></i>Go to Wilayah
            </a>
        </div>

        <!-- Stunting Management -->
        <div class="bg-white rounded-lg shadow p-6 h-full">
            <div class="flex items-center mb-4">
                <i class="fas fa-chart-line text-green-500 text-3xl mr-3"></i>
                <h5 class="font-medium text-lg">Stunting Management</h5>
            </div>
            <p class="text-gray-500 mb-4">Manage stunting data and statistics</p>
            <a href="{{ route('stunting.index') }}" class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                <i class="fas fa-arrow-right mr-2"></i>Go to Stunting
            </a>
        </div>

        <!-- Fuzzy Time Series -->
        <div class="bg-white rounded-lg shadow p-6 h-full">
            <div class="flex items-center mb-4">
                <i class="fas fa-brain text-blue-400 text-3xl mr-3"></i>
                <h5 class="font-medium text-lg">Fuzzy Time Series</h5>
            </div>
            <p class="text-gray-500 mb-4">View and analyze fuzzy time series results</p>
            <a href="{{ route('fuzzy-time-series.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-400 text-white rounded hover:bg-blue-500 transition">
                <i class="fas fa-arrow-right mr-2"></i>Go to Results
            </a>
        </div>
    </div>
</div>
@endsection
