<?php
error_reporting(0);
include "sambung.php";
include "fts_functions.php";
include "atas.php";

// Function to get the next prediction year based on available data
function getNextPredictionYear($link)
{
    $query = mysqli_query($link, "SELECT MAX(tahun) as max_tahun FROM stunting");
    $result = mysqli_fetch_array($query);
    $last_year = (int)$result['max_tahun'];
    return $last_year + 1;
}

// Get the next prediction year automatically
$next_prediction_year = getNextPredictionYear($link);

// Set default tahun perkiraan - use the next year after last available data
$tahun_perkiraan = isset($_POST['tahun_perkiraan']) ? $_POST['tahun_perkiraan'] : $next_prediction_year;
$hasil_perkiraan = array();

// Jika form disubmit untuk semua wilayah
if (isset($_POST['hitung_semua_wilayah'])) {
    $hasil_perkiraan = hitungFTSAllWilayah($tahun_perkiraan, $link);
}

// Jika ada request untuk wilayah tertentu
if (isset($_POST['hitung_wilayah']) && !empty($_POST['id_wilayah'])) {
    $id_wilayah = $_POST['id_wilayah'];
    $hasil = hitungFTS($id_wilayah, $tahun_perkiraan, $link);
    if ($hasil['success']) {
        $hasil_perkiraan = array($hasil['data']);
    }
}

// Jika form disubmit dengan tombol "Hitung Perkiraan" (untuk kompatibilitas)
if (isset($_POST['hitung_perkiraan'])) {
    if (!empty($_POST['id_wilayah'])) {
        // Jika wilayah dipilih, hitung untuk wilayah tersebut
        $id_wilayah = $_POST['id_wilayah'];
        $hasil = hitungFTS($id_wilayah, $tahun_perkiraan, $link);
        if ($hasil['success']) {
            $hasil_perkiraan = array($hasil['data']);
        }
    } else {
        // Jika tidak ada wilayah dipilih, hitung semua wilayah
        $hasil_perkiraan = hitungFTSAllWilayah($tahun_perkiraan, $link);
    }
}

// Default: jika belum ada hasil (halaman baru dibuka tanpa POST), tampilkan semua wilayah
if (empty($hasil_perkiraan)) {
    $hasil_perkiraan = hitungFTSAllWilayah($tahun_perkiraan, $link);
}

// Get historical data years for display
$query_years = mysqli_query($link, "SELECT DISTINCT tahun FROM stunting ORDER BY tahun ASC");
$available_years = array();
while ($year = mysqli_fetch_array($query_years)) {
    $available_years[] = $year['tahun'];
}
$min_year = min($available_years);
$max_year = max($available_years);
?>

<style>
    .perkiraan-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 20px 0;
        overflow: hidden;
    }

    .perkiraan-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        text-align: center;
    }

    .perkiraan-body {
        padding: 30px;
    }

    .form-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #495057;
    }

    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        font-size: 14px;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #667eea;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    .btn-outline-success {
        background: transparent;
        border: 1px solid #28a745;
        color: #28a745;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .btn-outline-success:hover {
        background: #28a745;
        color: white;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 12px;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .badge {
        display: inline-block;
        padding: 0.25em 0.4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }

    .badge-warning {
        color: #212529;
        background-color: #ffc107;
    }

    .badge-success {
        color: #fff;
        background-color: #28a745;
    }

    .badge-danger {
        color: #fff;
        background-color: #dc3545;
    }

    .badge-info {
        color: #fff;
        background-color: #17a2b8;
    }

    .text-success {
        color: #28a745 !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-info {
        color: #0c5460;
        background-color: #d1ecf1;
        border-color: #bee5eb;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        text-align: center;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stats-label {
        font-size: 1rem;
        opacity: 0.9;
    }

    .table-warning {
        background-color: rgba(255, 193, 7, 0.1) !important;
    }

    .table-success {
        background-color: rgba(40, 167, 69, 0.1) !important;
    }

    .table-danger {
        background-color: rgba(220, 53, 69, 0.1) !important;
    }

    .table-info {
        background-color: rgba(23, 162, 184, 0.1) !important;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.075) !important;
    }

    .filter-section {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #dee2e6;
    }

    .filter-section h5 {
        margin-bottom: 15px;
        color: #495057;
        font-size: 16px;
    }

    /* Print styles */
    @media print {

        .form-section,
        .filter-section,
        .btn-primary,
        .btn-secondary {
            display: none !important;
        }

        .perkiraan-container {
            box-shadow: none;
            margin: 0;
        }

        .perkiraan-header {
            background: #333 !important;
            color: white !important;
        }

        .table {
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #000 !important;
        }

        .stats-card {
            background: #333 !important;
            color: white !important;
            margin-bottom: 10px;
        }
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .perkiraan-body {
            padding: 15px;
        }

        .stats-card {
            margin-bottom: 15px;
        }

        .stats-number {
            font-size: 2rem;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
            margin-left: 0 !important;
            margin-bottom: 10px !important;
        }

        .table-responsive {
            font-size: 12px;
        }

        .table th,
        .table td {
            padding: 8px 4px;
        }

        .filter-section .row>div {
            margin-bottom: 15px;
        }

        .text-center button {
            width: 100%;
            margin-left: 0 !important;
        }
    }
</style>

<div class="perkiraan-container">
    <div class="perkiraan-header">
        <h2><i class="fa fa-chart-line"></i> Perkiraan Stunting dengan Metode FTS</h2>
        <p>Sistem Perhitungan Dinamis Fuzzy Time Series</p>
    </div>

    <div class="perkiraan-body">
        <!-- Form Perhitungan -->
        <div class="form-section">
            <h4><i class="fa fa-calculator"></i> Form Perhitungan</h4>

            <div class="alert alert-info" style="margin-bottom: 20px;">
                <i class="fa fa-info-circle"></i>
                <strong>Panduan Penggunaan:</strong>
                <ul style="margin: 10px 0 0 20px;">
                    <li><strong>Data Tersedia:</strong> Data historis dari tahun <?php echo $min_year; ?> - <?php echo $max_year; ?></li>
                    <li><strong>Tahun Prediksi Otomatis:</strong> Sistem akan memprediksi tahun <?php echo $next_prediction_year; ?> (setelah data terakhir)</li>
                    <li><strong>Hitung Semua Wilayah:</strong> Menampilkan perkiraan untuk semua wilayah sekaligus</li>
                    <li><strong>Hitung Perkiraan:</strong> Pilih wilayah tertentu atau biarkan kosong untuk semua wilayah</li>
                    <li><strong>Pilih Wilayah:</strong> Jika memilih wilayah tertentu, perhitungan akan otomatis dijalankan</li>
                    <li><strong>Filter & Pencarian:</strong> Setelah hasil ditampilkan, gunakan fitur filter untuk mencari wilayah tertentu</li>
                    <li><strong>Export & Cetak:</strong> Export ke Excel atau cetak hasil perhitungan</li>
                    <li><strong>Responsif:</strong> Aplikasi dapat digunakan dengan baik di desktop maupun mobile</li>
                    <li><strong>Statistik:</strong> Lihat ringkasan statistik untuk analisis cepat</li>
                    <li><strong>Sorting:</strong> Urutkan data berdasarkan kriteria tertentu</li>
                    <li><strong>Warna:</strong> Hijau = Naik, Merah = Turun, Kuning = Prediksi</li>
                    <li><strong>Auto-submit:</strong> Pilih wilayah untuk perhitungan otomatis</li>
                    <li><strong>Real-time:</strong> Filter dan pencarian bekerja secara real-time</li>
                </ul>
            </div>

            <!-- Penjelasan Rumus FTS -->
            <div class="alert alert-success" style="margin-bottom: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <i class="fa fa-calculator"></i>
                        <strong>Rumus Fuzzy Time Series (FTS) yang Digunakan:</strong>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success" onclick="toggleFormulaExplanation()">
                        <i class="fa fa-eye"></i> Tampilkan/Sembunyikan Rumus
                    </button>
                </div>
                <div id="formulaExplanation" style="display: none; margin-top: 15px;">
                    <h5><i class="fa fa-list-ol"></i> Langkah-langkah Perhitungan:</h5>
                    <ol style="margin: 10px 0 0 20px;">
                        <li><strong>Pengumpulan Data Historis:</strong> Mengambil data tahun 2023 dan 2024</li>
                        <li><strong>Penentuan Semesta U (Universe of Discourse):</strong>
                            <ul style="margin: 5px 0 0 20px;">
                                <li>Nilai minimum (Min) = <code>2,775</code></li>
                                <li>Nilai maksimum (Max) = <code>69,296</code></li>
                                <li>Jumlah interval (k) dengan rumus Sturges: <code>k = 1 + 3.322 × log₁₀(33) ≈ 6.0445 → 6</code></li>
                                <li>Ukuran interval: <code>(Max − Min) / k = (69,296 − 2,775) / 6 = 11,005</code></li>
                                <li><em>Konvensi batas:</em> semua interval menggunakan <code>[lower, upper)</code> kecuali interval terakhir <code>[lower, upper]</code></li>
                            </ul>
                        </li>
                        <li><strong>Pembentukan Interval & Himpunan Fuzzy:</strong>
                            <ul style="margin: 5px 0 0 20px;">
                                <li>A₁: <code>[2,775, 13,780)</code></li>
                                <li>A₂: <code>[13,780, 24,785)</code></li>
                                <li>A₃: <code>[24,785, 35,790)</code></li>
                                <li>A₄: <code>[35,790, 46,795)</code></li>
                                <li>A₅: <code>[46,795, 57,800)</code></li>
                                <li>A₆: <code>[57,800, 68,805]</code></li>
                            </ul>
                        </li>
                        <li><strong>Fuzzifikasi Data 2023 & 2024:</strong>
                            <ul style="margin: 5px 0 0 20px;">
                                <li>Kelompokkan tiap nilai ke A₁–A₆ sesuai interval pada Semesta U</li>
                                <li>Catat fuzzy set untuk masing-masing tahun</li>
                            </ul>
                        </li>
                        <li><strong>Prediksi:</strong>
                            <ul style="margin: 5px 0 0 20px;">
                                <li>Gunakan fuzzy set <em>terakhir</em> (tahun terbaru) sebagai basis prediksi</li>
                                <li>Prediksi = midpoint dari interval fuzzy terakhir</li>
                                <li>Rumus: <code>Prediksi = (lower_bound + upper_bound) / 2</code></li>
                            </ul>
                        </li>
                        <li><strong>Perhitungan Selisih:</strong>
                            <ul style="margin: 5px 0 0 20px;">
                                <li>Selisih = <code>Prediksi − Data Terakhir</code></li>
                                <li>Persentase = <code>(Selisih / Data Terakhir) × 100%</code></li>
                            </ul>
                        </li>
                    </ol>

                    <h5><i class="fa fa-info-circle"></i> Contoh Perhitungan (Dinamis, 1 Wilayah):</h5>
                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 10px;">
                        <?php
                        // Ambil 1 sampel wilayah: pakai pilihan form jika ada, jika tidak ambil wilayah pertama (ASC)
                        $sample_wilayah_id = (isset($_POST['id_wilayah']) && $_POST['id_wilayah'] !== '') ? $_POST['id_wilayah'] : null;
                        if ($sample_wilayah_id === null) {
                            $qwil = mysqli_query($link, "SELECT ID_Wilayah, Kabupaten FROM wilayah ORDER BY Kabupaten ASC LIMIT 1");
                            $rwil = mysqli_fetch_array($qwil);
                            $sample_wilayah_id = $rwil['ID_Wilayah'];
                            $sample_wilayah_nama = $rwil['Kabupaten'];
                        } else {
                            $qwil = mysqli_query($link, "SELECT Kabupaten FROM wilayah WHERE ID_Wilayah = '" . mysqli_real_escape_string($link, $sample_wilayah_id) . "' LIMIT 1");
                            $rwil = mysqli_fetch_array($qwil);
                            $sample_wilayah_nama = $rwil ? $rwil['Kabupaten'] : 'Wilayah Terpilih';
                        }

                        // Tentukan dua tahun terakhir yang tersedia (sudah dihitung sebelumnya: $max_year)
                        $tahun2 = (int)$max_year;            // tahun terbaru
                        $tahun1 = (int)$max_year - 1;        // tahun sebelumnya

                        // Ambil data wilayah sampel untuk dua tahun terakhir
                        $vals = [];
                        $qvals = mysqli_query($link, "SELECT tahun, jumlah FROM stunting WHERE id_wilayah='" . mysqli_real_escape_string($link, $sample_wilayah_id) . "' AND tahun IN ($tahun1, $tahun2)");
                        while ($r = mysqli_fetch_array($qvals)) {
                            $vals[(int)$r['tahun']] = (int)$r['jumlah'];
                        }
                        $val_t1 = isset($vals[$tahun1]) ? (int)$vals[$tahun1] : 0;
                        $val_t2 = isset($vals[$tahun2]) ? (int)$vals[$tahun2] : 0;

                        // Semesta U global (Bab 3 - tetap)
                        $global_min = 2775;          // sesuai Bab 3
                        $global_max_text = 69296;    // nilai maksimum data (untuk tampilan)
                        $k_interval = 6;             // hasil Sturges dibulatkan menjadi 6
                        $interval_size_dyn = 11005;  // (68,805 − 2,775) / 6

                        // Catatan: Bab 3 berhenti di 68,805. Agar nilai > 68,805 (mis. 69,296) tetap terkelompok,
                        // kita buat interval terakhir menerima nilai >= lower (tanpa batas atas ketat).

                        // Bangun interval [lower, upper) kecuali interval terakhir [lower, upper]
                        $intervals_dyn = [];
                        $lower = (float)$global_min;
                        for ($i = 1; $i <= $k_interval; $i++) {
                            $is_last = ($i === $k_interval);
                            $upper = $is_last ? (float)($global_min + $interval_size_dyn * $k_interval) : ($lower + $interval_size_dyn); // last upper = 68,805
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
                        ?>
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

                        <p><strong>Wilayah:</strong> <?php echo htmlspecialchars($sample_wilayah_nama); ?> (contoh dinamis menggunakan 2 tahun terakhir: <?php echo $tahun1; ?> dan <?php echo $tahun2; ?>)</p>
                        <ul style="margin: 5px 0 0 20px;">
                            <li><?php echo $tahun1; ?>: <?php echo $fmt($val_t1); ?> kasus</li>
                            <li><?php echo $tahun2; ?>: <?php echo $fmt($val_t2); ?> kasus</li>
                            <li>Min Global = <?php echo $fmt($global_min); ?>, Max Global = <?php echo $fmt($global_max_text); ?>, n = 33</li>
                            <li>Jumlah interval (Sturges) = 1 + 3.322 × log₁₀(33) ≈ 6.04 → <strong>6</strong></li>
                            <li>Ukuran interval = (<?php echo $fmt($global_max_text); ?> − <?php echo $fmt($global_min); ?>) / 6 ≈ <strong><?php echo $fmt($interval_size_dyn, 0); ?></strong></li>
                            <li>Keanggotaan fuzzy: <?php echo $tahun1; ?> → <strong><?php echo $fs_t1; ?></strong>, <?php echo $tahun2; ?> → <strong><?php echo $fs_t2; ?></strong></li>
                            <?php if ($idx_last): ?>
                                <li>Midpoint <?php echo $fs_t2; ?> = (<?php echo $fmt($intervals_dyn[$idx_last]['lower'], 0); ?> + <?php echo $fmt($intervals_dyn[$idx_last]['upper'], 0); ?>) / 2 = <?php echo $fmt($mid_last, 0); ?></li>
                                <li><strong>Prediksi <?php echo $tahun2 + 1; ?> ≈ <?php echo $fmt(round($mid_last)); ?></strong></li>
                            <?php else: ?>
                                <li><em>Data tidak lengkap untuk prediksi contoh.</em></li>
                            <?php endif; ?>
                        </ul>
                        <?php if ($fs_t1 !== '-' && $fs_t2 !== '-' && $idx_last):
                            $relation = $fs_t1 . '->' . $fs_t2;
                            $lowerB = $intervals_dyn[$idx_last]['lower'];
                            $upperB = $intervals_dyn[$idx_last]['upper'];
                            $predInt = (int)round($mid_last);
                            $statusLbl = ($predInt > $val_t2) ? 'Naik' : 'Turun';
                        ?>
                            <div style="background:#ffffff;border:1px solid #e9ecef;border-radius:6px;margin-top:12px;">
                                <table class="table table-bordered table-sm" style="margin:0;">
                                    <thead>
                                        <tr>
                                            <th>Fuzzy 2023</th>
                                            <th>Fuzzy 2024</th>
                                            <th>Relasi</th>
                                            <th>Hasil Interval</th>
                                            <th>Prediksi <?php echo $tahun2 + 1; ?></th>
                                            <th>Data <?php echo $tahun2; ?></th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $fs_t1; ?></td>
                                            <td><?php echo $fs_t2; ?></td>
                                            <td><?php echo $relation; ?></td>
                                            <td>(<?php echo $fmt($lowerB, 0); ?> + <?php echo $fmt($upperB, 0); ?>) / 2</td>
                                            <td><strong><?php echo $fmt($predInt); ?></strong></td>
                                            <td><?php echo $fmt($val_t2); ?></td>
                                            <td><span class="badge <?php echo ($statusLbl === 'Naik' ? 'badge-success' : 'badge-danger'); ?>"><?php echo $statusLbl; ?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                        <small class="text-muted">Catatan: Ganti pilihan <strong>Wilayah</strong> pada form di atas untuk melihat contoh dinamis wilayah lain.</small>
                    </div>
                </div>
            </div>

            <form method="POST" action="">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="tahun_perkiraan">Tahun Perkiraan:</label>
                            <input type="number" name="tahun_perkiraan" id="tahun_perkiraan"
                                class="form-control" value="<?php echo $tahun_perkiraan; ?>"
                                min="<?php echo $next_prediction_year; ?>" max="<?php echo $next_prediction_year + 10; ?>" required>
                            <small class="form-text text-muted">
                                Data tersedia: <?php echo $min_year; ?> - <?php echo $max_year; ?>.
                                Prediksi otomatis untuk tahun <?php echo $next_prediction_year; ?> (setelah data terakhir).
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="id_wilayah">Wilayah (Opsional):</label>
                            <select name="id_wilayah" id="id_wilayah" class="form-control">
                                <option value="">-- Semua Wilayah --</option>
                                <?php
                                $query = mysqli_query($link, "SELECT * FROM wilayah ORDER BY Kabupaten ASC");
                                while ($wilayah = mysqli_fetch_array($query)) {
                                    $selected = (isset($_POST['id_wilayah']) && $_POST['id_wilayah'] == $wilayah['ID_Wilayah']) ? 'selected' : '';
                                    echo "<option value='{$wilayah['ID_Wilayah']}' $selected>{$wilayah['Kabupaten']} ({$wilayah['Provinsi']})</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" name="hitung_semua_wilayah" class="btn-primary" style="margin-bottom: 10px;">
                        <i class="fa fa-globe"></i> Hitung Semua Wilayah
                    </button>
                    <button type="submit" name="hitung_perkiraan" class="btn-secondary" style="margin-left: 10px; margin-bottom: 10px;">
                        <i class="fa fa-calculator"></i> Hitung Perkiraan
                    </button>
                    <a href="index.php" class="btn-secondary" style="text-decoration: none; margin-left: 10px; margin-bottom: 10px;">
                        <i class="fa fa-home"></i> Kembali ke Menu
                    </a>
                </div>
            </form>
        </div>

        <?php if (!empty($hasil_perkiraan)): ?>
            <!-- Statistik -->
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card">
                        <div class="stats-number"><?php echo count($hasil_perkiraan); ?></div>
                        <div class="stats-label">Total Wilayah</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card">
                        <div class="stats-number"><?php echo count(array_filter($hasil_perkiraan, function ($item) {
                                                        return $item['tipe'] == 'validasi';
                                                    })); ?></div>
                        <div class="stats-label">Data Validasi</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card">
                        <div class="stats-number"><?php echo count(array_filter($hasil_perkiraan, function ($item) {
                                                        return $item['tipe'] == 'prediksi';
                                                    })); ?></div>
                        <div class="stats-label">Data Prediksi</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card">
                        <div class="stats-number"><?php
                                                    $persentase_naik = count(array_filter($hasil_perkiraan, function ($item) {
                                                        return $item['selisih'] > 0;
                                                    }));
                                                    echo $persentase_naik;
                                                    ?></div>
                        <div class="stats-label">Wilayah Naik</div>
                    </div>
                </div>
            </div>

            <!-- Statistik Tambahan -->
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);">
                        <div class="stats-number"><?php
                                                    $wilayah_turun = count(array_filter($hasil_perkiraan, function ($item) {
                                                        return $item['selisih'] < 0;
                                                    }));
                                                    echo $wilayah_turun;
                                                    ?></div>
                        <div class="stats-label">Wilayah Turun</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card" style="background: linear-gradient(135deg, #26de81 0%, #20bf6b 100%);">
                        <div class="stats-number"><?php
                                                    $total_selisih = array_sum(array_column($hasil_perkiraan, 'selisih'));
                                                    echo ($total_selisih > 0) ? '+' . number_format($total_selisih) : number_format($total_selisih);
                                                    ?></div>
                        <div class="stats-label">Total Selisih</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card" style="background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);">
                        <div class="stats-number"><?php
                                                    $rata_rata_selisih = count($hasil_perkiraan) > 0 ? $total_selisih / count($hasil_perkiraan) : 0;
                                                    echo ($rata_rata_selisih > 0) ? '+' . number_format($rata_rata_selisih, 0) : number_format($rata_rata_selisih, 0);
                                                    ?></div>
                        <div class="stats-label">Rata-rata Selisih</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card" style="background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);">
                        <div class="stats-number"><?php
                                                    $total_perkiraan = array_sum(array_column($hasil_perkiraan, 'jumlah_perkiraan'));
                                                    echo number_format($total_perkiraan);
                                                    ?></div>
                        <div class="stats-label">Total Perkiraan</div>
                    </div>
                </div>
            </div>

            <?php if (count($hasil_perkiraan) > 1): ?>
                <!-- Hasil Perhitungan (ditampilkan jika lebih dari 1 wilayah) -->
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i>
                    <strong>Hasil Perhitungan FTS:</strong>
                    Menampilkan perkiraan untuk tahun <?php echo $tahun_perkiraan; ?>
                    (<?php echo count($hasil_perkiraan); ?> wilayah)
                    <br><small>Data historis: <?php echo $min_year; ?> - <?php echo $max_year; ?> |
                        Prediksi otomatis untuk tahun setelah data terakhir</small>
                    <br><small><strong>Metode:</strong> Fuzzy Time Series dengan interval grouping dan midpoint prediction</small>
                </div>

                <?php if (count($hasil_perkiraan) > 5): ?>
                    <!-- Filter dan Pencarian -->
                    <div class="filter-section">
                        <h5><i class="fa fa-filter"></i> Filter dan Pencarian</h5>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label for="searchWilayah">Cari Wilayah:</label>
                                    <input type="text" id="searchWilayah" class="form-control" placeholder="Ketik nama wilayah...">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <div class="form-group">
                                    <label for="filterStatus">Filter Status:</label>
                                    <select id="filterStatus" class="form-control">
                                        <option value="">Semua Status</option>
                                        <option value="naik">Naik</option>
                                        <option value="turun">Turun</option>
                                        <option value="validasi">Data Validasi</option>
                                        <option value="prediksi">Data Prediksi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label for="sortBy">Urutkan:</label>
                                    <select id="sortBy" class="form-control">
                                        <option value="">Urutan Default</option>
                                        <option value="wilayah">Nama Wilayah</option>
                                        <option value="prediksi">Prediksi (Tertinggi)</option>
                                        <option value="prediksi-asc">Prediksi (Terendah)</option>
                                        <option value="data">Data Terakhir</option>
                                        <option value="status">Status</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="button" id="resetFilter" class="btn-secondary" style="width: 100%;">
                                        <i class="fa fa-refresh"></i> Reset Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                // Bangun tabel hasil dengan format seperti tabel contoh (menampilkan fuzzy set dan interval)
                $global_min = 2775;
                $k_interval = 6;
                $interval_size_dyn = 11005; // (68,805 − 2,775) / 6
                $intervals_dyn = [];
                $lowerTmp = (float)$global_min;
                for ($i = 1; $i <= $k_interval; $i++) {
                    $is_last = ($i === $k_interval);
                    $upperTmp = $is_last ? (float)($global_min + $interval_size_dyn * $k_interval) : ($lowerTmp + $interval_size_dyn);
                    $intervals_dyn[$i] = [
                        'lower' => $lowerTmp,
                        'upper' => $upperTmp,
                        'mid'   => ($lowerTmp + $upperTmp) / 2.0
                    ];
                    $lowerTmp = $upperTmp;
                }

                $findFS = function ($value) use ($intervals_dyn) {
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

                $fmt = function ($x, $dec = 0) {
                    return number_format($x, $dec, ',', '.');
                };
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-results">
                        <thead>
                            <tr>
                                <th>WILAYAH</th>
                                <th>FUZZY <?php echo $max_year - 1; ?></th>
                                <th>FUZZY <?php echo $max_year; ?></th>
                                <th>RELASI</th>
                                <th>HASIL INTERVAL</th>
                                <th>PREDIKSI <?php echo $tahun_perkiraan; ?></th>
                                <th>DATA <?php echo $max_year - 1; ?></th>
                                <th>DATA <?php echo $max_year; ?></th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($hasil_perkiraan as $data): ?>
                                <?php
                                // Ambil dua data historis terakhir
                                $hist = isset($data['data_historis']) && is_array($data['data_historis']) ? $data['data_historis'] : [];
                                usort($hist, function ($a, $b) {
                                    return $a['tahun'] <=> $b['tahun'];
                                });
                                $countHist = count($hist);
                                $prevYear = $countHist >= 2 ? $hist[$countHist - 2]['tahun'] : null;
                                $lastYear = $countHist >= 1 ? $hist[$countHist - 1]['tahun'] : null;
                                $val_t1 = $countHist >= 2 ? (int)$hist[$countHist - 2]['jumlah'] : 0;
                                $val_t2 = $countHist >= 1 ? (int)$hist[$countHist - 1]['jumlah'] : 0;

                                $fs_t1 = $val_t1 ? $findFS($val_t1) : '-';
                                $fs_t2 = $val_t2 ? $findFS($val_t2) : '-';
                                $idx_last = ($fs_t2 !== '-' ? (int)substr($fs_t2, 1) : null);
                                $lowerB = $idx_last ? $intervals_dyn[$idx_last]['lower'] : 0;
                                $upperB = $idx_last ? $intervals_dyn[$idx_last]['upper'] : 0;
                                $mid_last = ($lowerB + $upperB) / 2.0;
                                $predInt = (int)round($mid_last);
                                $statusLbl = ($predInt > $val_t2) ? 'Naik' : 'Turun';
                                $statusBadge = ($statusLbl === 'Naik') ? 'badge-success' : 'badge-danger';
                                $rowClass = ($statusLbl === 'Naik') ? 'table-success' : 'table-danger';
                                ?>
                                <tr class="<?php echo $rowClass; ?>" data-wilayah="<?php echo strtolower($data['nama_wilayah']); ?>" data-status="<?php echo strtolower($statusLbl); ?>">
                                    <td><strong><?php echo $data['nama_wilayah']; ?></strong><br><small class="text-muted"><?php echo $data['provinsi']; ?></small></td>
                                    <td><?php echo $fs_t1; ?></td>
                                    <td><?php echo $fs_t2; ?></td>
                                    <td><?php echo $fs_t1 . '->' . $fs_t2; ?></td>
                                    <td>(<?php echo $fmt($lowerB, 0); ?> + <?php echo $fmt($upperB, 0); ?>) / 2</td>
                                    <td><strong><?php echo $fmt($predInt); ?></strong></td>
                                    <td><?php echo $fmt($val_t1); ?></td>
                                    <td><?php echo $fmt($val_t2); ?></td>
                                    <td><span class="badge <?php echo $statusBadge; ?>"><?php echo $statusLbl; ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Tombol Export -->
                <div class="text-center" style="margin-top: 20px;">
                    <button onclick="exportToExcel()" class="btn-primary" style="margin-bottom: 10px;">
                        <i class="fa fa-download"></i> Export ke Excel
                    </button>
                    <button onclick="printTable()" class="btn-secondary" style="margin-left: 10px; margin-bottom: 10px;">
                        <i class="fa fa-print"></i> Cetak
                    </button>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i>
                <strong>Panduan Penggunaan:</strong>
                <ul style="margin: 10px 0 0 20px;">
                    <li>Data tersedia: <?php echo $min_year; ?> - <?php echo $max_year; ?></li>
                    <li>Prediksi otomatis untuk tahun <?php echo $next_prediction_year; ?> (setelah data terakhir)</li>
                    <li>Klik <strong>"Hitung Semua Wilayah"</strong> untuk menampilkan perkiraan semua wilayah sekaligus</li>
                    <li>Klik <strong>"Hitung Perkiraan"</strong> untuk menghitung berdasarkan pilihan wilayah</li>
                    <li>Pilih tahun perkiraan yang diinginkan (<?php echo $next_prediction_year; ?> - <?php echo $next_prediction_year + 10; ?>)</li>
                    <li>Setelah hasil ditampilkan, Anda dapat menggunakan fitur filter dan pencarian</li>
                    <li>Gunakan tombol <strong>"Export ke Excel"</strong> atau <strong>"Cetak"</strong> untuk menyimpan hasil</li>
                    <li>Aplikasi responsif dan dapat digunakan dengan baik di desktop maupun mobile</li>
                    <li>Lihat ringkasan statistik untuk analisis cepat</li>
                    <li>Urutkan data berdasarkan kriteria tertentu</li>
                    <li>Warna: Hijau = Naik, Merah = Turun, Kuning = Prediksi</li>
                    <li>Pilih wilayah untuk perhitungan otomatis</li>
                </ul>
            </div>

            <!-- Penjelasan Detail Rumus FTS -->
            <div class="alert alert-warning">
                <i class="fa fa-lightbulb-o"></i>
                <strong>Penjelasan Detail Algoritma FTS:</strong>
                <div style="margin-top: 15px;">
                    <h5><i class="fa fa-cogs"></i> Algoritma Fuzzy Time Series:</h5>
                    <div style="background: #fff3cd; padding: 15px; border-radius: 5px; margin-top: 10px;">
                        <p><strong>1. Penentuan Semesta U dan Jumlah Interval (Rumus Sturges):</strong></p>
                        <p style="font-family: monospace; background: white; padding: 10px; border-radius: 3px;">
                            k = 1 + 3.322 × log₁₀(33) ≈ 6.0445 → 6<br>
                            U = [min, max] = [2,775, 69,296]
                        </p>

                        <p><strong>2. Ukuran Interval:</strong></p>
                        <p style="font-family: monospace; background: white; padding: 10px; border-radius: 3px;">
                            interval_size = (69,296 − 2,775) / 6 = 11,005
                        </p>

                        <p><strong>3. Interval Fuzzy (A₁–A₆) dengan konvensi batas:</strong> <em>[lower, upper)</em> kecuali interval terakhir <em>[lower, upper]</em></p>
                        <p style="font-family: monospace; background: white; padding: 10px; border-radius: 3px;">
                            A₁: [2,775, 13,780)<br>
                            A₂: [13,780, 24,785)<br>
                            A₃: [24,785, 35,790)<br>
                            A₄: [35,790, 46,795)<br>
                            A₅: [46,795, 57,800)<br>
                            A₆: [57,800, 68,805]
                        </p>

                        <p><strong>4. Midpoint Interval:</strong></p>
                        <p style="font-family: monospace; background: white; padding: 10px; border-radius: 3px;">
                            midpoint = (lower_bound + upper_bound) / 2
                        </p>

                        <p><strong>5. Rumus Prediksi:</strong></p>
                        <p style="font-family: monospace; background: white; padding: 10px; border-radius: 3px;">
                            Prediksi = midpoint dari interval fuzzy terakhir (berdasarkan tahun terbaru)
                        </p>

                        <p><strong>6. Rumus Selisih dan Persentase:</strong></p>
                        <p style="font-family: monospace; background: white; padding: 10px; border-radius: 3px;">
                            Selisih = Prediksi − Data_Terakhir<br>
                            Persentase = (Selisih / Data_Terakhir) × 100%
                        </p>
                    </div>

                    <h5><i class="fa fa-question-circle"></i> Mengapa Hasil Prediksi Seperti Itu?</h5>
                    <ul style="margin: 10px 0 0 20px;">
                        <li><strong>Berbasis Semesta U Global:</strong> Interval A₁–A₆ ditetapkan dari keseluruhan data (33 kabupaten/kota)</li>
                        <li><strong>Fuzzy Logic:</strong> Menangani ketidakpastian data dengan pengelompokan interval</li>
                        <li><strong>Boundary Konsisten:</strong> [lower, upper) mencegah tumpang tindih; interval terakhir [lower, upper]</li>
                        <li><strong>Midpoint Prediction:</strong> Nilai tengah interval terakhir sebagai prediksi</li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    // Persist and restore scroll position to prevent jumping to top after form submits
    function saveScrollPosition() {
        try {
            sessionStorage.setItem('fts_scroll_y', String(window.scrollY || window.pageYOffset || 0));
        } catch (e) {}
    }

    function restoreScrollPosition() {
        try {
            var y = parseInt(sessionStorage.getItem('fts_scroll_y') || '0', 10);
            if (!isNaN(y) && y > 0) {
                window.scrollTo(0, y);
            }
            sessionStorage.removeItem('fts_scroll_y');
        } catch (e) {}
    }

    // Prefer manual scroll restoration (modern browsers)
    try {
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }
    } catch (e) {}

    // Restore scroll on load
    document.addEventListener('DOMContentLoaded', restoreScrollPosition);
    window.addEventListener('load', function() {
        setTimeout(restoreScrollPosition, 0);
    });
    window.addEventListener('pageshow', function(e) {
        if (e.persisted) {
            setTimeout(restoreScrollPosition, 0);
        }
    });

    // Save scroll before navigating away or submitting any form
    window.addEventListener('beforeunload', saveScrollPosition);
    document.addEventListener('submit', function() {
        saveScrollPosition();
    }, true);

    function exportToExcel() {
        let table = document.querySelector('.table-results');
        let rows = table.querySelectorAll('tbody tr');
        let visibleRows = [];

        // Ambil hanya baris yang terlihat (tidak di-filter)
        rows.forEach(row => {
            if (row.style.display !== 'none') {
                visibleRows.push(row);
            }
        });

        // Buat tabel baru dengan hanya baris yang terlihat
        let newTable = table.cloneNode(true);
        let newTbody = newTable.querySelector('tbody');
        newTbody.innerHTML = '';

        visibleRows.forEach(row => {
            newTbody.appendChild(row.cloneNode(true));
        });

        let html = newTable.outerHTML;
        let url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
        let downloadLink = document.createElement("a");
        document.body.appendChild(downloadLink);
        downloadLink.href = url;
        downloadLink.download = 'perkiraan_stunting_<?php echo $tahun_perkiraan; ?>.xls';
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }

    function printTable() {
        // Sembunyikan elemen yang tidak perlu dicetak
        let elementsToHide = document.querySelectorAll('.form-section, .filter-section, .btn-primary, .btn-secondary');
        elementsToHide.forEach(el => {
            el.style.display = 'none';
        });

        // Tampilkan hanya baris yang terlihat
        let table = document.querySelector('.table-results tbody');
        let rows = table.querySelectorAll('tr');
        rows.forEach(row => {
            if (row.style.display === 'none') {
                row.style.display = 'none';
            }
        });

        window.print();

        // Kembalikan tampilan setelah cetak
        elementsToHide.forEach(el => {
            el.style.display = '';
        });
    }

    // Auto-submit form when wilayah is selected
    document.getElementById('id_wilayah').addEventListener('change', function() {
        if (this.value !== '') {
            // Create a form for single wilayah calculation
            let form = document.createElement('form');
            form.method = 'POST';
            form.innerHTML = `
            <input type="hidden" name="tahun_perkiraan" value="<?php echo $tahun_perkiraan; ?>">
            <input type="hidden" name="id_wilayah" value="${this.value}">
            <input type="hidden" name="hitung_wilayah" value="1">
        `;
            document.body.appendChild(form);
            // Save scroll before submit to restore after reload
            saveScrollPosition();
            form.submit();
        }
    });

    // Tambahkan event listener untuk tombol "Hitung Semua Wilayah"
    document.querySelector('button[name="hitung_semua_wilayah"]').addEventListener('click', function(e) {
        // Reset dropdown ke "Semua Wilayah"
        document.getElementById('id_wilayah').value = '';
        // Save scroll before submit
        saveScrollPosition();
    });

    // Tambahkan event listener untuk tombol "Hitung Perkiraan" agar posisi scroll tersimpan
    const btnHitungPerkiraan = document.querySelector('button[name="hitung_perkiraan"]');
    if (btnHitungPerkiraan) {
        btnHitungPerkiraan.addEventListener('click', function() {
            saveScrollPosition();
        });
    }

    // Fungsi pencarian dan filter
    function filterTable() {
        const searchTerm = document.getElementById('searchWilayah').value.toLowerCase();
        const statusFilter = document.getElementById('filterStatus').value;
        const sortBy = document.getElementById('sortBy').value;
        const table = document.querySelector('.table-results tbody');
        const rows = Array.from(table.querySelectorAll('tr'));

        // Filter rows
        rows.forEach(row => {
            const wilayahCell = row.cells[0];
            const statusCell = row.cells[8];

            if (!wilayahCell || !statusCell) return;

            const wilayahText = wilayahCell.textContent.toLowerCase();
            const statusText = statusCell.textContent.toLowerCase();

            let showRow = true;

            // Filter berdasarkan pencarian wilayah
            if (searchTerm && !wilayahText.includes(searchTerm)) {
                showRow = false;
            }

            // Filter berdasarkan status
            if (statusFilter) {
                if (statusFilter === 'naik' && !statusText.includes('naik')) {
                    showRow = false;
                } else if (statusFilter === 'turun' && !statusText.includes('turun')) {
                    showRow = false;
                } else if (statusFilter === 'validasi' && !statusText.includes('validasi')) {
                    showRow = false;
                } else if (statusFilter === 'prediksi' && !statusText.includes('prediksi')) {
                    showRow = false;
                }
            }

            row.style.display = showRow ? '' : 'none';
        });

        // Sorting
        if (sortBy) {
            const visibleRows = rows.filter(row => row.style.display !== 'none');

            visibleRows.sort((a, b) => {
                const aWilayah = a.cells[0].textContent.toLowerCase();
                const bWilayah = b.cells[0].textContent.toLowerCase();
                const aPrediksi = parseFloat(a.cells[5].textContent.replace(/[^\d]/g, '')) || 0;
                const bPrediksi = parseFloat(b.cells[5].textContent.replace(/[^\d]/g, '')) || 0;
                const aData = parseFloat(a.cells[7].textContent.replace(/[^\d]/g, '')) || 0; // Data tahun terakhir (2024)
                const bData = parseFloat(b.cells[7].textContent.replace(/[^\d]/g, '')) || 0;
                const aStatus = a.cells[8].textContent.toLowerCase();
                const bStatus = b.cells[8].textContent.toLowerCase();

                switch (sortBy) {
                    case 'wilayah':
                        return aWilayah.localeCompare(bWilayah);
                    case 'prediksi':
                        return bPrediksi - aPrediksi; // Tertinggi dulu
                    case 'prediksi-asc':
                        return aPrediksi - bPrediksi; // Terendah dulu
                    case 'data':
                        return bData - aData; // Tertinggi dulu
                    case 'status':
                        return aStatus.localeCompare(bStatus);
                    default:
                        return 0;
                }
            });

            // Reorder rows in DOM
            visibleRows.forEach(row => {
                table.appendChild(row);
            });
        }

        // Update jumlah baris yang ditampilkan
        updateVisibleCount();
    }

    function updateVisibleCount() {
        const table = document.querySelector('.table-results tbody');
        const visibleRows = table.querySelectorAll('tr:not([style*="display: none"])');
        const totalRows = table.querySelectorAll('tr').length;

        // Tambahkan informasi jumlah baris yang ditampilkan
        let infoElement = document.getElementById('tableInfo');
        if (!infoElement) {
            infoElement = document.createElement('div');
            infoElement.id = 'tableInfo';
            infoElement.className = 'alert alert-info';
            infoElement.style.marginTop = '10px';
            document.querySelector('.table-responsive').appendChild(infoElement);
        }

        infoElement.innerHTML = `<i class="fa fa-info-circle"></i> Menampilkan ${visibleRows.length} dari ${totalRows} wilayah`;
    }

    // Event listeners untuk filter
    if (document.getElementById('searchWilayah')) {
        document.getElementById('searchWilayah').addEventListener('input', filterTable);
    }

    if (document.getElementById('filterStatus')) {
        document.getElementById('filterStatus').addEventListener('change', filterTable);
    }

    if (document.getElementById('sortBy')) {
        document.getElementById('sortBy').addEventListener('change', filterTable);
    }

    if (document.getElementById('resetFilter')) {
        document.getElementById('resetFilter').addEventListener('click', function() {
            document.getElementById('searchWilayah').value = '';
            document.getElementById('filterStatus').value = '';
            document.getElementById('sortBy').value = ''; // Reset sorting
            filterTable();
        });
    }

    // Inisialisasi filter saat halaman dimuat
    if (document.getElementById('searchWilayah')) {
        updateVisibleCount();
    }

    // Fungsi untuk toggle penjelasan rumus
    function toggleFormulaExplanation() {
        const explanation = document.getElementById('formulaExplanation');
        const button = document.querySelector('button[onclick="toggleFormulaExplanation()"]');

        if (explanation.style.display === 'none') {
            explanation.style.display = 'block';
            button.innerHTML = '<i class="fa fa-eye-slash"></i> Sembunyikan Rumus';
        } else {
            explanation.style.display = 'none';
            button.innerHTML = '<i class="fa fa-eye"></i> Tampilkan Rumus';
        }
    }
</script>

<?php include "bawah.php"; ?>