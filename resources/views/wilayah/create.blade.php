<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wilayah - Fuzzy</title>
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
        .form-control-custom {
            border-radius: 0.375rem;
        }
        .form-control-custom:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">
                        <i class="fas fa-plus text-primary me-2"></i>
                        Tambah Wilayah Baru
                    </h2>
                    <a href="{{ route('wilayah.index') }}" class="btn btn-outline-secondary btn-custom">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>

                <div class="card card-custom">
                    <div class="card-body">
                        <form action="{{ route('wilayah.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_wilayah" class="form-label fw-bold">
                                        <i class="fas fa-map-marker-alt me-2"></i>Nama Wilayah <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-custom @error('nama_wilayah') is-invalid @enderror" 
                                           id="nama_wilayah" 
                                           name="nama_wilayah" 
                                           value="{{ old('nama_wilayah') }}" 
                                           required>
                                    @error('nama_wilayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="kode_wilayah" class="form-label fw-bold">
                                        <i class="fas fa-hashtag me-2"></i>Kode Wilayah <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-custom @error('kode_wilayah') is-invalid @enderror" 
                                           id="kode_wilayah" 
                                           name="kode_wilayah" 
                                           value="{{ old('kode_wilayah') }}" 
                                           required>
                                    @error('kode_wilayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-2"></i>Deskripsi
                                </label>
                                <textarea class="form-control form-control-custom @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" 
                                          name="deskripsi" 
                                          rows="3">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="provinsi" class="form-label fw-bold">
                                        <i class="fas fa-map me-2"></i>Provinsi
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-custom @error('provinsi') is-invalid @enderror" 
                                           id="provinsi" 
                                           name="provinsi" 
                                           value="{{ old('provinsi') }}">
                                    @error('provinsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="kabupaten" class="form-label fw-bold">
                                        <i class="fas fa-city me-2"></i>Kabupaten
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-custom @error('kabupaten') is-invalid @enderror" 
                                           id="kabupaten" 
                                           name="kabupaten" 
                                           value="{{ old('kabupaten') }}">
                                    @error('kabupaten')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="kecamatan" class="form-label fw-bold">
                                        <i class="fas fa-building me-2"></i>Kecamatan
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-custom @error('kecamatan') is-invalid @enderror" 
                                           id="kecamatan" 
                                           name="kecamatan" 
                                           value="{{ old('kecamatan') }}">
                                    @error('kecamatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="desa" class="form-label fw-bold">
                                        <i class="fas fa-home me-2"></i>Desa
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-custom @error('desa') is-invalid @enderror" 
                                           id="desa" 
                                           name="desa" 
                                           value="{{ old('desa') }}">
                                    @error('desa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="jumlah_penduduk" class="form-label fw-bold">
                                        <i class="fas fa-users me-2"></i>Jumlah Penduduk
                                    </label>
                                    <input type="number" 
                                           class="form-control form-control-custom @error('jumlah_penduduk') is-invalid @enderror" 
                                           id="jumlah_penduduk" 
                                           name="jumlah_penduduk" 
                                           value="{{ old('jumlah_penduduk') }}" 
                                           min="0">
                                    @error('jumlah_penduduk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="luas_wilayah" class="form-label fw-bold">
                                        <i class="fas fa-ruler-combined me-2"></i>Luas Wilayah
                                    </label>
                                    <div class="input-group">
                                        <input type="number" 
                                               class="form-control form-control-custom @error('luas_wilayah') is-invalid @enderror" 
                                               id="luas_wilayah" 
                                               name="luas_wilayah" 
                                               value="{{ old('luas_wilayah') }}" 
                                               min="0" 
                                               step="0.01">
                                        <select class="form-select form-control-custom" name="satuan_luas">
                                            <option value="km2" {{ old('satuan_luas') == 'km2' ? 'selected' : '' }}>km²</option>
                                            <option value="ha" {{ old('satuan_luas') == 'ha' ? 'selected' : '' }}>Hektar</option>
                                            <option value="m2" {{ old('satuan_luas') == 'm2' ? 'selected' : '' }}>m²</option>
                                        </select>
                                    </div>
                                    @error('luas_wilayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="status_aktif" 
                                           name="status_aktif" 
                                           value="1" 
                                           {{ old('status_aktif', true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="status_aktif">
                                        <i class="fas fa-check-circle me-2"></i>Status Aktif
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary btn-custom">
                                    <i class="fas fa-save me-2"></i>Simpan Wilayah
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
