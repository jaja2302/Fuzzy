@extends('layouts.app')

@section('title', 'Hasil Fuzzy Time Series')

@section('content')
<div class="container mx-auto px-4">
    <!-- Header -->
    <div class="grid grid-cols-1 gap-4">
        <div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-primary-600 text-white p-4">
                    <h3 class="text-xl font-bold">
                        <i class="fas fa-chart-line mr-2"></i>
                        HASIL PERHITUNGAN FUZZY TIME SERIES
                    </h3>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <div class="bg-blue-500 text-white rounded-lg p-4 flex items-center">
                                <span class="bg-blue-600 rounded-full p-3 mr-4">
                                    <i class="fas fa-database text-white"></i>
                                </span>
                                <div>
                                    <span class="block text-sm">Total Wilayah</span>
                                    <span class="block text-lg font-bold">{{ count($results) }}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="bg-green-500 text-white rounded-lg p-4 flex items-center">
                                <span class="bg-green-600 rounded-full p-3 mr-4">
                                    <i class="fas fa-chart-bar text-white"></i>
                                </span>
                                <div>
                                    <span class="block text-sm">Data Validasi</span>
                                    <span class="block text-lg font-bold">{{ count(array_filter($results, function($item) { return $item['tipe'] == 'validasi'; })) }}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="bg-yellow-500 text-white rounded-lg p-4 flex items-center">
                                <span class="bg-yellow-600 rounded-full p-3 mr-4">
                                    <i class="fas fa-percentage text-white"></i>
                                </span>
                                <div>
                                    <span class="block text-sm">Data Prediksi</span>
                                    <span class="block text-lg font-bold">{{ count(array_filter($results, function($item) { return $item['tipe'] == 'prediksi'; })) }}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="bg-red-500 text-white rounded-lg p-4 flex items-center">
                                <span class="bg-red-600 rounded-full p-3 mr-4">
                                    <i class="fas fa-chart-line text-white"></i>
                                </span>
                                <div>
                                    <span class="block text-sm">Tahun Prediksi</span>
                                    <span class="block text-lg font-bold">{{ $tahunPerkiraan ?? date('Y') + 1 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Info -->
    <div class="mt-4">
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-4 border-b">
                <h5 class="text-lg font-semibold">Filter yang Digunakan:</h5>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <strong>Wilayah:</strong>
                        @if(isset($wilayahId) && $wilayahId)
                        @php $wilayah = \App\Models\Wilayah::where('ID_Wilayah', $wilayahId)->first() @endphp
                        {{ $wilayah ? $wilayah->Kabupaten : 'Tidak ditemukan' }}
                        @else
                        Semua Wilayah
                        @endif
                    </div>
                    <div>
                        <strong>Tahun Awal:</strong> {{ $tahunAwal ?? 'Semua' }}
                    </div>
                    <div>
                        <strong>Tahun Akhir:</strong> {{ $tahunAkhir ?? 'Semua' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Penjelasan Rumus FTS -->
    <div class="mt-4">
        <div class="bg-white shadow-md rounded-lg">
            <div class="bg-green-600 text-white p-4 rounded-t-lg">
                <h5 class="text-lg font-bold">
                    <i class="fas fa-calculator mr-2"></i> RUMUS FUZZY TIME SERIES (FTS) YANG DIGUNAKAN
                </h5>
            </div>
            <div class="p-4">
                <div class="bg-blue-100 border border-blue-200 p-4 rounded-lg">
                    <h6 class="text-base font-semibold mb-2">
                        <i class="fas fa-list-ol mr-2"></i> Langkah-langkah Perhitungan:
                    </h6>
                    <ol class="list-decimal list-inside space-y-2">
                        <li><strong>Pengumpulan Data Historis:</strong> Mengambil SEMUA data historis yang tersedia ({{ isset($results[0]['data_historis']) ? count($results[0]['data_historis']) : '3' }} tahun data)
                            <br><em class="text-gray-600"><strong>Interval fuzzy tetap menggunakan standar A1-A6</strong>, namun perhitungan prediksi menggunakan semua data historis dengan weighted average untuk akurasi lebih tinggi</em>
                        </li>
                        <li><strong>Penentuan Semesta U (Universe of Discourse):</strong>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Nilai minimum (Min) = <code>2,775</code></li>
                                <li>Nilai maksimum (Max) = <code>69,296</code></li>
                                <li>Jumlah interval (k) dengan rumus Sturges: <code>k = 1 + 3.322 × log₁₀(33) ≈ 6.0445 → 6</code></li>
                                <li>Ukuran interval: <code>(Max − Min) / k = (69,296 − 2,775) / 6 = 11,005</code></li>
                                <li><em>Konvensi batas:</em> semua interval menggunakan <code>[lower, upper]</code> kecuali interval terakhir <code>[lower, upper]</code></li>
                            </ul>
                        </li>
                        <li><strong>Pembentukan Interval & Himpunan Fuzzy:</strong>
                            <ul class="list-disc list-inside space-y-1">
                                <li>A₁: <code>[2,775, 13,780]</code></li>
                                <li>A₂: <code>[13,780, 24,785]</code></li>
                                <li>A₃: <code>[24,785, 35,790]</code></li>
                                <li>A₄: <code>[35,790, 46,795]</code></li>
                                <li>A₅: <code>[46,795, 57,800]</code></li>
                                <li>A₆: <code>[57,800, 68,805]</code></li>
                            </ul>
                        </li>
                        <li><strong>Fuzzifikasi Semua Data Historis:</strong>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Kelompokkan tiap nilai dari SEMUA tahun ke A₁–A₆ sesuai interval pada Semesta U</li>
                                <li>Catat fuzzy set untuk setiap tahun dalam data historis</li>
                                <li>Setiap nilai stunting dikonversi ke fuzzy set berdasarkan interval yang sesuai</li>
                            </ul>
                        </li>
                        <li><strong>Prediksi High-Order FTS:</strong>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Metode Weighted Average:</strong> Gunakan SEMUA fuzzy set dari data historis dengan bobot berbeda</li>
                                <li><strong>Sistem Bobot:</strong> Data terbaru mendapat bobot tertinggi, data lama mendapat bobot rendah</li>
                                <li><strong>Rumus:</strong> <code>Prediksi = Σ(midpoint × bobot) / Σ(bobot)</code></li>
                                <li><strong>Keunggulan:</strong> Lebih akurat dibanding Chen klasik karena mempertimbangkan trend jangka panjang</li>
                            </ul>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Interval Fuzzy Set -->
    <div class="mt-4">
        <div class="bg-white shadow-md rounded-lg">
            <div class="bg-info-600 text-white p-4 rounded-t-lg">
                <h5 class="text-lg font-bold">
                    <i class="fas fa-table mr-2"></i> Tabel Interval Fuzzy Set (Semesta U Tetap):
                </h5>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="table-auto border-collapse w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Interval</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Fuzzy Set</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Midpoint</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-800">2,775 – 13,780</td>
                                <td class="px-4 py-2 text-sm text-gray-800"><span class="inline-block px-2 py-1 rounded-full bg-blue-500 text-white text-xs font-semibold">A1</span></td>
                                <td class="px-4 py-2 text-sm text-gray-800">8,277.5</td>
                                <td class="px-4 py-2 text-sm text-gray-800">Rentang 2,775 hingga 13,780</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-800">13,780 – 24,785</td>
                                <td class="px-4 py-2 text-sm text-gray-800"><span class="inline-block px-2 py-1 rounded-full bg-blue-500 text-white text-xs font-semibold">A2</span></td>
                                <td class="px-4 py-2 text-sm text-gray-800">19,282.5</td>
                                <td class="px-4 py-2 text-sm text-gray-800">Rentang 13,780 hingga 24,785</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-800">24,785 – 35,790</td>
                                <td class="px-4 py-2 text-sm text-gray-800"><span class="inline-block px-2 py-1 rounded-full bg-blue-500 text-white text-xs font-semibold">A3</span></td>
                                <td class="px-4 py-2 text-sm text-gray-800">30,287.5</td>
                                <td class="px-4 py-2 text-sm text-gray-800">Rentang 24,785 hingga 35,790</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-800">35,790 – 46,795</td>
                                <td class="px-4 py-2 text-sm text-gray-800"><span class="inline-block px-2 py-1 rounded-full bg-blue-500 text-white text-xs font-semibold">A4</span></td>
                                <td class="px-4 py-2 text-sm text-gray-800">41,292.5</td>
                                <td class="px-4 py-2 text-sm text-gray-800">Rentang 35,790 hingga 46,795</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-800">46,795 – 57,800</td>
                                <td class="px-4 py-2 text-sm text-gray-800"><span class="inline-block px-2 py-1 rounded-full bg-blue-500 text-white text-xs font-semibold">A5</span></td>
                                <td class="px-4 py-2 text-sm text-gray-800">52,297.5</td>
                                <td class="px-4 py-2 text-sm text-gray-800">Rentang 46,795 hingga 57,800</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-800">57,800 – 68,805</td>
                                <td class="px-4 py-2 text-sm text-gray-800"><span class="inline-block px-2 py-1 rounded-full bg-blue-500 text-white text-xs font-semibold">A6</span></td>
                                <td class="px-4 py-2 text-sm text-gray-800">63,302.5</td>
                                <td class="px-4 py-2 text-sm text-gray-800">Rentang 57,800 hingga 68,805</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Hasil Perhitungan -->
    <div class="mt-4">
        <div class="bg-white shadow-md rounded-lg">
            <div class="bg-warning-600 text-white p-4 rounded-t-lg">
                <h5 class="text-lg font-bold">
                    <i class="fas fa-table mr-2"></i> HASIL PERHITUNGAN FTS
                </h5>
            </div>
            <div class="p-4">
                @if(count($results) > 0)
                <div class="overflow-x-auto">
                    <table class="table-auto border-collapse w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">WILAYAH</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">DATA HISTORIS</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">FUZZY SET</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">PREDIKSI {{ $tahunPerkiraan ?? date('Y') + 1 }}</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">STATUS</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">TIPE</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($results as $data)
                            @php
                            // Ambil semua data historis untuk High-Order FTS
                            $hist = isset($data['data_historis']) && is_array($data['data_historis']) ? $data['data_historis'] : [];
                            usort($hist, function ($a, $b) {
                            return $a['tahun'] <=> $b['tahun'];
                                });

                                // Hitung status dengan safety check
                                $selisih = $data['selisih'] ?? 0;
                                $statusLbl = ($selisih > 0) ? 'Naik' : 'Turun';
                                $statusBadge = ($statusLbl === 'Naik') ? 'bg-green-500' : 'bg-red-500';
                                $rowClass = ($statusLbl === 'Naik') ? 'bg-green-50' : 'bg-red-50';
                                @endphp
                                <tr class="{{ $rowClass }}">
                                    <td class="px-4 py-2 text-sm text-gray-800">
                                        <strong>{{ $data['nama_wilayah'] ?? 'Unknown' }}</strong><br>
                                        <small class="text-gray-600">{{ $data['provinsi'] ?? 'Unknown' }}</small>
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-800">
                                        <div class="mb-2">
                                            <strong class="text-blue-600">Semua Data Historis:</strong>
                                            @foreach($hist as $index => $histItem)
                                            @php $weight = $index + 1 @endphp
                                            <div class="text-xs font-semibold text-green-600">
                                                <strong>{{ $histItem['tahun'] }}:</strong> {{ number_format($histItem['jumlah']) }}
                                                <span class="text-xs bg-blue-100 text-blue-800 px-1 rounded">bobot: {{ $weight }}</span>
                                            </div>
                                            @endforeach
                                        </div>

                                        <div class="text-xs text-gray-600 bg-green-50 p-2 rounded">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            <strong>High-Order FTS (Dynamic)</strong> menggunakan <strong>{{ count($hist) }} data</strong> untuk perhitungan prediksi
                                            <br><small>Metode ini menggunakan weighted average dari semua data historis untuk hasil lebih akurat</small>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-800">
                                        @foreach($hist as $index => $histItem)
                                        @php $fs_item = findFuzzySet($histItem['jumlah']) @endphp
                                        <div class="text-xs mb-1">
                                            <strong>{{ $histItem['tahun'] }}:</strong> {{ $fs_item }}
                                            @if($index < count($hist) - 1)<br>@endif
                                        </div>
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-800">
                                        <strong>{{ number_format($data['jumlah_perkiraan']) }}</strong><br>
                                        <small class="text-gray-600">Weighted Average dari {{ count($hist) }} data</small>
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-800">
                                        <span class="inline-block px-2 py-1 rounded-full {{ $statusBadge }} text-white text-xs font-semibold">{{ $statusLbl }}</span><br>
                                        <small class="text-gray-600">
                                            @if($data['tipe'] == 'validasi')
                                            Selisih: {{ number_format($data['selisih']) }}
                                            @else
                                            Selisih: {{ number_format($data['selisih']) }}
                                            @endif
                                        </small>
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-800">
                                        <span class="inline-block px-2 py-1 rounded-full {{ $data['tipe'] == 'validasi' ? 'bg-blue-500' : 'bg-yellow-500' }} text-white text-xs font-semibold">
                                            {{ ucfirst($data['tipe']) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Informasi Tambahan -->
                <div class="mt-4">
                    <div class="bg-blue-100 border border-blue-200 p-4 rounded-lg">
                        <h6 class="text-base font-semibold mb-2">
                            <i class="fas fa-info-circle mr-2"></i> Informasi Perhitungan:
                        </h6>
                        <ul class="list-disc list-inside space-y-1">
                            <li><strong>Fuzzy Set:</strong> Menggunakan 6 interval tetap (A1-A6) dengan semesta U standar</li>
                            <li><strong>Prediksi:</strong> High-Order FTS dengan weighted average dari SEMUA data historis</li>
                            <li><strong>Bobot:</strong> Data tahun terbaru = bobot tertinggi, data lama = bobot rendah</li>
                            <li><strong>Status:</strong> Naik jika prediksi > data terakhir, Turun jika sebaliknya</li>
                            <li><strong>Tipe:</strong> Validasi (data sudah ada) atau Prediksi (data belum ada)</li>
                        </ul>
                    </div>
                </div>

                <!-- Contoh Perhitungan Detail (Format Chen Klasik Dinamis) -->
                <div class="mt-4">
                    <h6 class="text-lg font-bold">
                        <i class="fas fa-calculator mr-2"></i> Contoh Perhitungan Detail (Wilayah Pertama):
                    </h6>
                    @php
                    // Ambil 1 sampel wilayah untuk contoh
                    $sample_data = $results[0] ?? null;
                    if ($sample_data) {
                    $hist = $sample_data['data_historis'];
                    usort($hist, function ($a, $b) {
                    return $a['tahun'] <=> $b['tahun'];
                        });

                        // Semesta U global (tetap)
                        $global_min = 2775;
                        $global_max_text = 69296;
                        $interval_size_dyn = 11005;

                        // Helper format
                        $fmt = function ($x, $dec = 0) {
                        return number_format($x, $dec, ',', '.');
                        };

                        // Hitung fuzzy set untuk setiap tahun
                        $fuzzy_data = [];
                        foreach($hist as $histItem) {
                        $fuzzy_data[] = [
                        'tahun' => $histItem['tahun'],
                        'nilai' => $histItem['jumlah'],
                        'fuzzy' => findFuzzySet($histItem['jumlah'])
                        ];
                        }

                        // Ambil data 2 tahun terakhir untuk relasi (format Chen klasik)
                        $tahun_count = count($fuzzy_data);
                        $tahun1 = $tahun_count >= 2 ? $fuzzy_data[$tahun_count-2] : null;
                        $tahun2 = $tahun_count >= 1 ? $fuzzy_data[$tahun_count-1] : null;

                        // Gunakan prediksi dari service (konsisten dengan tabel utama)
                        $prediksi_service = $sample_data['jumlah_perkiraan'] ?? 0;
                        $metode_service = $sample_data['fuzzy_sets']['metode_digunakan'] ?? 'High-Order FTS';

                        // Status berdasarkan prediksi service vs data terakhir
                        $status_service = ($prediksi_service > ($tahun2['nilai'] ?? 0)) ? 'Naik' : 'Turun';
                        }
                        @endphp

                        @if($sample_data)
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            <p><strong>Wilayah:</strong> {{ $sample_data['nama_wilayah'] ?? 'Unknown' }} (Format Chen Klasik dengan Semua Data Historis)</p>

                            <div class="mb-4">
                                <strong>Semua Data Historis yang Tersedia:</strong>
                                <ul class="list-disc list-inside ml-4 space-y-1">
                                    @foreach($fuzzy_data as $fd)
                                    <li><strong>{{ $fd['tahun'] }}:</strong> {{ $fmt($fd['nilai']) }} kasus → <strong>{{ $fd['fuzzy'] }}</strong></li>
                                    @endforeach
                                    <li>Min Global = {{ $fmt($global_min) }}, Max Global = {{ $fmt($global_max_text) }}, n = 33</li>
                                    <li>Jumlah interval (Sturges) = 1 + 3.322 × log₁₀(33) ≈ 6.04 → <strong>6</strong></li>
                                    <li>Ukuran interval = ({{ $fmt($global_max_text) }} − {{ $fmt($global_min) }}) / 6 ≈ <strong>{{ $fmt($interval_size_dyn, 0) }}</strong></li>
                                    @if($tahun1 && $tahun2)
                                    <li>Keanggotaan fuzzy: {{ $tahun1['tahun'] }} → <strong>{{ $tahun1['fuzzy'] }}</strong>, {{ $tahun2['tahun'] }} → <strong>{{ $tahun2['fuzzy'] }}</strong></li>
                                    <li><strong>Metode:</strong> {{ $metode_service }} (menggunakan {{ count($fuzzy_data) }} data historis)</li>
                                    <li><strong>Prediksi {{ ($tahun2['tahun'] ?? 0) + 1 }} ≈ {{ $fmt($prediksi_service) }}</strong></li>
                                    @endif
                                </ul>
                            </div>

                            @if($tahun1 && $tahun2)
                            <div class="bg-white p-4 rounded-lg shadow-sm mt-4">
                                <h6 class="font-semibold mb-2">Tabel Relasi Fuzzy (Format Chen Klasik):</h6>
                                <table class="table-auto border-collapse w-full" style="margin:0;">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            @foreach($fuzzy_data as $fd)
                                            <th class="border px-2 py-1 text-sm">Fuzzy {{ $fd['tahun'] }}</th>
                                            @endforeach
                                            <th class="border px-2 py-1 text-sm">Relasi</th>
                                            <th class="border px-2 py-1 text-sm">Metode</th>
                                            <th class="border px-2 py-1 text-sm">Prediksi {{ ($tahun2['tahun'] ?? 0) + 1 }}</th>
                                            <th class="border px-2 py-1 text-sm">Data {{ $tahun2['tahun'] ?? 'Terakhir' }}</th>
                                            <th class="border px-2 py-1 text-sm">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach($fuzzy_data as $fd)
                                            <td class="border px-2 py-1 text-sm text-center">{{ $fd['fuzzy'] }}</td>
                                            @endforeach
                                            <td class="border px-2 py-1 text-sm text-center">{{ $tahun1['fuzzy'] }}→{{ $tahun2['fuzzy'] }}</td>
                                            <td class="border px-2 py-1 text-sm text-center">{{ $metode_service }}</td>
                                            <td class="border px-2 py-1 text-sm text-center">{{ $fmt($prediksi_service) }}</td>
                                            <td class="border px-2 py-1 text-sm text-center">{{ $fmt($tahun2['nilai']) }}</td>
                                            <td class="border px-2 py-1 text-sm text-center">
                                                <span class="inline-block px-2 py-1 rounded-full {{ $status_service === 'Naik' ? 'bg-green-500' : 'bg-red-500' }} text-white text-xs font-semibold">
                                                    {{ $status_service }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <small class="text-gray-600 mt-2 block">Catatan: Tabel di atas menampilkan <strong>semua data historis dalam kolom fuzzy</strong> ({{ count($fuzzy_data) }} tahun) dan <strong>prediksi konsisten dengan tabel utama</strong> menggunakan {{ $metode_service }}. Nilai prediksi <strong>{{ $fmt($prediksi_service) }}</strong> dihitung oleh service yang sama. Ganti pilihan <strong>Wilayah</strong> pada form di atas untuk melihat contoh dinamis wilayah lain.</small>
                        </div>
                        @else
                        <p class="text-gray-600"><em>Data tidak tersedia untuk contoh perhitungan.</em></p>
                        @endif
                </div>
                @else
                <div class="bg-yellow-100 border border-yellow-200 p-4 rounded-lg text-center">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                    Tidak ada data hasil perhitungan yang ditemukan.
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-4">
        <div class="text-center">
            <a href="{{ route('fuzzy-time-series.index') }}" class="inline-block px-4 py-2 rounded-md bg-gray-300 text-gray-800 hover:bg-gray-400 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Form
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
    $lower=$min + (($i - 1) * $interval_size);
    $upper=$min + ($i * $interval_size);
    $is_last=($i===$jumlah_interval);

    if (($value>= $lower && $value < $upper) || ($is_last && $value>= $lower)) {
        return 'A' . $i;
        }
        }

        return '-';
        }
        @endphp
        @endsection