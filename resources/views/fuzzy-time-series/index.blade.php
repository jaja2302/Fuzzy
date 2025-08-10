@extends('layouts.app')

@section('title', 'Fuzzy Time Series - Perkiraan Dinamis')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line"></i>
                        FUZZY TIME SERIES - PERKIRAAN DINAMIS
                    </h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('fuzzy-time-series.calculate') }}" class="form-horizontal">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="wilayah_id" class="control-label">Pilih Wilayah:</label>
                                    <select name="wilayah_id" id="wilayah_id" class="form-control">
                                        <option value="">Semua Wilayah</option>
                                        @foreach($wilayahs as $wilayah)
                                            <option value="{{ $wilayah->ID_Wilayah }}" 
                                                {{ old('wilayah_id') == $wilayah->ID_Wilayah ? 'selected' : '' }}>
                                                {{ $wilayah->nama_wilayah }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tahun_awal" class="control-label">Tahun Awal:</label>
                                    <input type="number" name="tahun_awal" id="tahun_awal" 
                                           class="form-control" min="2000" max="2030" 
                                           value="{{ old('tahun_awal', 2020) }}" placeholder="2020">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tahun_akhir" class="control-label">Tahun Akhir:</label>
                                    <input type="number" name="tahun_akhir" id="tahun_akhir" 
                                           class="form-control" min="2000" max="2030" 
                                           value="{{ old('tahun_akhir', 2024) }}" placeholder="2024">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-calculator"></i>
                                        HITUNG FUZZY TIME SERIES
                                    </button>
                                    
                                    <a href="{{ route('fuzzy-time-series.data') }}" class="btn btn-info btn-lg ml-2">
                                        <i class="fas fa-database"></i>
                                        LIHAT DATA MENTAH
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Informasi Metode -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="card-title text-white">
                        <i class="fas fa-info-circle"></i>
                        Informasi Metode Fuzzy Time Series
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Langkah-langkah Perhitungan:</h5>
                            <ol>
                                <li><strong>Penentuan Universe of Discourse (UoD):</strong> Membagi data menjadi 7 interval fuzzy</li>
                                <li><strong>Fuzzifikasi:</strong> Mengelompokkan data ke dalam fuzzy sets</li>
                                <li><strong>Fuzzy Logic Groups:</strong> Membuat relasi antar fuzzy sets</li>
                                <li><strong>Fuzzy Relationships Matrix:</strong> Matriks frekuensi relasi</li>
                                <li><strong>Defuzzifikasi:</strong> Prediksi nilai berdasarkan relasi</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <h5>Keunggulan Metode:</h5>
                            <ul>
                                <li>Dapat menangani data yang tidak pasti</li>
                                <li>Prediksi berdasarkan pola historis</li>
                                <li>Akurasi yang lebih baik untuk data time series</li>
                                <li>Dapat diterapkan pada berbagai jenis data</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}

.btn-lg {
    padding: 12px 24px;
    font-size: 16px;
}

.form-control {
    border-radius: 0.375rem;
    border: 1px solid #ced4da;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.control-label {
    font-weight: 600;
    color: #495057;
}
</style>
@endsection
