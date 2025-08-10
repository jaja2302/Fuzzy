@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Tambah Data Stunting</h4>
                    <a href="{{ route('stunting.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('stunting.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="wilayah_id" class="form-label">Wilayah <span class="text-danger">*</span></label>
                                    <select class="form-select @error('wilayah_id') is-invalid @enderror" 
                                            id="wilayah_id" name="wilayah_id" required>
                                        <option value="">Pilih Wilayah</option>
                                        @foreach($wilayahs as $wilayah)
                                            <option value="{{ $wilayah->ID_Wilayah }}" 
                                                    {{ old('wilayah_id') == $wilayah->ID_Wilayah ? 'selected' : '' }}>
                                                {{ $wilayah->nama_wilayah }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('wilayah_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Tahun <span class="text-danger">*</span></label>
                                    <select class="form-select @error('tahun') is-invalid @enderror" 
                                            id="tahun" name="tahun" required>
                                        <option value="">Pilih Tahun</option>
                                        @for($year = date('Y'); $year >= 2000; $year--)
                                            <option value="{{ $year }}" 
                                                    {{ old('tahun') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('tahun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="bulan" class="form-label">Bulan</label>
                                    <select class="form-select @error('bulan') is-invalid @enderror" 
                                            id="bulan" name="bulan">
                                        <option value="">Pilih Bulan (Opsional)</option>
                                        <option value="1" {{ old('bulan') == '1' ? 'selected' : '' }}>Januari</option>
                                        <option value="2" {{ old('bulan') == '2' ? 'selected' : '' }}>Februari</option>
                                        <option value="3" {{ old('bulan') == '3' ? 'selected' : '' }}>Maret</option>
                                        <option value="4" {{ old('bulan') == '4' ? 'selected' : '' }}>April</option>
                                        <option value="5" {{ old('bulan') == '5' ? 'selected' : '' }}>Mei</option>
                                        <option value="6" {{ old('bulan') == '6' ? 'selected' : '' }}>Juni</option>
                                        <option value="7" {{ old('bulan') == '7' ? 'selected' : '' }}>Juli</option>
                                        <option value="8" {{ old('bulan') == '8' ? 'selected' : '' }}>Agustus</option>
                                        <option value="9" {{ old('bulan') == '9' ? 'selected' : '' }}>September</option>
                                        <option value="10" {{ old('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
                                        <option value="11" {{ old('bulan') == '11' ? 'selected' : '' }}>November</option>
                                        <option value="12" {{ old('bulan') == '12' ? 'selected' : '' }}>Desember</option>
                                    </select>
                                    @error('bulan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jumlah_stunting" class="form-label">Jumlah Stunting <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('jumlah_stunting') is-invalid @enderror" 
                                           id="jumlah_stunting" name="jumlah_stunting" 
                                           value="{{ old('jumlah_stunting') }}" 
                                           min="0" step="1" required 
                                           placeholder="Masukkan jumlah stunting">
                                    @error('jumlah_stunting')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
