@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detail Data Stunting</h4>
                    <div>
                        <a href="{{ route('stunting.edit', $stunting->id) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('stunting.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">ID</label>
                                <p class="form-control-plaintext">{{ $stunting->id }}</p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Wilayah</label>
                                <p class="form-control-plaintext">
                                    <span class="badge bg-primary">{{ $stunting->wilayah->nama_wilayah }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tahun</label>
                                <p class="form-control-plaintext">
                                    <span class="badge bg-info">{{ $stunting->tahun }}</span>
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Bulan</label>
                                <p class="form-control-plaintext">
                                    @if($stunting->bulan)
                                        <span class="badge bg-secondary">
                                            {{ date('F', mktime(0, 0, 0, $stunting->bulan, 1)) }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Jumlah Stunting</label>
                                <p class="form-control-plaintext">
                                    <span class="badge bg-danger fs-5">{{ number_format($stunting->jumlah_stunting) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Dibuat Pada</label>
                                <p class="form-control-plaintext">
                                    {{ $stunting->created_at->format('d F Y H:i:s') }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Terakhir Diupdate</label>
                                <p class="form-control-plaintext">
                                    {{ $stunting->updated_at->format('d F Y H:i:s') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <form action="{{ route('stunting.destroy', $stunting->id) }}" 
                              method="POST" class="d-inline" 
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger me-md-2">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                        <a href="{{ route('stunting.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list"></i> Daftar Semua
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
