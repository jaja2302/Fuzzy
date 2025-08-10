@extends('layouts.app')

@section('page-title', 'Create New Wilayah')

@section('content')
<div class="p-6">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-plus text-blue-600 mr-3"></i>
                Create New Wilayah
            </h1>
            <a href="{{ route('wilayah.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-blue-600">
                <h3 class="text-lg font-semibold text-white">Wilayah Information</h3>
            </div>
            
            <div class="p-6">
                <form action="{{ route('wilayah.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="nama_wilayah" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Nama Wilayah <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_wilayah') border-red-500 @enderror" 
                                   id="nama_wilayah" 
                                   name="nama_wilayah" 
                                   value="{{ old('nama_wilayah') }}" 
                                   required>
                            @error('nama_wilayah')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kode_wilayah" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-hashtag mr-2 text-blue-600"></i>Kode Wilayah <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kode_wilayah') border-red-500 @enderror" 
                                   id="kode_wilayah" 
                                   name="kode_wilayah" 
                                   value="{{ old('kode_wilayah') }}" 
                                   required>
                            @error('kode_wilayah')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2 text-blue-600"></i>Deskripsi
                        </label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('deskripsi') border-red-500 @enderror" 
                                  id="deskripsi" 
                                  name="deskripsi" 
                                  rows="3">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-map mr-2 text-blue-600"></i>Provinsi
                            </label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('provinsi') border-red-500 @enderror" 
                                   id="provinsi" 
                                   name="provinsi" 
                                   value="{{ old('provinsi') }}">
                            @error('provinsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-city mr-2 text-blue-600"></i>Kabupaten
                            </label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kabupaten') border-red-500 @enderror" 
                                   id="kabupaten" 
                                   name="kabupaten" 
                                   value="{{ old('kabupaten') }}">
                            @error('kabupaten')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-building mr-2 text-blue-600"></i>Kecamatan
                            </label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kecamatan') border-red-500 @enderror" 
                                   id="kecamatan" 
                                   name="kecamatan" 
                                   value="{{ old('kecamatan') }}">
                            @error('kecamatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="desa" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-home mr-2 text-blue-600"></i>Desa
                            </label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('desa') border-red-500 @enderror" 
                                   id="desa" 
                                   name="desa" 
                                   value="{{ old('desa') }}">
                            @error('desa')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="jumlah_penduduk" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-users mr-2 text-blue-600"></i>Jumlah Penduduk
                            </label>
                            <input type="number" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jumlah_penduduk') border-red-500 @enderror" 
                                   id="jumlah_penduduk" 
                                   name="jumlah_penduduk" 
                                   value="{{ old('jumlah_penduduk') }}" 
                                   min="0">
                            @error('jumlah_penduduk')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="luas_wilayah" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-ruler-combined mr-2 text-blue-600"></i>Luas Wilayah
                            </label>
                            <div class="flex">
                                <input type="number" 
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('luas_wilayah') border-red-500 @enderror" 
                                       id="luas_wilayah" 
                                       name="luas_wilayah" 
                                       value="{{ old('luas_wilayah') }}" 
                                       min="0" 
                                       step="0.01">
                                <select class="px-3 py-2 border border-l-0 border-gray-300 rounded-r-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50" name="satuan_luas">
                                    <option value="km2" {{ old('satuan_luas') == 'km2' ? 'selected' : '' }}>km²</option>
                                    <option value="ha" {{ old('satuan_luas') == 'ha' ? 'selected' : '' }}>Hektar</option>
                                    <option value="m2" {{ old('satuan_luas') == 'm2' ? 'selected' : '' }}>m²</option>
                                </select>
                            </div>
                            @error('luas_wilayah')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="flex items-center">
                            <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                   type="checkbox" 
                                   id="status_aktif" 
                                   name="status_aktif" 
                                   value="1" 
                                   {{ old('status_aktif', true) ? 'checked' : '' }}>
                            <label class="ml-2 block text-sm font-medium text-gray-700" for="status_aktif">
                                <i class="fas fa-check-circle mr-2 text-blue-600"></i>Status Aktif
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>Save Wilayah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
