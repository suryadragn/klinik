@extends('layouts.admin.app')

@section('page-title', 'Dokter')
@section('page-subtitle', 'Data dokter')

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
                <span>Total data dokter</span>
            </div>
        </div>
        <div class="col-md-4 text-md-right mt-3 mt-md-0">
            <button type="button" class="btn btn-primary px-4 py-2 open-doctor-modal" data-url="{{ route('admin.dokter.create') }}">
                <i class="fas fa-plus mr-1"></i> Tambah Dokter
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Daftar Dokter</h3>
        </div>
        <div class="card-body p-0">
            @if ($doctors->isEmpty())
                <div class="px-4 py-4 text-center text-muted border-bottom">
                    Belum ada data dokter.
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="doctorTable">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Spesialis</th>
                            <th>Status</th>
                            <th style="width:180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $doctor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $doctor->kd_dokter }}</strong></td>
                                <td>
                                    <strong>{{ $doctor->nm_dokter }}</strong>
                                    <div class="text-muted small">{{ $doctor->alumni ?: '-' }}</div>
                                </td>
                                <td>{{ $doctor->jk ?: '-' }}</td>
                                <td>{{ $doctor->tmp_lahir ?: '-' }}</td>
                                <td>{{ $doctor->tgl_lahir ? \Carbon\Carbon::parse($doctor->tgl_lahir)->format('d-m-Y') : '-' }}</td>
                                <td>{{ $doctor->kd_sps ?: '-' }}</td>
                                <td>
                                    @if ($doctor->status)
                                        <span class="badge badge-success px-3 py-2">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary px-3 py-2">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary open-doctor-modal" data-url="{{ route('admin.dokter.edit', $doctor->id) }}">Edit</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger delete-doctor" data-url="{{ route('admin.dokter.destroy', $doctor->id) }}">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="doctorModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Form Dokter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="doctorModalBody">Memuat form...</div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function doctorTableOptions() {
        return {
            pageLength: 10,
            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                paginate: {
                    previous: 'Sebelumnya',
                    next: 'Berikutnya'
                },
                zeroRecords: 'Data tidak ditemukan'
            }
        };
    }

    function initDoctorTable() {
        if ($.fn.dataTable.isDataTable('#doctorTable')) {
            $('#doctorTable').DataTable().destroy();
        }

        $('#doctorTable').DataTable(doctorTableOptions());
    }

    function refreshDoctorTable(callback) {
        $.ajax({
            url: window.location.href,
            type: 'GET',
            dataType: 'html',
            success: function (html) {
                var $html = $('<div>').html(html);
                var newBody = $html.find('#doctorTable tbody').html();

                if ($.fn.dataTable.isDataTable('#doctorTable')) {
                    $('#doctorTable').DataTable().destroy();
                }

                $('#doctorTable tbody').html(newBody);
                initDoctorTable();

                if (typeof callback === 'function') {
                    callback();
                }
            }
        });
    }

    function bindDoctorForm() {
        $(document).off('submit', '#doctorForm').on('submit', '#doctorForm', function (e) {
            e.preventDefault();
            const form = $(this);
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.text();

            submitBtn.prop('disabled', true).text('Menyimpan...');
            $.ajax({
                url: form.attr('action'),
                type: form.find('input[name="_method"]').val() || 'POST',
                data: form.serialize(),
                success: function () {
                    if (window.showAdminToast) {
                        window.showAdminToast('Data dokter berhasil disimpan.', 'Sukses', 'success');
                    }
                    $('#doctorModal').modal('hide');
                    refreshDoctorTable();
                },
                error: function (xhr) {
                    let message = 'Terjadi kesalahan.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        message = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                    } else if (xhr.responseText) {
                        message = xhr.responseText;
                    }
                    $('#doctorModalBody').html('<div class="alert alert-danger mb-0">' + message + '</div>');
                },
                complete: function () {
                    submitBtn.prop('disabled', false).text(originalText);
                }
            });
        });
    }

    $(document).on('click', '.open-doctor-modal', function () {
        const url = $(this).data('url');
        $('#doctorModalBody').html('Memuat form...');
        $('#doctorModal').modal('show');

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            success: function (html) {
                $('#doctorModalBody').html(html);
                bindDoctorForm();
            },
            error: function (xhr) {
                $('#doctorModalBody').html('<div class="alert alert-danger mb-0">Gagal memuat form.<br>' + (xhr.responseText || '') + '</div>');
            }
        });
    });

    $(document).on('click', '.delete-doctor', function () {
        if (!confirm('Hapus data dokter ini?')) return;

        $.ajax({
            url: $(this).data('url'),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function () {
                if (window.showAdminToast) {
                    window.showAdminToast('Data dokter berhasil dihapus.', 'Sukses', 'success');
                }
                refreshDoctorTable();
            },
            error: function (xhr) {
                alert(xhr.responseJSON?.message || 'Gagal menghapus data dokter.');
            }
        });
    });

    $(document).on('hidden.bs.modal', '#doctorModal', function () {
        $('#doctorModalBody').html('Memuat form...');
    });

    $(function () {
        initDoctorTable();
    });
</script>
@endpush
