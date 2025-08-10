<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Fuzzy Time Series - Perhitungan Stunting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 40px 0;
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 600;
        }
        .table-custom {
            border-radius: 10px;
            overflow: hidden;
        }
        .table-custom th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }
        .summary-card {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }
        .nav-tabs-custom .nav-link {
            border: none;
            border-radius: 10px 10px 0 0;
            margin-right: 5px;
        }
        .nav-tabs-custom .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold mb-3">
                        <i class="fas fa-chart-line me-3"></i>
                        Hasil Perhitungan Fuzzy Time Series
                    </h1>
                    <p class="lead mb-0">
                        Prediksi stunting menggunakan algoritma Fuzzy Time Series
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <!-- Back Button -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('fuzzy-time-series.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Form
                </a>
            </div>
        </div>

        <!-- Summary Cards -->
        @if(!empty($results['summary']))
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card summary-card text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-calculator fa-2x mb-2"></i>
                        <h4>{{ $results['summary']['total_prediksi'] }}</h4>
                        <p class="mb-0">Total Prediksi</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card summary-card text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                        <h4>{{ $results['summary']['prediksi_akurat'] }}</h4>
                        <p class="mb-0">Prediksi Akurat</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card summary-card text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-percentage fa-2x mb-2"></i>
                        <h4>{{ $results['summary']['akurasi_rata_rata'] }}%</h4>
                        <p class="mb-0">Akurasi Rata-rata</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card summary-card text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-trophy fa-2x mb-2"></i>
                        <h4>{{ $results['summary']['tingkat_keberhasilan'] }}%</h4>
                        <p class="mb-0">Tingkat Keberhasilan</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Tabs -->
        <div class="card card-custom">
            <div class="card-header bg-white border-0">
                <ul class="nav nav-tabs nav-tabs-custom" id="resultTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="intervals-tab" data-bs-toggle="tab" data-bs-target="#intervals" type="button" role="tab">
                            <i class="fas fa-list me-2"></i>Intervals
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="fuzzy-sets-tab" data-bs-toggle="tab" data-bs-target="#fuzzy-sets" type="button" role="tab">
                            <i class="fas fa-project-diagram me-2"></i>Fuzzy Sets
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="relationships-tab" data-bs-toggle="tab" data-bs-target="#relationships" type="button" role="tab">
                            <i class="fas fa-link me-2"></i>Fuzzy Relationships
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="predictions-tab" data-bs-toggle="tab" data-bs-target="#predictions" type="button" role="tab">
                            <i class="fas fa-chart-line me-2"></i>Predictions
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="resultTabsContent">
                    <!-- Intervals Tab -->
                    <div class="tab-pane fade show active" id="intervals" role="tabpanel">
                        <h5 class="mb-3">Interval Fuzzy Sets</h5>
                        <div class="table-responsive">
                            <table class="table table-custom table-striped">
                                <thead>
                                    <tr>
                                        <th>Label</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Midpoint</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['intervals'] as $interval)
                                    <tr>
                                        <td><span class="badge bg-primary">{{ $interval['label'] }}</span></td>
                                        <td>{{ $interval['start'] }}</td>
                                        <td>{{ $interval['end'] }}</td>
                                        <td><strong>{{ $interval['midpoint'] }}</strong></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Fuzzy Sets Tab -->
                    <div class="tab-pane fade" id="fuzzy-sets" role="tabpanel">
                        <h5 class="mb-3">Data Fuzzifikasi</h5>
                        <div class="table-responsive">
                            <table class="table table-custom table-striped">
                                <thead>
                                    <tr>
                                        <th>Wilayah</th>
                                        <th>Tahun</th>
                                        <th>Bulan</th>
                                        <th>Nilai Asli</th>
                                        <th>Fuzzy Set</th>
                                        <th>Midpoint</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['fuzzy_sets'] as $fuzzySet)
                                    <tr>
                                        <td>{{ $fuzzySet['wilayah'] }}</td>
                                        <td>{{ $fuzzySet['tahun'] }}</td>
                                        <td>{{ $fuzzySet['bulan'] ?? '-' }}</td>
                                        <td>{{ $fuzzySet['nilai_asli'] }}%</td>
                                        <td><span class="badge bg-success">{{ $fuzzySet['fuzzy_set'] }}</span></td>
                                        <td>{{ $fuzzySet['midpoint'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Fuzzy Relationships Tab -->
                    <div class="tab-pane fade" id="relationships" role="tabpanel">
                        <h5 class="mb-3">Fuzzy Relationships</h5>
                        <div class="table-responsive">
                            <table class="table table-custom table-striped">
                                <thead>
                                    <tr>
                                        <th>Tahun</th>
                                        <th>Bulan</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Relationship</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['fuzzy_relationships'] as $relationship)
                                    <tr>
                                        <td>{{ $relationship['tahun'] }}</td>
                                        <td>{{ $relationship['bulan'] ?? '-' }}</td>
                                        <td><span class="badge bg-info">{{ $relationship['from'] }}</span></td>
                                        <td><span class="badge bg-warning">{{ $relationship['to'] }}</span></td>
                                        <td>
                                            <i class="fas fa-arrow-right text-primary"></i>
                                            {{ $relationship['from'] }} → {{ $relationship['to'] }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Predictions Tab -->
                    <div class="tab-pane fade" id="predictions" role="tabpanel">
                        <h5 class="mb-3">Hasil Prediksi</h5>
                        <div class="table-responsive">
                            <table class="table table-custom table-striped">
                                <thead>
                                    <tr>
                                        <th>Tahun</th>
                                        <th>Bulan</th>
                                        <th>Fuzzy Set Aktual</th>
                                        <th>Fuzzy Set Prediksi</th>
                                        <th>Nilai Prediksi</th>
                                        <th>Akurasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['predictions'] as $prediction)
                                    <tr>
                                        <td>{{ $prediction['tahun'] }}</td>
                                        <td>{{ $prediction['bulan'] ?? '-' }}</td>
                                        <td><span class="badge bg-info">{{ $prediction['fuzzy_set_aktual'] }}</span></td>
                                        <td><span class="badge bg-warning">{{ $prediction['fuzzy_set_prediksi'] }}</span></td>
                                        <td><strong>{{ $prediction['nilai_prediksi'] }}%</strong></td>
                                        <td>
                                            @if($prediction['akurasi'] == 100)
                                                <span class="badge bg-success">{{ $prediction['akurasi'] }}%</span>
                                            @elseif($prediction['akurasi'] >= 80)
                                                <span class="badge bg-warning">{{ $prediction['akurasi'] }}%</span>
                                            @else
                                                <span class="badge bg-danger">{{ $prediction['akurasi'] }}%</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
