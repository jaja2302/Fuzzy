@extends('layouts.app')

@section('page-title', 'Stunting Data Detail')

@section('content')
<div class="p-6">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-blue-600">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-white">Stunting Data Detail</h1>
                    <div class="flex space-x-2">
                        <a href="{{ route('stunting.edit', $stunting->id_stunting) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        <a href="{{ route('stunting.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Back
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- ID -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">ID</label>
                        <p class="text-lg font-mono text-gray-900">{{ $stunting->id_stunting }}</p>
                    </div>
                    
                    <!-- Wilayah -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Wilayah</label>
                        <p class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $stunting->wilayah->nama_wilayah ?? 'N/A' }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Tahun -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun</label>
                        <p class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            {{ $stunting->tahun }}
                        </p>
                    </div>
                    
                    <!-- Jumlah Stunting -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Stunting</label>
                        <p class="text-2xl font-bold text-red-600">{{ number_format($stunting->jumlah_stunting) }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Created At -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Created At</label>
                        <p class="text-gray-900">{{ $stunting->created_at->format('d F Y H:i:s') }}</p>
                    </div>
                    
                    <!-- Updated At -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Last Updated</label>
                        <p class="text-gray-900">{{ $stunting->updated_at->format('d F Y H:i:s') }}</p>
                    </div>
                </div>

                <hr class="my-8">

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                    <form action="{{ route('stunting.destroy', $stunting->id_stunting) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200" onclick="return confirm('Are you sure you want to delete this record?')">
                            <i class="fas fa-trash mr-2"></i>Delete
                        </button>
                    </form>
                    <a href="{{ route('stunting.index') }}" class="w-full sm:w-auto px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200 text-center">
                        <i class="fas fa-list mr-2"></i>View All Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
