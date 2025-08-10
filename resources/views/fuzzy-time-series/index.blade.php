@extends('layouts.app')

@section('title', 'Fuzzy Time Series - Perkiraan Dinamis')

@section('content')
<div class="p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Main Form Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-blue-600">
                <h3 class="text-xl font-bold text-white">
                    <i class="fas fa-chart-line mr-3"></i>
                    FUZZY TIME SERIES - PERKIRAAN DINAMIS
                </h3>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('fuzzy-time-series.calculate') }}" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="wilayah_id" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Pilih Wilayah:
                            </label>
                            <select name="wilayah_id" id="wilayah_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Semua Wilayah</option>
                                @foreach($wilayahs as $wilayah)
                                    <option value="{{ $wilayah->ID_Wilayah }}" 
                                        {{ old('wilayah_id') == $wilayah->ID_Wilayah ? 'selected' : '' }}>
                                        {{ $wilayah->nama_wilayah }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="tahun_awal" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar mr-2 text-blue-600"></i>Tahun Awal:
                            </label>
                            <input type="number" name="tahun_awal" id="tahun_awal" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   min="2000" max="2030" 
                                   value="{{ old('tahun_awal', 2020) }}" placeholder="2020">
                        </div>
                        
                        <div>
                            <label for="tahun_akhir" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar mr-2 text-blue-600"></i>Tahun Akhir:
                            </label>
                            <input type="number" name="tahun_akhir" id="tahun_akhir" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   min="2000" max="2030" 
                                   value="{{ old('tahun_akhir', 2024) }}" placeholder="2024">
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-lg transition-colors duration-200">
                            <i class="fas fa-calculator mr-2"></i>
                            HITUNG FUZZY TIME SERIES
                        </button>
                        
                        <a href="{{ route('fuzzy-time-series.data') }}" class="inline-flex items-center justify-center px-6 py-3 bg-cyan-600 hover:bg-cyan-700 text-white font-medium rounded-lg text-lg transition-colors duration-200">
                            <i class="fas fa-database mr-2"></i>
                            LIHAT DATA MENTAH
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Informasi Metode -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-cyan-500 to-cyan-600">
                <h4 class="text-lg font-bold text-white">
                    <i class="fas fa-info-circle mr-3"></i>
                    Informasi Metode Fuzzy Time Series
                </h4>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h5 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-list-ol mr-2 text-cyan-600"></i>
                            Langkah-langkah Perhitungan:
                        </h5>
                        <ol class="space-y-2 text-gray-700">
                            <li class="flex items-start">
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-cyan-100 text-cyan-800 text-sm font-medium rounded-full mr-3 mt-0.5">1</span>
                                <span><strong>Penentuan Universe of Discourse (UoD):</strong> Membagi data menjadi 7 interval fuzzy</span>
                            </li>
                            <li class="flex items-start">
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-cyan-100 text-cyan-800 text-sm font-medium rounded-full mr-3 mt-0.5">2</span>
                                <span><strong>Fuzzifikasi:</strong> Mengelompokkan data ke dalam fuzzy sets</span>
                            </li>
                            <li class="flex items-start">
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-cyan-100 text-cyan-800 text-sm font-medium rounded-full mr-3 mt-0.5">3</span>
                                <span><strong>Fuzzy Logic Groups:</strong> Membuat relasi antar fuzzy sets</span>
                            </li>
                            <li class="flex items-start">
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-cyan-100 text-cyan-800 text-sm font-medium rounded-full mr-3 mt-0.5">4</span>
                                <span><strong>Fuzzy Relationships Matrix:</strong> Matriks frekuensi relasi</span>
                            </li>
                            <li class="flex items-start">
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-cyan-100 text-cyan-800 text-sm font-medium rounded-full mr-3 mt-0.5">5</span>
                                <span><strong>Defuzzifikasi:</strong> Prediksi nilai berdasarkan relasi</span>
                            </li>
                        </ol>
                    </div>
                    <div>
                        <h5 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-star mr-2 text-cyan-600"></i>
                            Keunggulan Metode:
                        </h5>
                        <ul class="space-y-2 text-gray-700">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                                <span>Dapat menangani data yang tidak pasti</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                                <span>Prediksi berdasarkan pola historis</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                                <span>Akurasi yang lebih baik untuk data time series</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                                <span>Dapat diterapkan pada berbagai jenis data</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
