@extends('layouts.app')

@section('page-title', 'Stunting Data')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Stunting Data</h1>
        <a href="{{ route('stunting.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i>Add New Data
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        {{ session('error') }}
    </div>
    @endif

    <!-- Filter Form -->
    <div class="mb-6 bg-white shadow-lg rounded-lg p-6">
        <form method="GET" action="{{ route('stunting.index') }}" class="space-y-4">
            <!-- Search Field -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-search mr-2 text-blue-600"></i>Cari Data Stunting
                    </label>
                    <input type="text"
                        id="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari berdasarkan nama wilayah..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-2 items-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                    @if(request('search') || request('id_wilayah') || request('tahun'))
                    <a href="{{ route('stunting.index') }}" class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg transition-colors duration-200 flex items-center">
                        <i class="fas fa-times mr-2"></i>Reset
                    </a>
                    @endif
                </div>
            </div>

            <!-- Advanced Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-gray-200">
                <!-- Wilayah Filter -->
                <div>
                    <label for="id_wilayah" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-map mr-2 text-blue-600"></i>Filter Wilayah
                    </label>
                    <select name="id_wilayah" id="id_wilayah" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option value="">Semua Wilayah</option>
                        @foreach($wilayahs as $wilayah)
                        <option value="{{ $wilayah->ID_Wilayah }}" {{ request('id_wilayah') == $wilayah->ID_Wilayah ? 'selected' : '' }}>
                            {{ $wilayah->Provinsi }} - {{ $wilayah->Kabupaten }}
                            @if($wilayah->nama_wilayah && $wilayah->nama_wilayah != $wilayah->Provinsi . ' - ' . $wilayah->Kabupaten)
                            ({{ $wilayah->nama_wilayah }})
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tahun Filter -->
                <div>
                    <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-calendar mr-2 text-blue-600"></i>Filter Tahun
                    </label>
                    <select name="tahun" id="tahun" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option value="">Semua Tahun</option>
                        @php
                        $currentYear = date('Y');
                        $startYear = 2000;
                        @endphp
                        @for($year = $currentYear; $year >= $startYear; $year--)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                        @endfor
                    </select>
                </div>
            </div>
        </form>

        <!-- Filter Summary -->
        @if(request('search') || request('id_wilayah') || request('tahun'))
        <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex items-center text-sm text-blue-800">
                <i class="fas fa-filter mr-2"></i>
                <span class="font-medium">Filter Aktif:</span>
                @if(request('search'))
                <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                    Pencarian: "{{ request('search') }}"
                </span>
                @endif
                @if(request('id_wilayah'))
                @php
                $selectedWilayah = $wilayahs->firstWhere('ID_Wilayah', request('id_wilayah'));
                @endphp
                @if($selectedWilayah)
                <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                    Wilayah: {{ $selectedWilayah->Provinsi }} - {{ $selectedWilayah->Kabupaten }}
                </span>
                @endif
                @endif
                @if(request('tahun'))
                <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                    Tahun: {{ request('tahun') }}
                </span>
                @endif
            </div>
        </div>
        @endif
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Stunting Records</h3>
                @if(request('search') || request('id_wilayah') || request('tahun'))
                <div class="text-sm text-gray-600">
                    <i class="fas fa-filter mr-2 text-blue-600"></i>
                    Hasil filter: <span class="font-medium">{{ $stuntings->total() }} data</span>
                </div>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wilayah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Stunting</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($stuntings as $stunting)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $stunting->id_stunting }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stunting->wilayah->nama_wilayah ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stunting->tahun }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stunting->jumlah_stunting }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('stunting.show', $stunting->id_stunting) }}" class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('stunting.edit', $stunting->id_stunting) }}" class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('stunting.destroy', $stunting->id_stunting) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this record?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No stunting data found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($stuntings->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $stuntings->links() }}
        </div>
        @endif
    </div>
</div>
@endsection