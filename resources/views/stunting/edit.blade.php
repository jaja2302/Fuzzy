@extends('layouts.app')

@section('page-title', 'Edit Stunting Data')

@section('content')
<div class="p-6">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-yellow-500 to-yellow-600">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-white">Edit Stunting Data</h1>
                    <a href="{{ route('stunting.index') }}" class="inline-flex items-center px-4 py-2 bg-yellow-700 hover:bg-yellow-800 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Back
                    </a>
                </div>
            </div>
            
            <div class="p-6">
                <form action="{{ route('stunting.update', $stunting->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="wilayah_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Wilayah <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('wilayah_id') border-red-500 @enderror" 
                                    id="wilayah_id" name="wilayah_id" required>
                                <option value="">Select Wilayah</option>
                                @foreach($wilayahs as $wilayah)
                                    <option value="{{ $wilayah->id }}" 
                                            {{ old('wilayah_id', $stunting->wilayah_id) == $wilayah->id ? 'selected' : '' }}>
                                        {{ $wilayah->nama ?? $wilayah->nama_wilayah }}
                                    </option>
                                @endforeach
                            </select>
                            @error('wilayah_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">
                                Tahun <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tahun') border-red-500 @enderror" 
                                    id="tahun" name="tahun" required>
                                <option value="">Select Year</option>
                                @for($year = date('Y'); $year >= 2000; $year--)
                                    <option value="{{ $year }}" 
                                            {{ old('tahun', $stunting->tahun) == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                            @error('tahun')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="bulan" class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('bulan') border-red-500 @enderror" 
                                    id="bulan" name="bulan">
                                <option value="">Select Month (Optional)</option>
                                <option value="1" {{ old('bulan', $stunting->bulan) == '1' ? 'selected' : '' }}>January</option>
                                <option value="2" {{ old('bulan', $stunting->bulan) == '2' ? 'selected' : '' }}>February</option>
                                <option value="3" {{ old('bulan', $stunting->bulan) == '3' ? 'selected' : '' }}>March</option>
                                <option value="4" {{ old('bulan', $stunting->bulan) == '4' ? 'selected' : '' }}>April</option>
                                <option value="5" {{ old('bulan', $stunting->bulan) == '5' ? 'selected' : '' }}>May</option>
                                <option value="6" {{ old('bulan', $stunting->bulan) == '6' ? 'selected' : '' }}>June</option>
                                <option value="7" {{ old('bulan', $stunting->bulan) == '7' ? 'selected' : '' }}>July</option>
                                <option value="8" {{ old('bulan', $stunting->bulan) == '8' ? 'selected' : '' }}>August</option>
                                <option value="9" {{ old('bulan', $stunting->bulan) == '9' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ old('bulan', $stunting->bulan) == '10' ? 'selected' : '' }}>October</option>
                                <option value="11" {{ old('bulan', $stunting->bulan) == '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ old('bulan', $stunting->bulan) == '12' ? 'selected' : '' }}>December</option>
                            </select>
                            @error('bulan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="jumlah_stunting" class="block text-sm font-medium text-gray-700 mb-2">
                                Jumlah Stunting <span class="text-red-500">*</span>
                            </label>
                            <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jumlah_stunting') border-red-500 @enderror" 
                                   id="jumlah_stunting" name="jumlah_stunting" 
                                   value="{{ old('jumlah_stunting', $stunting->jumlah_stunting) }}" 
                                   min="0" step="1" required 
                                   placeholder="Enter stunting count">
                            @error('jumlah_stunting')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('stunting.index') }}" class="w-full sm:w-auto px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200 text-center">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-save mr-2"></i>Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
