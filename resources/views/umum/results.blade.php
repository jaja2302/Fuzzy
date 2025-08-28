@extends('welcome')

@section('title', 'Perkiraan Stunting - FTS')
@section('description', 'Perkiraan Stunting di BKKBN SUMUT')

@section('content')
<div class="header">
    <div class="container">
        <h1><i class="fas fa-chart-line mr-3"></i>Fuzzy Time Series Analysis</h1>
        <p>Analisis dan Prediksi Data Stunting menggunakan Metode Fuzzy Time Series</p>
    </div>
</div>

<div class="container">
    <!-- Filter Section -->
    <div class="filter-section">
        <h3><i class="fas fa-filter mr-2"></i>Filter Data</h3>
        <form method="GET" action="{{ route('umum.results') }}">
            <div class="filter-grid">
                <div class="form-group">
                    <label for="wilayah_id">Wilayah</label>
                    <select name="wilayah_id" id="wilayah_id">
                        <option value="">Semua Wilayah</option>
                        @foreach($wilayahs as $wilayah)
                        <option value="{{ $wilayah->id }}" {{ $wilayahId == $wilayah->id ? 'selected' : '' }}>
                            {{ $wilayah->nama_wilayah }}, {{ $wilayah->provinsi }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tahun_awal">Tahun Awal</label>
                    <input type="number" name="tahun_awal" id="tahun_awal" value="{{ $tahunAwal }}" min="2010" max="2030">
                </div>
                <div class="form-group">
                    <label for="tahun_akhir">Tahun Akhir</label>
                    <input type="number" name="tahun_akhir" id="tahun_akhir" value="{{ $tahunAkhir }}" min="2010" max="2030">
                </div>
                <div class="form-group">
                    <label for="tahun_perkiraan">Tahun Prediksi</label>
                    <input type="number" name="tahun_perkiraan" id="tahun_perkiraan" value="{{ $tahunPerkiraan }}" min="2010" max="2030">
                </div>
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search mr-2"></i>Analisis Data
                </button>
                <a href="{{ route('umum.results') }}" class="btn btn-secondary">
                    <i class="fas fa-undo mr-2"></i>Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Results Section -->
    @if(isset($results) && count($results) > 0)
    <div class="results-section">
        <h4 class="section-header">
            <i class="fas fa-table mr-2"></i>HASIL PERHITUNGAN FTS
        </h4>
        <div class="section-content">
            <div class="table-container">
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
                        // Ambil SEMUA data historis untuk High-Order FTS (konsisten dengan halaman login)
                        $hist = isset($data['data_historis']) && is_array($data['data_historis']) ? $data['data_historis'] : [];
                        usort($hist, function ($a, $b) {
                        return $a['tahun'] <=> $b['tahun'];
                            });

                            // Hitung status dengan safety check
                            $selisih = $data['selisih'] ?? 0;
                            $statusLbl = ($selisih > 0) ? 'Naik' : 'Turun';
                            $statusBadge = ($statusLbl === 'Naik') ? 'status-up' : 'status-down';
                            $rowClass = ($statusLbl === 'Naik') ? 'bg-green-50' : 'bg-red-50';
                            @endphp
                            <tr class="{{ $rowClass }}">
                                <td class="px-4 py-2 text-sm text-gray-800">
                                    <strong>{{ $data['nama_wilayah'] ?? 'Unknown' }}</strong><br>
                                    <small class="text-gray-600">{{ $data['provinsi'] ?? 'Unknown' }}</small>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-800">
                                    <strong class="text-blue-600">Semua Data Historis:</strong><br>
                                    @foreach($hist as $index => $histItem)
                                    <div class="text-xs">
                                        <strong>{{ $histItem['tahun'] }}:</strong> {{ number_format($histItem['jumlah']) }}
                                        @if($index < count($hist) - 1)<br>@endif
                                    </div>
                                    @endforeach
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-800">
                                    @foreach($hist as $index => $histItem)
                                    @php $fs_item = findFuzzySet($histItem['jumlah']) @endphp
                                    <div class="text-xs">
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
                                    <span class="status-badge {{ $statusBadge }}">{{ $statusLbl }}</span><br>
                                    <small class="text-gray-600">
                                        Selisih: {{ number_format($data['selisih']) }}
                                    </small>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-800">
                                    <span class="type-badge {{ $data['tipe'] == 'validasi' ? 'type-validation' : 'type-prediction' }}">
                                        {{ ucfirst($data['tipe']) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Informasi Tambahan -->
            <div class="info-box">
                <h6>
                    <i class="fas fa-info-circle mr-2"></i> Informasi Perhitungan:
                </h6>
                <ul>
                    <li><strong>Fuzzy Set:</strong> Menggunakan 6 interval tetap (A1-A6) dengan semesta U standar</li>
                    <li><strong>Prediksi:</strong> High-Order FTS dengan weighted average dari SEMUA data historis</li>
                    <li><strong>Bobot:</strong> Data tahun terbaru = bobot tertinggi, data lama = bobot rendah</li>
                    <li><strong>Status:</strong> Naik jika prediksi > data terakhir, Turun jika sebaliknya</li>
                    <li><strong>Tipe:</strong> Validasi (data sudah ada) atau Prediksi (data belum ada)</li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="empty-state">
        <i class="fas fa-chart-line"></i>
        <h3>Tidak ada data yang tersedia</h3>
        <p>Silakan coba ubah filter atau pilih parameter yang berbeda.</p>
    </div>
    @endif

    <!-- Performance Visualization -->
    <div class="chart-section">
        <h4 class="chart-header">
            <i class="fas fa-chart-area mr-2"></i>Visualisasi Performa FTS
        </h4>
        <div class="chart-content">
            <canvas id="performanceChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

@php
$hasResults = isset($results) && count($results) > 0;
$tahunPrediksi = $tahunPerkiraan ?? 2025;
$chartResults = $hasResults ? $results : [];
@endphp

<script type="text/javascript">
    // Global data for chart
    window.chartConfig = {
        hasResults: @json($hasResults),
        chartResults: @json($chartResults),
        tahunPrediksi: @json($tahunPrediksi)
    };
    /* eslint-enable */
</script>

<script>
    // Chart initialization
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('performanceChart').getContext('2d');

        // Use global data
        const hasResults = window.chartConfig.hasResults;
        const chartResults = window.chartConfig.chartResults;
        const tahunPrediksi = window.chartConfig.tahunPrediksi;

        // Get actual data from the results and fix linter errors
        let chartData;

        if (hasResults && chartResults.length > 0) {
            // Prepare chart data with dynamic historical data (semua tahun)
            chartData = {
                labels: chartResults.map(item => item.nama_wilayah),
                datasets: [{
                        label: 'Data Historis 2022',
                        data: chartResults.map(item => {
                            const hist2022 = item.data_historis?.find(d => d.tahun == 2022);
                            return hist2022 ? hist2022.jumlah : 0;
                        }),
                        backgroundColor: 'rgba(255, 99, 132, 0.8)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        type: 'bar',
                        order: 2
                    },
                    {
                        label: 'Data Historis 2023',
                        data: chartResults.map(item => {
                            const hist2023 = item.data_historis?.find(d => d.tahun == 2023);
                            return hist2023 ? hist2023.jumlah : 0;
                        }),
                        backgroundColor: 'rgba(54, 162, 235, 0.8)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        type: 'bar',
                        order: 2
                    },
                    {
                        label: 'Data Historis 2024',
                        data: chartResults.map(item => {
                            const hist2024 = item.data_historis?.find(d => d.tahun == 2024);
                            return hist2024 ? hist2024.jumlah : 0;
                        }),
                        backgroundColor: 'rgba(75, 192, 192, 0.8)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        type: 'bar',
                        order: 2
                    },
                    {
                        label: `Prediksi ${tahunPrediksi} (High-Order FTS)`,
                        data: chartResults.map(item => item.jumlah_perkiraan || 0),
                        backgroundColor: 'rgba(255, 206, 86, 0.8)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 2,
                        type: 'bar',
                        order: 2
                    }
                ]
            };
        } else {
            // Fallback to sample data if no results
            chartData = {
                labels: ['Tidak Ada Data'],
                datasets: [{
                    label: 'Nilai Aktual',
                    data: [0],
                    borderColor: 'rgb(156, 163, 175)',
                    backgroundColor: 'rgba(156, 163, 175, 0.1)',
                    tension: 0.1
                }, {
                    label: 'Nilai Prediksi',
                    data: [0],
                    borderColor: 'rgb(156, 163, 175)',
                    backgroundColor: 'rgba(156, 163, 175, 0.1)',
                    tension: 0.1
                }]
            };
        }

        new Chart(ctx, {
            data: chartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Performa High-Order Fuzzy Time Series (Dynamic)'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Stunting'
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Wilayah (Tahun)'
                        },
                        grid: {
                            display: false
                        }

                    }
                },
                elements: {
                    bar: {
                        borderRadius: 8,
                        borderWidth: 2
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });
    });
</script>

@php
/**
* Helper function untuk menghitung fuzzy set berdasarkan nilai
* Konsisten dengan service FTS (Bab 3)
*/
function findFuzzySet($value) {
if ($value == 0) return '-';

// Semesta U tetap (konsisten dengan service)
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