@extends('layouts.app')

@section('title', 'Data Stunting - Fuzzy Time Series')

@section('content')
<div class="p-6">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-cyan-500 to-cyan-600">
                <h3 class="text-xl font-bold text-white">
                    <i class="fas fa-database mr-3"></i>
                    DATA STUNTING UNTUK FUZZY TIME SERIES
                </h3>
            </div>
            <div class="p-6">
                <div class="mb-6">
                    <a href="{{ route('fuzzy-time-series.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Form
                    </a>
                </div>

                @if($stuntings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Wilayah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tahun</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Bulan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Jumlah Stunting</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Persentase</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($stuntings as $index => $stunting)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $stunting->wilayah->Provinsi }}</div>
                                            <div class="text-sm text-gray-500">{{ $stunting->wilayah->Kabupaten }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stunting->tahun }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stunting->bulan ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                {{ number_format($stunting->jumlah) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ number_format($stunting->persentase, 2) }}%
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div class="bg-green-100 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-chart-bar text-green-600 text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-green-800">Total Data</div>
                                    <div class="text-2xl font-bold text-green-900">{{ $stuntings->count() }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-yellow-100 border border-yellow-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-yellow-600 text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-yellow-800">Total Wilayah</div>
                                    <div class="text-2xl font-bold text-yellow-900">{{ $stuntings->unique('id_wilayah')->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h5 class="text-lg font-medium text-blue-800 mb-3 flex items-center">
                                <i class="fas fa-info-circle mr-2 text-blue-600"></i> Informasi:
                            </h5>
                            <ul class="text-blue-700 space-y-1">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                    <span>Data ini akan digunakan untuk perhitungan Fuzzy Time Series</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                    <span>Pastikan data sudah lengkap dan akurat sebelum melakukan perhitungan</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                    <span>Untuk hasil yang optimal, gunakan data minimal 10 periode</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-database text-6xl text-gray-400 mb-4"></i>
                        <h4 class="text-xl font-medium text-gray-600 mb-2">Data Stunting Belum Tersedia</h4>
                        <p class="text-gray-500 mb-6">Silakan tambahkan data stunting terlebih dahulu untuk melakukan perhitungan Fuzzy Time Series.</p>
                        <a href="{{ route('stunting.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Stunting
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
