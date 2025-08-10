@extends('layouts.app')

@section('page-title', 'Data Wilayah')

@section('content')
<div class="p-6">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-map-marker-alt text-purple-600 mr-3"></i>
                    Data Wilayah
                </h1>
                <p class="text-gray-600 mt-2">Kelola data wilayah untuk analisis stunting</p>
            </div>
            <a href="{{ route('wilayah.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-lg hover:shadow-xl">
                <i class="fas fa-plus mr-2"></i>
                Tambah Wilayah
            </a>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
            <i class="fas fa-check-circle mr-2 text-green-600"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center">
            <i class="fas fa-exclamation-circle mr-2 text-red-600"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Data Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Wilayah</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Wilayah
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Provinsi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($wilayahs as $index => $wilayah)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $wilayah->nama_wilayah }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $wilayah->provinsi }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('wilayah.show', $wilayah->id) }}" 
                                       class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                        <i class="fas fa-eye text-lg"></i>
                                    </a>
                                    <a href="{{ route('wilayah.edit', $wilayah->id) }}" 
                                       class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200">
                                        <i class="fas fa-edit text-lg"></i>
                                    </a>
                                    <form action="{{ route('wilayah.destroy', $wilayah->id) }}" method="POST" 
                                          class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus wilayah ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 transition-colors duration-200">
                                            <i class="fas fa-trash text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-inbox text-4xl mb-4 text-gray-300"></i>
                                    <p class="text-lg font-medium">Belum ada data wilayah</p>
                                    <p class="text-sm">Mulai dengan menambahkan wilayah pertama</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($wilayahs->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan {{ $wilayahs->firstItem() ?? 0 }} - {{ $wilayahs->lastItem() ?? 0 }} 
                        dari {{ $wilayahs->total() }} hasil
                    </div>
                    <div class="flex items-center space-x-2">
                        {{ $wilayahs->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
