@extends('welcome')

@section('title', 'Data Stunting - FTS')
@section('description', 'Data stunting wilayah BKKBN SUMUT')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Data Stunting</h1>
            <div class="flex gap-2">
                <a href="{{ route('umum.results') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    <i class="fas fa-chart-line mr-2"></i>
                    Hasil Perkiraan
                </a>
                <a href="{{ route('umum.wilayah-data') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    Data Wilayah
                </a>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="mb-6 bg-gray-50 rounded-lg p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Wilayah</label>
                    <input type="text" id="searchWilayah" placeholder="Masukkan nama wilayah..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                    <select id="filterTahun" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Semua Tahun</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="filterStatus" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Semua Status</option>
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Rendah">Rendah</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Data</p>
                        <p class="text-3xl font-bold">{{ $totalData ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-database text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-lg p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Rata-rata</p>
                        <p class="text-3xl font-bold">{{ number_format($averageStunting ?? 0, 1) }}%</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white rounded-lg p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium">Tertinggi</p>
                        <p class="text-3xl font-bold">{{ $highestStunting ?? 0 }}%</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-arrow-up text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-500 to-red-600 text-white rounded-lg p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium">Terendah</p>
                        <p class="text-3xl font-bold">{{ $lowestStunting ?? 0 }}%</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-arrow-down text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wilayah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persentase Stunting</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="stuntingTableBody">
                        @if(isset($stuntingData) && count($stuntingData) > 0)
                            @foreach($stuntingData as $index => $data)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->wilayah ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data->tahun ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data->persentase_stunting ?? 'N/A' }}%</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $status = '';
                                        $statusClass = '';
                                        if (isset($data->persentase_stunting)) {
                                            if ($data->persentase_stunting >= 30) {
                                                $status = 'Tinggi';
                                                $statusClass = 'bg-red-100 text-red-800';
                                            } elseif ($data->persentase_stunting >= 20) {
                                                $status = 'Sedang';
                                                $statusClass = 'bg-yellow-100 text-yellow-800';
                                            } else {
                                                $status = 'Rendah';
                                                $statusClass = 'bg-green-100 text-green-800';
                                            }
                                        }
                                    @endphp
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusClass }}">{{ $status }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data->keterangan ?? '-' }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada data stunting tersedia
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if(isset($stuntingData) && method_exists($stuntingData, 'links'))
            <div class="mt-6">
                {{ $stuntingData->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Chart Section -->
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Grafik Trend Stunting</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Trend per Tahun</h3>
                <canvas id="yearlyChart" width="400" height="200"></canvas>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Distribusi Status</h3>
                <canvas id="statusChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search and filter functionality
    const searchInput = document.getElementById('searchWilayah');
    const yearFilter = document.getElementById('filterTahun');
    const statusFilter = document.getElementById('filterStatus');
    const tableBody = document.getElementById('stuntingTableBody');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedYear = yearFilter.value;
        const selectedStatus = statusFilter.value;

        const rows = tableBody.querySelectorAll('tr');
        
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length === 0) return; // Skip header row

            const wilayah = cells[1].textContent.toLowerCase();
            const tahun = cells[2].textContent;
            const status = cells[4].textContent;

            const matchesSearch = wilayah.includes(searchTerm);
            const matchesYear = !selectedYear || tahun === selectedYear;
            const matchesStatus = !selectedStatus || status.includes(selectedStatus);

            if (matchesSearch && matchesYear && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterTable);
    yearFilter.addEventListener('change', filterTable);
    statusFilter.addEventListener('change', filterTable);

    // Charts
    // Yearly Trend Chart
    const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
    const yearlyChart = new Chart(yearlyCtx, {
        type: 'line',
        data: {
            labels: ['2019', '2020', '2021', '2022', '2023', '2024'],
            datasets: [{
                label: 'Rata-rata Stunting (%)',
                data: [15.2, 16.8, 14.5, 13.9, 12.7, 11.8],
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Trend Stunting per Tahun'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Persentase Stunting (%)'
                    }
                }
            }
        }
    });

    // Status Distribution Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Tinggi', 'Sedang', 'Rendah'],
            datasets: [{
                data: [25, 45, 30],
                backgroundColor: [
                    'rgb(239, 68, 68)',
                    'rgb(245, 158, 11)',
                    'rgb(34, 197, 94)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Distribusi Status Stunting'
                },
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
</script>
@endsection
