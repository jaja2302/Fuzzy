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
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-sm font-semibold text-gray-700">PREDIKSI {{ $tahunPerkiraan ?? date('Y') + 1 }}</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">STATUS</th>
                                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">TIPE</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
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
                                        $statusBadge = ($statusLbl === 'Naik') ? 'status-up' : 'status-down';
                                        $rowClass = ($statusLbl === 'Naik') ? 'bg-green-50' : 'bg-red-50';
                                    @endphp
                                    <tr class="{{ $rowClass }}">
                                        <td class="px-4 py-2 text-sm text-gray-800">
                                            <strong>{{ $data['nama_wilayah'] ?? 'Unknown' }}</strong><br>
                                            <small class="text-gray-600">{{ $data['provinsi'] ?? 'Unknown' }}</small>
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-800">
                                            <strong>{{ $prevYear }}:</strong> {{ number_format($val_t1) }}<br>
                                            <strong>{{ $lastYear }}:</strong> {{ number_format($val_t2) }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-800">
                                            <strong>{{ $prevYear }}:</strong> {{ $fs_t1 }}<br>
                                            <strong>{{ $lastYear }}:</strong> {{ $fs_t2 }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-800">
                                            <strong>{{ number_format($data['jumlah_perkiraan']) }}</strong><br>
                                            <small class="text-gray-600">Midpoint {{ $fs_t2 }}</small>
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
                            <li><strong>Fuzzy Set:</strong> Menggunakan 6 interval (A1-A6) dengan semesta U tetap</li>
                            <li><strong>Prediksi:</strong> Berdasarkan midpoint dari fuzzy set terakhir</li>
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

    <script>
        // Chart initialization
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('performanceChart').getContext('2d');
            
            // Get actual data from the results
            @if(isset($results) && count($results) > 0)
                const results = @json($results);
                
                // Prepare chart data with proper data extraction
                const chartData = {
                    labels: results.map(item => item.nama_wilayah),
                    datasets: [
                        {
                            label: 'Data Historis 2023',
                            data: results.map(item => {
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
                            data: results.map(item => {
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
                            label: 'Prediksi 2025',
                            data: results.map(item => item.jumlah_perkiraan || 0),
                            backgroundColor: 'rgba(255, 206, 86, 0.8)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 2,
                            type: 'bar',
                            order: 2
                        }
                    ]
                };

                // Remove trend line section - no longer needed
                // The chart will only show bar charts for historical data and predictions
            @else
                // Fallback to sample data if no results
                const chartData = {
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
            @endif
            
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
                            text: 'Perbandingan Performa Fuzzy Time Series'
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
         * Menggunakan semesta U tetap (Bab 3)
         */
        function findFuzzySet($value) {
            // Semesta U tetap: Min = 2,775; k = 6; Ukuran interval = 11,005
            $min = 2775;
            $interval_size = 11005;
            
            if ($value <= $min) {
                return 'A1';
            } elseif ($value <= $min + $interval_size) {
                return 'A2';
            } elseif ($value <= $min + (2 * $interval_size)) {
                return 'A3';
            } elseif ($value <= $min + (3 * $interval_size)) {
                return 'A4';
            } elseif ($value <= $min + (4 * $interval_size)) {
                return 'A5';
            } else {
                return 'A6';
            }
        }
    @endphp
    @endsection