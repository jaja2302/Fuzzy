@extends('welcome')

@section('title', 'Data Wilayah - FTS')
@section('description', 'Data wilayah BKKBN SUMUT')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Data Wilayah</h1>
            <div class="flex gap-2">
                <a href="{{ route('umum.results') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    <i class="fas fa-chart-line mr-2"></i>
                    Hasil Perkiraan
                </a>
                <a href="{{ route('umum.stunting-data') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Data Stunting
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                    <select id="filterProvinsi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Semua Provinsi</option>
                        <option value="Sumatera Utara">Sumatera Utara</option>
                        <option value="Aceh">Aceh</option>
                        <option value="Sumatera Barat">Sumatera Barat</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="filterStatus" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Semua Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Non-Aktif">Non-Aktif</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Wilayah</p>
                        <p class="text-3xl font-bold">{{ $totalWilayah ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-lg p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Provinsi</p>
                        <p class="text-3xl font-bold">{{ $totalProvinsi ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-flag text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white rounded-lg p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium">Kabupaten</p>
                        <p class="text-3xl font-bold">{{ $totalKabupaten ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-building text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-lg p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Kecamatan</p>
                        <p class="text-3xl font-bold">{{ $totalKecamatan ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-map text-xl"></i>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Wilayah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provinsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kabupaten</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kecamatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="wilayahTableBody">
                        @if(isset($wilayahData) && count($wilayahData) > 0)
                            @foreach($wilayahData as $index => $data)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->nama_wilayah ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data->provinsi ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data->kabupaten ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data->kecamatan ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $status = $data->status ?? 'N/A';
                                        $statusClass = $status === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                    @endphp
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusClass }}">{{ $status }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $data->keterangan ?? '-' }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada data wilayah tersedia
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if(isset($wilayahData) && method_exists($wilayahData, 'links'))
            <div class="mt-6">
                {{ $wilayahData->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Chart Section -->
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Visualisasi Data Wilayah</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Distribusi per Provinsi</h3>
                <canvas id="provinsiChart" width="400" height="200"></canvas>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Status Wilayah</h3>
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
    const provinsiFilter = document.getElementById('filterProvinsi');
    const statusFilter = document.getElementById('filterStatus');
    const tableBody = document.getElementById('wilayahTableBody');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedProvinsi = provinsiFilter.value;
        const selectedStatus = statusFilter.value;

        const rows = tableBody.querySelectorAll('tr');
        
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length === 0) return; // Skip header row

            const wilayah = cells[1].textContent.toLowerCase();
            const provinsi = cells[2].textContent;
            const status = cells[5].textContent;

            const matchesSearch = wilayah.includes(searchTerm);
            const matchesProvinsi = !selectedProvinsi || provinsi === selectedProvinsi;
            const matchesStatus = !selectedStatus || status.includes(selectedStatus);

            if (matchesSearch && matchesProvinsi && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterTable);
    provinsiFilter.addEventListener('change', filterTable);
    statusFilter.addEventListener('change', filterTable);

    // Charts
    // Provinsi Distribution Chart
    const provinsiCtx = document.getElementById('provinsiChart').getContext('2d');
    const provinsiChart = new Chart(provinsiCtx, {
        type: 'bar',
        data: {
            labels: ['Sumatera Utara', 'Aceh', 'Sumatera Barat'],
            datasets: [{
                label: 'Jumlah Wilayah',
                data: [45, 23, 18],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(245, 158, 11, 0.8)'
                ],
                borderColor: [
                    'rgba(59, 130, 246, 1)',
                    'rgba(34, 197, 94, 1)',
                    'rgba(245, 158, 11, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Distribusi Wilayah per Provinsi'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Wilayah'
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
            labels: ['Aktif', 'Non-Aktif'],
            datasets: [{
                data: [75, 25],
                backgroundColor: [
                    'rgb(34, 197, 94)',
                    'rgb(239, 68, 68)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Status Wilayah'
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
