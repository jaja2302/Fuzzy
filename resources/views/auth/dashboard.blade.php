@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-4">
        <div class="p-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
            <h2 class="text-2xl font-bold mb-2">Welcome to your Dashboard</h2>
            <p class="text-indigo-100">Manage your data and view fuzzy time series results</p>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-primary fs-2"></i>
                        </div>
                        <div class="ms-3">
                            <p class="text-muted mb-0">Wilayah</p>
                            <h5 class="mb-0">Manage</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-chart-line text-success fs-2"></i>
                        </div>
                        <div class="ms-3">
                            <p class="text-muted mb-0">Stunting Data</p>
                            <h5 class="mb-0">Manage</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-brain text-info fs-2"></i>
                        </div>
                        <div class="ms-3">
                            <p class="text-muted mb-0">Fuzzy Results</p>
                            <h5 class="mb-0">View</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Cards -->
    <div class="row">
        <!-- Wilayah Management -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-map-marker-alt text-primary fs-3 me-3"></i>
                        <h5 class="card-title mb-0">Wilayah Management</h5>
                    </div>
                    <p class="card-text text-muted">Manage geographical regions and administrative areas</p>
                    <a href="{{ route('wilayah.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-right me-2"></i>Go to Wilayah
                    </a>
                </div>
            </div>
        </div>

        <!-- Stunting Management -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-chart-line text-success fs-3 me-3"></i>
                        <h5 class="card-title mb-0">Stunting Management</h5>
                    </div>
                    <p class="card-text text-muted">Manage stunting data and statistics</p>
                    <a href="{{ route('stunting.index') }}" class="btn btn-success">
                        <i class="fas fa-arrow-right me-2"></i>Go to Stunting
                    </a>
                </div>
            </div>
        </div>

        <!-- Fuzzy Time Series -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-brain text-info fs-3 me-3"></i>
                        <h5 class="card-title mb-0">Fuzzy Time Series</h5>
                    </div>
                    <p class="card-text text-muted">View and analyze fuzzy time series results</p>
                    <a href="{{ route('fuzzy-time-series.index') }}" class="btn btn-info">
                        <i class="fas fa-arrow-right me-2"></i>Go to Results
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
