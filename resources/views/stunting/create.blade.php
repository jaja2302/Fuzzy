@extends('layouts.app')

@section('page-title', 'Create Stunting Data')

@section('content')
<div class="p-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Create New Stunting Data</h1>
            <a href="{{ route('stunting.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Stunting Data Form</h3>
            </div>

            <form action="{{ route('stunting.store') }}" method="POST" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Wilayah Selection -->
                    <div>
                        <label for="id_wilayah" class="block text-sm font-medium text-gray-700 mb-2">Wilayah *</label>
                        <select name="id_wilayah" id="id_wilayah" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('id_wilayah') border-red-500 @enderror">
                            <option value="">Select Wilayah</option>
                            @foreach($wilayahs as $wilayah)
                            <option value="{{ $wilayah->ID_Wilayah }}" {{ old('id_wilayah') == $wilayah->ID_Wilayah ? 'selected' : '' }}>
                                {{ $wilayah->Provinsi }} - {{ $wilayah->Kabupaten }}
                                @if($wilayah->nama_wilayah && $wilayah->nama_wilayah != $wilayah->Provinsi . ' - ' . $wilayah->Kabupaten)
                                ({{ $wilayah->nama_wilayah }})
                                @endif
                            </option>
                            @endforeach
                        </select>
                        @error('id_wilayah')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Total wilayah tersedia: {{ $wilayahs->count() }}</p>
                    </div>

                    <!-- Tahun -->
                    <div>
                        <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">Tahun *</label>
                        <input type="number" name="tahun" id="tahun" value="{{ old('tahun') }}" min="2000" max="{{ date('Y') + 1 }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tahun') border-red-500 @enderror">
                        @error('tahun')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Stunting -->
                    <div>
                        <label for="jumlah_stunting" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Stunting *</label>
                        <input type="number" name="jumlah_stunting" id="jumlah_stunting" value="{{ old('jumlah_stunting') }}" min="0" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('jumlah_stunting') border-red-500 @enderror">
                        @error('jumlah_stunting')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-3 mt-8">
                    <a href="{{ route('stunting.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>Save Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection