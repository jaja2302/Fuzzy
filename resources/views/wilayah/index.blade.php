<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Wilayah - Fuzzy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .card-custom {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.5rem;
        }
        .btn-custom {
            border-radius: 0.375rem;
            font-weight: 500;
        }
        .table th {
            background-color: #f8f9fa;
            border-top: none;
        }
        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">
                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                        Data Wilayah
                    </h2>
                    <a href="{{ route('wilayah.create') }}" class="btn btn-primary btn-custom">
                        <i class="fas fa-plus me-2"></i>Tambah Wilayah
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card card-custom">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Wilayah</th>
                                        <th>Provinsi</th>
                                        <th>Kabupaten</th>
                                        <th>Kecamatan</th>
                                        <th>Jumlah Penduduk</th>
                                        <th>Luas</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($wilayahs as $index => $wilayah)
                                        <tr>
                                            <td>{{ $index + 1 + ($wilayahs->currentPage() - 1) * $wilayahs->perPage() }}</td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $wilayah->kode_wilayah }}</span>
                                            </td>
                                            <td>
                                                <strong>{{ $wilayah->nama_wilayah }}</strong>
                                                @if($wilayah->deskripsi)
                                                    <br><small class="text-muted">{{ Str::limit($wilayah->deskripsi, 50) }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $wilayah->provinsi ?? '-' }}</td>
                                            <td>{{ $wilayah->kabupaten ?? '-' }}</td>
                                            <td>{{ $wilayah->kecamatan ?? '-' }}</td>
                                            <td>
                                                @if($wilayah->jumlah_penduduk)
                                                    {{ number_format($wilayah->jumlah_penduduk) }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if($wilayah->luas_wilayah)
                                                    {{ $wilayah->luas_wilayah }} {{ $wilayah->satuan_luas }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if($wilayah->status_aktif)
                                                    <span class="badge bg-success status-badge">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger status-badge">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('wilayah.show', $wilayah) }}" 
                                                       class="btn btn-sm btn-outline-info" 
                                                       title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('wilayah.edit', $wilayah) }}" 
                                                       class="btn btn-sm btn-outline-warning" 
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('wilayah.destroy', $wilayah) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus wilayah ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-outline-danger" 
                                                                title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                                    <p>Tidak ada data wilayah</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($wilayahs->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $wilayahs->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
