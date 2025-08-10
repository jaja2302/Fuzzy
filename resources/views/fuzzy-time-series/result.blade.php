@extends('layouts.app')

@section('title', 'Hasil Fuzzy Time Series')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line"></i>
                        HASIL PERHITUNGAN FUZZY TIME SERIES
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box bg-info">
                                <span class="info-box-icon"><i class="fas fa-database"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Data</span>
                                    <span class="info-box-number">{{ count($results['data']) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="fas fa-chart-bar"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Wilayah</span>
                                    <span class="info-box-number">{{ $results['summary']['total_wilayah'] ?? 0 }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-percentage"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Confidence</span>
                                    <span class="info-box-number">{{ $results['summary']['confidence'] ?? 0 }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-danger">
                                <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Prediksi</span>
                                    <span class="info-box-number">{{ $results['summary']['prediction'] ?? 0 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Info -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Filter yang Digunakan:</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Wilayah:</strong> 
                            @if($wilayahId)
                                @php $wilayah = \App\Models\Wilayah::where('ID_Wilayah', $wilayahId)->first() @endphp
                                {{ $wilayah ? $wilayah->nama_wilayah : 'Tidak ditemukan' }}
                            @else
                                Semua Wilayah
                            @endif
                        </div>
                        <div class="col-md-4">
                            <strong>Tahun Awal:</strong> {{ $tahunAwal ?? 'Semua' }}
                        </div>
                        <div class="col-md-4">
                            <strong>Tahun Akhir:</strong> {{ $tahunAkhir ?? 'Semua' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Universe of Discourse -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5><i class="fas fa-list"></i> UNIVERSE OF DISCOURSE (UoD)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Label</th>
                                    <th>Interval Start</th>
                                    <th>Interval End</th>
                                    <th>Midpoint</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results['uod'] as $index => $uod)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><span class="badge bg-success">{{ $uod['label'] }}</span></td>
                                        <td>{{ number_format($uod['start'], 0) }}</td>
                                        <td>{{ number_format($uod['end'], 0) }}</td>
                                        <td><strong>{{ number_format($uod['midpoint'], 0) }}</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fuzzy Sets -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5><i class="fas fa-layer-group"></i> FUZZY SETS</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Wilayah</th>
                                    <th>Tahun</th>
                                    <th>Bulan</th>
                                    <th>Nilai Asli</th>
                                    <th>Fuzzy Set</th>
                                    <th>Midpoint</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results['fuzzy_sets'] as $index => $fuzzySet)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $fuzzySet['wilayah'] }}</td>
                                        <td>{{ $fuzzySet['tahun'] }}</td>
                                        <td>{{ $fuzzySet['bulan'] }}</td>
                                        <td>{{ number_format($fuzzySet['nilai_asli'], 0) }}</td>
                                        <td><span class="badge bg-info">{{ $fuzzySet['fuzzy_set'] }}</span></td>
                                        <td>{{ number_format($fuzzySet['midpoint'], 0) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fuzzy Logic Groups -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5><i class="fas fa-project-diagram"></i> FUZZY LOGIC GROUPS</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-warning text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Current Fuzzy Set</th>
                                    <th>Next Fuzzy Set</th>
                                    <th>Relationship</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results['fuzzy_logic_groups'] as $index => $group)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><span class="badge bg-warning">{{ $group['current'] }}</span></td>
                                        <td><span class="badge bg-warning">{{ $group['next'] }}</span></td>
                                        <td><strong>{{ $group['relationship'] }}</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fuzzy Relationships Matrix -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5><i class="fas fa-table"></i> FUZZY RELATIONSHIPS MATRIX</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Relationship</th>
                                    <th>Frequency</th>
                                    <th>Probability</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results['fuzzy_relationships_matrix'] as $index => $matrix)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><strong>{{ $matrix['relationship'] }}</strong></td>
                                        <td><span class="badge bg-danger">{{ $matrix['frequency'] }}</span></td>
                                        <td>{{ number_format($matrix['probability'] * 100, 2) }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Defuzzification & Prediction -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5><i class="fas fa-crystal-ball"></i> DEFUZZIFICATION & PREDICTION</h5>
                </div>
                <div class="card-body">
                    @if(isset($results['defuzzification']) && !empty($results['defuzzification']))
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box bg-primary">
                                    <span class="info-box-icon"><i class="fas fa-arrow-right"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Last Fuzzy Set</span>
                                        <span class="info-box-number">{{ $results['defuzzification']['last_fuzzy_set'] }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box bg-success">
                                    <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Predicted Fuzzy Set</span>
                                        <span class="info-box-number">{{ $results['defuzzification']['predicted_fuzzy_set'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="info-box bg-warning">
                                    <span class="info-box-icon"><i class="fas fa-bullseye"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Predicted Value</span>
                                        <span class="info-box-number">{{ number_format($results['defuzzification']['predicted_value'], 0) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box bg-info">
                                    <span class="info-box-icon"><i class="fas fa-percentage"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Confidence</span>
                                        <span class="info-box-number">{{ number_format($results['defuzzification']['confidence'] * 100, 2) }}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-info-circle"></i> Relationship Used:</h6>
                                    <strong>{{ $results['defuzzification']['relationship_used'] }}</strong>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            Tidak ada data defuzzifikasi yang tersedia.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Summary -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5><i class="fas fa-chart-pie"></i> SUMMARY</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box bg-secondary">
                                <span class="info-box-icon"><i class="fas fa-database"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Data</span>
                                    <span class="info-box-number">{{ $results['summary']['total_data'] ?? 0 }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-secondary">
                                <span class="info-box-icon"><i class="fas fa-map-marker-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Wilayah</span>
                                    <span class="info-box-number">{{ $results['summary']['total_wilayah'] ?? 0 }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-secondary">
                                <span class="info-box-icon"><i class="fas fa-calendar"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tahun Range</span>
                                    <span class="info-box-number">{{ $results['summary']['tahun_range'] ? implode(' - ', $results['summary']['tahun_range']) : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-secondary">
                                <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Algorithm</span>
                                    <span class="info-box-number">{{ $results['summary']['algorithm'] ?? 'FTS' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="info-box bg-info">
                                <span class="info-box-icon"><i class="fas fa-arrow-down"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Min Value</span>
                                    <span class="info-box-number">{{ number_format($results['summary']['min_value'] ?? 0, 0) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="fas fa-arrow-up"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Max Value</span>
                                    <span class="info-box-number">{{ number_format($results['summary']['max_value'] ?? 0, 0) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-chart-bar"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Average Value</span>
                                    <span class="info-box-number">{{ number_format($results['summary']['avg_value'] ?? 0, 0) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="row mt-3 mb-3">
        <div class="col-12">
            <a href="{{ route('fuzzy-time-series.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali ke Form
            </a>
            <a href="{{ route('fuzzy-time-series.data') }}" class="btn btn-info">
                <i class="fas fa-database"></i> Lihat Data
            </a>
        </div>
    </div>
</div>
@endsection
