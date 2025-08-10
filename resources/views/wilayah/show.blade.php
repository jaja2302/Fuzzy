@extends('layouts.app')

@section('page-title', 'Detail Wilayah')

@section('content')
<div class="p-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-map-marker-alt text-blue-600 mr-3"></i>
                Detail Wilayah: {{ $wilayah->nama_wilayah ?: $wilayah->Provinsi . ' - ' . $wilayah->Kabupaten }}
            </h1>
            <div class="flex space-x-3">
                <a href="{{ route('wilayah.edit', $wilayah) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('wilayah.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-blue-600">
                <h3 class="text-lg font-semibold text-white">Wilayah Information</h3>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-hashtag mr-2 text-blue-600"></i>ID Wilayah
                        </label>
                        <div class="text-lg font-semibold text-gray-900">{{ $wilayah->ID_Wilayah }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-check-circle mr-2 text-blue-600"></i>Status
                        </label>
                        <div>
                            @if($wilayah->status_aktif)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-2"></i>Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-2"></i>Inactive
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-map mr-2 text-blue-600"></i>Provinsi
                        </label>
                        <div class="text-lg text-gray-900">{{ $wilayah->Provinsi }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-city mr-2 text-blue-600"></i>Kabupaten
                        </label>
                        <div class="text-lg text-gray-900">{{ $wilayah->Kabupaten }}</div>
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Nama Wilayah
                    </label>
                    <div class="text-lg text-gray-900">
                        {{ $wilayah->nama_wilayah ?: $wilayah->Provinsi . ' - ' . $wilayah->Kabupaten }}
                    </div>
                    @if(!$wilayah->nama_wilayah)
                        <p class="mt-1 text-sm text-gray-500">Nama wilayah otomatis menggunakan format "Provinsi - Kabupaten"</p>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-clock mr-2 text-blue-600"></i>Created At
                        </label>
                        <div class="text-gray-900">{{ $wilayah->created_at->format('d F Y H:i:s') }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-edit mr-2 text-blue-600"></i>Updated At
                        </label>
                        <div class="text-gray-900">{{ $wilayah->updated_at->format('d F Y H:i:s') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Stunting Data Section -->
        @if(isset($stuntings) && $stuntings->count() > 0)
        <div class="mt-8 bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-500 to-green-600">
                <h3 class="text-lg font-semibold text-white">Related Stunting Data</h3>
            </div>
            
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Kasus</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Penduduk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persentase</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($stuntings as $stunting)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stunting->tahun }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stunting->jumlah_kasus }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stunting->total_penduduk }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($stunting->persentase, 2) }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($stuntings->hasPages())
                <div class="mt-4">
                    {{ $stuntings->links() }}
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
