@extends('layouts.admin.app')

@section('page-title', 'Dokter')
@section('page-subtitle', 'Kelola data dokter, spesialisasi, dan status aktif')

@push('styles')
<style>
    .doctor-mini {
        background: linear-gradient(135deg, rgba(15,118,110,.08), rgba(14,165,233,.08));
        border: 1px solid var(--admin-border);
        border-radius: 18px;
        padding: 16px;
    }
    .doctor-mini strong { display:block; font-size: 22px; letter-spacing:-.03em; }
    .doctor-mini span { color: var(--admin-muted); font-size: 13px; }
</style>
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="doctor-mini">
                <strong>{{ $doctors->count() }}</strong>
                <span>Total dokter terdaftar</span>
            </div>
        </div>
        <div class="col-md-4 text-md-right mt-3 mt-md-0">
            <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary px-4 py-2">
                <i class="fas fa-plus mr-1"></i> Tambah Dokter
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Daftar Dokter</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Nama</th>
                            <th>Spesialisasi</th>
                            <th>SIP</th>
                            <th>Status</th>
                            <th style="width:180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($doctors as $doctor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $doctor->name }}</strong>
                                    <div class="text-muted small">{{ $doctor->education ?: '-' }}</div>
                                </td>
                                <td>{{ $doctor->specialization ?: '-' }}</td>
                                <td>{{ $doctor->sip_number ?: '-' }}</td>
                                <td>
                                    @if ($doctor->is_active)
                                        <span class="badge badge-success px-3 py-2">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary px-3 py-2">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.dokter.edit', $doctor->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada data dokter.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

