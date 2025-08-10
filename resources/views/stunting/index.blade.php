@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Data Stunting</h4>
                    <a href="{{ route('stunting.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="id_wilayah" class="form-label">Wilayah</label>
                            <select class="form-select" id="id_wilayah" name="id_wilayah">
                                <option value="">Semua Wilayah</option>
                                @foreach($wilayahs as $wilayah)
                                    <option value="{{ $wilayah->ID_Wilayah }}" {{ request('id_wilayah') == $wilayah->ID_Wilayah ? 'selected' : '' }}>
                                        {{ $wilayah->Kabupaten }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select class="form-select" id="tahun" name="tahun">
                                <option value="">Semua Tahun</option>
                                @for($year = date('Y'); $year >= 2000; $year--)
                                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <button type="button" class="btn btn-secondary d-block" onclick="applyFilter()">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <a href="{{ route('stunting.index') }}" class="btn btn-outline-secondary d-block">
                                <i class="fas fa-times"></i> Reset
                            </a>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Wilayah</th>
                                    <th>Tahun</th>
                                    <th>Jumlah Stunting</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stuntings as $index => $stunting)
                                <tr>
                                    <td>{{ $stuntings->firstItem() + $index }}</td>
                                    <td>{{ $stunting->wilayah->Kabupaten }}</td>
                                    <td>{{ $stunting->tahun }}</td>
                                    <td>
                                        <span class="badge bg-danger">{{ number_format($stunting->jumlah_stunting) }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('stunting.show', $stunting->id_stunting) }}" 
                                               class="btn btn-sm btn-info" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('stunting.edit', $stunting->id_stunting) }}" 
                                               class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('stunting.destroy', $stunting->id_stunting) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <p>Tidak ada data stunting yang ditemukan.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $stuntings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function applyFilter() {
    const wilayahId = document.getElementById('id_wilayah').value;
    const tahun = document.getElementById('tahun').value;
    
    let url = '{{ route("stunting.index") }}?';
    const params = new URLSearchParams();
    
    if (wilayahId) params.append('id_wilayah', wilayahId);
    if (tahun) params.append('tahun', tahun);
    
    window.location.href = url + params.toString();
}
</script>
@endsection
