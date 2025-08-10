<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuzzy Time Series - Perhitungan Stunting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .card-custom:hover {
            transform: translateY(-5px);
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
        }
        .form-control-custom {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
        }
        .form-control-custom:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">
                        <i class="fas fa-chart-line me-3"></i>
                        Fuzzy Time Series
                    </h1>
                    <p class="lead mb-4">
                        Sistem perhitungan prediksi stunting menggunakan metode Fuzzy Time Series
                    </p>
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="text-center">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <h5>Data Wilayah</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <i class="fas fa-chart-bar fa-2x mb-2"></i>
                                <h5>Analisis Stunting</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <i class="fas fa-brain fa-2x mb-2"></i>
                                <h5>Fuzzy Logic</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-custom">
                    <div class="card-header bg-white border-0 pt-4">
                        <h3 class="text-center mb-0">
                            <i class="fas fa-calculator text-primary me-2"></i>
                            Perhitungan Fuzzy Time Series
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('fuzzy-time-series.calculate') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="wilayah_id" class="form-label fw-bold">
                                        <i class="fas fa-map-marker-alt me-2"></i>Wilayah
                                    </label>
                                    <select name="wilayah_id" id="wilayah_id" class="form-select form-control-custom">
                                        <option value="">Semua Wilayah</option>
                                        @foreach($wilayahs as $wilayah)
                                            <option value="{{ $wilayah->ID_Wilayah }}">
                                                {{ $wilayah->nama_wilayah }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label for="tahun_awal" class="form-label fw-bold">
                                        <i class="fas fa-calendar me-2"></i>Tahun Awal
                                    </label>
                                    <input type="number" name="tahun_awal" id="tahun_awal" 
                                           class="form-control form-control-custom" 
                                           placeholder="2020" min="2000" max="2030">
                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label for="tahun_akhir" class="form-label fw-bold">
                                        <i class="fas fa-calendar me-2"></i>Tahun Akhir
                                    </label>
                                    <input type="number" name="tahun_akhir" id="tahun_akhir" 
                                           class="form-control form-control-custom" 
                                           placeholder="2024" min="2000" max="2030">
                                </div>
                            </div>
                            
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary-custom btn-lg">
                                    <i class="fas fa-play me-2"></i>
                                    Jalankan Perhitungan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Section -->
        <div class="row mt-5">
            <div class="col-lg-4 mb-4">
                <div class="card card-custom h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-database fa-3x text-primary mb-3"></i>
                        <h5>Data Stunting</h5>
                        <p class="text-muted">Data persentase stunting dari berbagai wilayah dan periode waktu</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="card card-custom h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-project-diagram fa-3x text-success mb-3"></i>
                        <h5>Fuzzy Sets</h5>
                        <p class="text-muted">Pembagian data menjadi interval fuzzy untuk analisis yang lebih akurat</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="card card-custom h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-line fa-3x text-warning mb-3"></i>
                        <h5>Prediksi</h5>
                        <p class="text-muted">Hasil prediksi stunting menggunakan algoritma Fuzzy Time Series</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">
                <i class="fas fa-code me-2"></i>
                Sistem Fuzzy Time Series untuk Prediksi Stunting
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
