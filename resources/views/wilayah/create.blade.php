@extends('layouts.app')

@section('page-title', 'Create New Wilayah')

@section('content')
<div class="p-6">
    <div class="max-w-4xl mx-auto">
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
                            <label for="Provinsi" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-map mr-2 text-blue-600"></i>Provinsi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('Provinsi') border-red-500 @enderror" 
                                   id="Provinsi" 
                                   name="Provinsi" 
                                   value="{{ old('Provinsi') }}" 
                                   required>
                            @error('Provinsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="Kabupaten" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-city mr-2 text-blue-600"></i>Kabupaten <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('Kabupaten') border-red-500 @enderror" 
                                   id="Kabupaten" 
                                   name="Kabupaten" 
                                   value="{{ old('Kabupaten') }}" 
                                   required>
                            @error('Kabupaten')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="nama_wilayah" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Nama Wilayah
                        </label>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_wilayah') border-red-500 @enderror" 
                               id="nama_wilayah" 
                               name="nama_wilayah" 
                               value="{{ old('nama_wilayah') }}" 
                               placeholder="Kosongkan untuk menggunakan format: Provinsi - Kabupaten">
                        @error('nama_wilayah')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Jika dikosongkan, akan otomatis menggunakan format "Provinsi - Kabupaten"</p>
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
