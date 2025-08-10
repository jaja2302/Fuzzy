@extends('layouts.app')

@section('title', 'Data Stunting - Fuzzy Time Series')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">
                        <i class="fas fa-database"></i>
                        DATA STUNTING UNTUK FUZZY TIME SERIES
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <a href="{{ route('fuzzy-time-series.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Form
                            </a>
                        </div>
                    </div>

                    @if($stuntings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Wilayah</th>
                                        <th>Tahun</th>
                                        <th>Bulan</th>
                                        <th>Jumlah Stunting</th>
                                        <th>Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stuntings as $index => $stunting)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $stunting->wilayah->Provinsi }}</strong><br>
                                                <small class="text-muted">{{ $stunting->wilayah->Kabupaten }}</small>
                                            </td>
                                            <td>{{ $stunting->tahun }}</td>
                                            <td>{{ $stunting->bulan ?? '-' }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-warning text-dark">
                                                    {{ number_format($stunting->jumlah) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-info">
                                                    {{ number_format($stunting->persentase, 2) }}%
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="info-box bg-success">
                                    <span class="info-box-icon"><i class="fas fa-chart-bar"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Data</span>
                                        <span class="info-box-number">{{ $stuntings->count() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box bg-warning">
                                    <span class="info-box-icon"><i class="fas fa-map-marker-alt"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Wilayah</span>
                                        <span class="info-box-number">{{ $stuntings->unique('id_wilayah')->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <h5><i class="fas fa-info-circle"></i> Informasi:</h5>
                                    <ul class="mb-0">
                                        <li>Data ini akan digunakan untuk perhitungan Fuzzy Time Series</li>
                                        <li>Pastikan data sudah lengkap dan akurat sebelum melakukan perhitungan</li>
                                        <li>Untuk hasil yang optimal, gunakan data minimal 10 periode</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-database fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Data Stunting Belum Tersedia</h4>
                            <p class="text-muted">Silakan tambahkan data stunting terlebih dahulu untuk melakukan perhitungan Fuzzy Time Series.</p>
                            <a href="{{ route('stunting.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data Stunting
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
