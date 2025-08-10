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
                                    <span class="info-box-text">Total Wilayah</span>
                                    <span class="info-box-number">{{ count($results) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="fas fa-chart-bar"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Data Validasi</span>
                                    <span class="info-box-number">{{ count(array_filter($results, function($item) { return $item['tipe'] == 'validasi'; })) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-percentage"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Data Prediksi</span>
                                    <span class="info-box-number">{{ count(array_filter($results, function($item) { return $item['tipe'] == 'prediksi'; })) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-danger">
                                <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tahun Prediksi</span>
                                    <span class="info-box-number">{{ $tahunPerkiraan ?? date('Y') + 1 }}</span>
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
                            @if(isset($wilayahId) && $wilayahId)
                                @php $wilayah = \App\Models\Wilayah::where('ID_Wilayah', $wilayahId)->first() @endphp
                                {{ $wilayah ? $wilayah->kabupaten : 'Tidak ditemukan' }}
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

    <!-- Penjelasan Rumus FTS -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5><i class="fas fa-calculator"></i> RUMUS FUZZY TIME SERIES (FTS) YANG DIGUNAKAN</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-list-ol"></i> Langkah-langkah Perhitungan:</h6>
                        <ol>
                            <li><strong>Pengumpulan Data Historis:</strong> Mengambil data tahun {{ isset($results[0]['data_historis']) && count($results[0]['data_historis']) >= 2 ? $results[0]['data_historis'][count($results[0]['data_historis'])-2]['tahun'] : '2023' }} dan {{ isset($results[0]['data_historis']) && count($results[0]['data_historis']) >= 1 ? $results[0]['data_historis'][count($results[0]['data_historis'])-1]['tahun'] : '2024' }}</li>
                            <li><strong>Penentuan Semesta U (Universe of Discourse):</strong>
                                <ul>
                                    <li>Nilai minimum (Min) = <code>2,775</code></li>
                                    <li>Nilai maksimum (Max) = <code>69,296</code></li>
                                    <li>Jumlah interval (k) dengan rumus Sturges: <code>k = 1 + 3.322 × log₁₀(33) ≈ 6.0445 → 6</code></li>
                                    <li>Ukuran interval: <code>(Max − Min) / k = (69,296 − 2,775) / 6 = 11,005</code></li>
                                    <li><em>Konvensi batas:</em> semua interval menggunakan <code>[lower, upper)</code> kecuali interval terakhir <code>[lower, upper]</code></li>
                                </ul>
                            </li>
                            <li><strong>Pembentukan Interval & Himpunan Fuzzy:</strong>
                                <ul>
                                    <li>A₁: <code>[2,775, 13,780)</code></li>
                                    <li>A₂: <code>[13,780, 24,785)</code></li>
                                    <li>A₃: <code>[24,785, 35,790)</code></li>
                                    <li>A₄: <code>[35,790, 46,795)</code></li>
                                    <li>A₅: <code>[46,795, 57,800)</code></li>
                                    <li>A₆: <code>[57,800, 68,805]</code></li>
                                </ul>
                            </li>
                            <li><strong>Fuzzifikasi Data {{ isset($results[0]['data_historis']) && count($results[0]['data_historis']) >= 2 ? $results[0]['data_historis'][count($results[0]['data_historis'])-2]['tahun'] : '2023' }} & {{ isset($results[0]['data_historis']) && count($results[0]['data_historis']) >= 1 ? $results[0]['data_historis'][count($results[0]['data_historis'])-1]['tahun'] : '2024' }}:</strong>
                                <ul>
                                    <li>Kelompokkan tiap nilai ke A₁–A₆ sesuai interval pada Semesta U</li>
                                    <li>Catat fuzzy set untuk masing-masing tahun</li>
                                </ul>
                            </li>
                            <li><strong>Prediksi:</strong>
                                <ul>
                                    <li>Gunakan fuzzy set <em>terakhir</em> (tahun terbaru) sebagai basis prediksi</li>
                                    <li>Prediksi = midpoint dari interval fuzzy terakhir</li>
                                    <li>Rumus: <code>Prediksi = (lower_bound + upper_bound) / 2</code></li>
                                </ul>
                            </li>
                            <li><strong>Perhitungan Selisih:</strong>
                                <ul>
                                    <li>Selisih = <code>Prediksi − Data Terakhir</code></li>
                                    <li>Persentase = <code>(Selisih / Data Terakhir) × 100%</code></li>
                                </ul>
                            </li>
                        </ol>

                        <h6><i class="fas fa-info-circle"></i> Contoh Perhitungan (Dinamis, 1 Wilayah):</h6>
                        <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 10px;">
                            @php
                                // Ambil 1 sampel wilayah untuk contoh
                                $sample_data = $results[0] ?? null;
                                if ($sample_data) {
                                    $hist = $sample_data['data_historis'];
                                    usort($hist, function ($a, $b) {
                                        return $a['tahun'] <=> $b['tahun'];
                                    });
                                    $countHist = count($hist);
                                    $tahun1 = $countHist >= 2 ? $hist[$countHist - 2]['tahun'] : null;
                                    $tahun2 = $countHist >= 1 ? $hist[$countHist - 1]['tahun'] : null;
                                    $val_t1 = $countHist >= 2 ? (int)($hist[$countHist - 2]['jumlah'] ?? 0) : 0;
                                    $val_t2 = $countHist >= 1 ? (int)($hist[$countHist - 1]['jumlah'] ?? 0) : 0;
                                    
                                    // Semesta U global (Bab 3 - tetap)
                                    $global_min = 2775;
                                    $global_max_text = 69296;
                                    $k_interval = 6;
                                    $interval_size_dyn = 11005;
                                    
                                    // Bangun interval [lower, upper) kecuali interval terakhir [lower, upper]
                                    $intervals_dyn = [];
                                    $lower = (float)$global_min;
                                    for ($i = 1; $i <= $k_interval; $i++) {
                                        $is_last = ($i === $k_interval);
                                        $upper = $is_last ? (float)($global_min + $interval_size_dyn * $k_interval) : ($lower + $interval_size_dyn);
                                        $intervals_dyn[$i] = [
                                            'lower' => $lower,
                                            'upper' => $upper,
                                            'mid'   => ($lower + $upper) / 2.0
                                        ];
                                        $lower = $upper;
                                    }
                                    
                                    // Fungsi bantu untuk cari fuzzy set
                                    $findFS = function ($value, $intervals_dyn) {
                                        $k = count($intervals_dyn);
                                        for ($i = 1; $i <= $k; $i++) {
                                            $lower = $intervals_dyn[$i]['lower'];
                                            $upper = $intervals_dyn[$i]['upper'];
                                            $is_last = ($i === $k);
                                            if (($value >= $lower && $value < $upper) || ($is_last && $value >= $lower)) {
                                                return 'A' . $i;
                                            }
                                        }
                                        return '-';
                                    };
                                    
                                    $fs_t1 = $val_t1 ? $findFS($val_t1, $intervals_dyn) : '-';
                                    $fs_t2 = $val_t2 ? $findFS($val_t2, $intervals_dyn) : '-';
                                    $idx_last = ($fs_t2 !== '-' ? (int)substr($fs_t2, 1) : null);
                                    $mid_last = $idx_last ? $intervals_dyn[$idx_last]['mid'] : 0;
                                    
                                    // Helper format
                                    $fmt = function ($x, $dec = 0) {
                                        return number_format($x, $dec, ',', '.');
                                    };
                                }
                            @endphp
                            
                            @if($sample_data)
                                <!-- Tabel Interval (Tetap - Bab 3) -->
                                <div style="background:#ffffff;border:1px solid #e9ecef;border-radius:6px;margin-bottom:12px;">
                                    <table class="table table-bordered table-sm" style="margin:0;">
                                        <thead>
                                            <tr>
                                                <th colspan="3">Tabel III.2. Interval (Semesta U Tetap)</th>
                                            </tr>
                                            <tr>
                                                <th>Interval</th>
                                                <th>Fuzzy Set</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2.775 – 13.780</td>
                                                <td>A1</td>
                                                <td>Rentang 2.775 hingga 13.780 maka A1</td>
                                            </tr>
                                            <tr>
                                                <td>13.780 – 24.785</td>
                                                <td>A2</td>
                                                <td>Rentang 13.780 hingga 24.785 maka A2</td>
                                            </tr>
                                            <tr>
                                                <td>24.785 – 35.790</td>
                                                <td>A3</td>
                                                <td>Rentang 24.785 hingga 35.790 maka A3</td>
                                            </tr>
                                            <tr>
                                                <td>35.790 – 46.795</td>
                                                <td>A4</td>
                                                <td>Rentang 35.790 hingga 46.795 maka A4</td>
                                            </tr>
                                            <tr>
                                                <td>46.795 – 57.800</td>
                                                <td>A5</td>
                                                <td>Rentang 46.795 hingga 57.800 maka A5</td>
                                            </tr>
                                            <tr>
                                                <td>57.800 – 68.805</td>
                                                <td>A6</td>
                                                <td>Rentang 57.800 hingga 68.805 maka A6</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <p><strong>Wilayah:</strong> {{ $sample_data['nama_wilayah'] ?? 'Unknown' }} (contoh dinamis menggunakan 2 tahun terakhir: {{ $tahun1 }} dan {{ $tahun2 }})</p>
                                <ul style="margin: 5px 0 0 20px;">
                                    <li>{{ $tahun1 }}: {{ $fmt($val_t1) }} kasus</li>
                                    <li>{{ $tahun2 }}: {{ $fmt($val_t2) }} kasus</li>
                                    <li>Min Global = {{ $fmt($global_min) }}, Max Global = {{ $fmt($global_max_text) }}, n = 33</li>
                                    <li>Jumlah interval (Sturges) = 1 + 3.322 × log₁₀(33) ≈ 6.04 → <strong>6</strong></li>
                                    <li>Ukuran interval = ({{ $fmt($global_max_text) }} − {{ $fmt($global_min) }}) / 6 ≈ <strong>{{ $fmt($interval_size_dyn, 0) }}</strong></li>
                                    <li>Keanggotaan fuzzy: {{ $tahun1 }} → <strong>{{ $fs_t1 }}</strong>, {{ $tahun2 }} → <strong>{{ $fs_t2 }}</strong></li>
                                    @if($idx_last)
                                        <li>Midpoint {{ $fs_t2 }} = ({{ $fmt($intervals_dyn[$idx_last]['lower'], 0) }} + {{ $fmt($intervals_dyn[$idx_last]['upper'], 0) }}) / 2 = {{ $fmt($mid_last, 0) }}</li>
                                        <li><strong>Prediksi {{ $tahun2 + 1 }} ≈ {{ $fmt(round($mid_last)) }}</strong></li>
                                        <li><em>Keterangan:</em> pada metode Fuzzy Time Series (Chen), nilai representatif interval ditetapkan sebagai <strong>titik tengah (midpoint)</strong>.<br>
                                            — Jika <strong>konsekuen tunggal</strong>, maka midpoint = <code>(batas bawah + batas atas) / 2</code>.<br>
                                            — Jika <strong>konsekuen lebih dari satu</strong>, maka prediksi = <em>rata‑rata midpoint</em> dari seluruh konsekuen: <code>Σ midpoint / jumlah konsekuen</code>. Dengan demikian pembaginya menjadi jumlah konsekuen (tidak selalu 2).<br>
                                            — Jika <strong>tidak ada konsekuen</strong>, biasanya digunakan midpoint interval asal sebagai fallback.
                                        </li>
                                    @else
                                        <li><em>Data tidak lengkap untuk prediksi contoh.</em></li>
                                    @endif
                                </ul>
                                
                                @if($fs_t1 !== '-' && $fs_t2 !== '-' && $idx_last)
                                    @php
                                        $relation = $fs_t1 . '->' . $fs_t2;
                                        $lowerB = $intervals_dyn[$idx_last]['lower'];
                                        $upperB = $intervals_dyn[$idx_last]['upper'];
                                        $predInt = (int)round($mid_last);
                                        $statusLbl = ($predInt > $val_t2) ? 'Naik' : 'Turun';
                                    @endphp
                                    <div style="background:#ffffff;border:1px solid #e9ecef;border-radius:6px;margin-top:12px;">
                                        <table class="table table-bordered table-sm" style="margin:0;">
                                            <thead>
                                                <tr>
                                                    <th>Fuzzy {{ $tahun1 }}</th>
                                                    <th>Fuzzy {{ $tahun2 }}</th>
                                                    <th>Relasi</th>
                                                    <th>Hasil Interval</th>
                                                    <th>Prediksi {{ $tahun2 + 1 }}</th>
                                                    <th>Data {{ $tahun2 }}</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $fs_t1 }}</td>
                                                    <td>{{ $fs_t2 }}</td>
                                                    <td>{{ $relation }}</td>
                                                    <td>({{ $fmt($lowerB, 0) }} + {{ $fmt($upperB, 0) }}) / 2</td>
                                                    <td><strong>{{ $fmt($predInt) }}</strong></td>
                                                    <td>{{ $fmt($val_t2) }}</td>
                                                    <td><span class="badge {{ ($statusLbl === 'Naik' ? 'bg-success' : 'bg-danger') }}">{{ $statusLbl }}</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @else
                                <p><em>Data tidak tersedia untuk contoh perhitungan.</em></p>
                            @endif
                            
                            <small class="text-muted">Catatan: Ganti pilihan <strong>Wilayah</strong> pada form di atas untuk melihat contoh dinamis wilayah lain. Kolom <strong>Hasil Interval</strong> menampilkan nilai representatif: jika konsekuen tunggal maka <em>midpoint</em> <code>(bawah + atas)/2</code>; jika konsekuen lebih dari satu maka <em>rata‑rata midpoint</em> seluruh konsekuen (pembagi = jumlah konsekuen).</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hasil Perhitungan -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5><i class="fas fa-table"></i> HASIL PERHITUNGAN FTS</h5>
                </div>
                <div class="card-body">
                    @if(count($results) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>WILAYAH</th>
                                        <th>FUZZY T-1</th>
                                        <th>FUZZY T</th>
                                        <th>RELASI</th>
                                        <th>HASIL INTERVAL</th>
                                        <th>PREDIKSI {{ $tahunPerkiraan ?? date('Y') + 1 }}</th>
                                        <th>DATA T-1</th>
                                        <th>DATA T</th>
                                        <th>STATUS</th>
                                        <th>TIPE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results as $data)
                                        @php
                                            // Ambil dua data historis terakhir dengan safety check
                                            $hist = isset($data['data_historis']) && is_array($data['data_historis']) ? $data['data_historis'] : [];
                                            usort($hist, function ($a, $b) {
                                                return $a['tahun'] <=> $b['tahun'];
                                            });
                                            $countHist = count($hist);
                                            $prevYear = $countHist >= 2 ? $hist[$countHist - 2]['tahun'] : null;
                                            $lastYear = $countHist >= 1 ? $hist[$countHist - 1]['tahun'] : null;
                                            $val_t1 = $countHist >= 2 ? (int)($hist[$countHist - 2]['jumlah'] ?? 0) : 0;
                                            $val_t2 = $countHist >= 1 ? (int)($hist[$countHist - 1]['jumlah'] ?? 0) : 0;

                                            // Hitung fuzzy set menggunakan helper function
                                            $fs_t1 = findFuzzySet($val_t1);
                                            $fs_t2 = findFuzzySet($val_t2);
                                            
                                            // Hitung status dengan safety check
                                            $selisih = $data['selisih'] ?? 0;
                                            $statusLbl = ($selisih > 0) ? 'Naik' : 'Turun';
                                            $statusBadge = ($statusLbl === 'Naik') ? 'bg-success' : 'bg-danger';
                                            $rowClass = ($statusLbl === 'Naik') ? 'table-success' : 'table-danger';
                                        @endphp
                                        <tr class="{{ $rowClass }}">
                                            <td>
                                                <strong>{{ $data['nama_wilayah'] ?? 'Unknown' }}</strong><br>
                                                <small class="text-muted">{{ $data['provinsi'] ?? 'Unknown' }}</small>
                                            </td>
                                            <td>{{ $fs_t1 }}</td>
                                            <td>{{ $fs_t2 }}</td>
                                            <td>{{ $fs_t1 }}->{{ $fs_t2 }}</td>
                                            <td>Midpoint {{ $fs_t2 }}</td>
                                            <td><strong>{{ number_format($data['jumlah_perkiraan']) }}</strong></td>
                                            <td>{{ number_format($val_t1) }}</td>
                                            <td>{{ number_format($val_t2) }}</td>
                                            <td><span class="badge {{ $statusBadge }}">{{ $statusLbl }}</span></td>
                                            <td>
                                                <span class="badge {{ $data['tipe'] == 'validasi' ? 'bg-info' : 'bg-warning' }}">
                                                    {{ ucfirst($data['tipe']) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            Tidak ada data hasil perhitungan yang ditemukan.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="row mt-3">
        <div class="col-12 text-center">
            <a href="{{ route('fuzzy-time-series.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Form
            </a>
        </div>
    </div>
</div>

@php
    // Helper function untuk mencari fuzzy set
    function findFuzzySet($value) {
        if ($value == 0) return '-';
        
        // Semesta U tetap (Bab 3)
        $min = 2775;
        $jumlah_interval = 6;
        $interval_size = 11005;
        
        for ($i = 1; $i <= $jumlah_interval; $i++) {
            $lower = $min + (($i - 1) * $interval_size);
            $upper = $min + ($i * $interval_size);
            $is_last = ($i === $jumlah_interval);
            
            if (($value >= $lower && $value < $upper) || ($is_last && $value >= $lower)) {
                return 'A' . $i;
            }
        }
        
        return '-';
    }
@endphp
@endsection
