@extends('layouts.admin.app')

@section('page-title', 'Layanan / Poli')
@section('page-subtitle', 'Kelola layanan klinik dengan modal AJAX dan refresh tanpa reload')

@push('styles')
<style>
    .service-summary {
        background: linear-gradient(135deg, rgba(15,118,110,.08), rgba(14,165,233,.08));
        border: 1px solid var(--admin-border);
        border-radius: 18px;
        padding: 16px;
    }
    .service-summary strong { display:block; font-size: 22px; letter-spacing:-.03em; }
    .service-summary span { color: var(--admin-muted); font-size: 13px; }
    .service-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-grid;
        place-items: center;
        background: rgba(15,118,110,.08);
        color: var(--admin-primary);
    }
</style>
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="service-summary">
                <strong>{{ $services->count() }}</strong>
                <span>Total layanan / poli</span>
            </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="service-summary">
                <strong>{{ $services->where('is_active', true)->count() }}</strong>
                <span>Layanan aktif</span>
            </div>
        </div>
        <div class="col-md-4 text-md-right mt-0 mt-md-0">
            <button type="button" class="btn btn-primary px-4 py-2 open-service-modal" data-url="{{ route('admin.layanan.create') }}">
                <i class="fas fa-plus mr-1"></i> Tambah Layanan
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Daftar Layanan / Poli</h3>
        </div>
        <div class="card-body p-0">
            @if ($services->isEmpty())
                <div class="px-4 py-4 text-center text-muted border-bottom">
                    Belum ada data layanan / poli.
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="serviceTable">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Icon</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th style="width:180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $service->name }}</strong>
                                    <div class="text-muted small">{{ \Illuminate\Support\Str::limit($service->description, 70) ?: '-' }}</div>
                                </td>
                                <td><code>{{ $service->slug }}</code></td>
                                <td>
                                    @if ($service->icon)
                                        <span class="service-icon"><i class="{{ $service->icon }}"></i></span>
                                        <span class="ml-2 text-muted small">{{ $service->icon }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $service->sort_order }}</td>
                                <td>
                                    @if ($service->is_active)
                                        <span class="badge badge-success px-3 py-2">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary px-3 py-2">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary open-service-modal" data-url="{{ route('admin.layanan.edit', $service->id) }}">Edit</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger delete-service" data-url="{{ route('admin.layanan.destroy', $service->id) }}">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Form Layanan / Poli</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="serviceModalBody">Memuat form...</div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function serviceTableOptions() {
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

    function initServiceTable() {
        if ($.fn.dataTable.isDataTable('#serviceTable')) {
            $('#serviceTable').DataTable().destroy();
        }

        $('#serviceTable').DataTable(serviceTableOptions());
    }

    function refreshServiceTable(callback) {
        $.ajax({
            url: window.location.href,
            type: 'GET',
            dataType: 'html',
            success: function (html) {
                var $html = $('<div>').html(html);
                var newBody = $html.find('#serviceTable tbody').html();

                if ($.fn.dataTable.isDataTable('#serviceTable')) {
                    $('#serviceTable').DataTable().destroy();
                }

                $('#serviceTable tbody').html(newBody);
                initServiceTable();

                if (typeof callback === 'function') {
                    callback();
                }
            }
        });
    }

    function bindServiceForm() {
        $(document).off('submit', '#serviceForm').on('submit', '#serviceForm', function (e) {
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
                        window.showAdminToast('Layanan / poli berhasil disimpan.', 'Sukses', 'success');
                    }
                    $('#serviceModal').modal('hide');
                    refreshServiceTable();
                },
                error: function (xhr) {
                    let message = 'Terjadi kesalahan.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        message = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                    } else if (xhr.responseText) {
                        message = xhr.responseText;
                    }
                    $('#serviceModalBody').html('<div class="alert alert-danger mb-0">' + message + '</div>');
                },
                complete: function () {
                    submitBtn.prop('disabled', false).text(originalText);
                }
            });
        });
    }

    $(document).on('click', '.open-service-modal', function () {
        const url = $(this).data('url');
        $('#serviceModalBody').html('Memuat form...');
        $('#serviceModal').modal('show');

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            success: function (html) {
                $('#serviceModalBody').html(html);
                $('#serviceModalBody .select2').select2({
                    width: '100%',
                    dropdownParent: $('#serviceModal')
                });
                bindServiceForm();
            },
            error: function (xhr) {
                $('#serviceModalBody').html('<div class="alert alert-danger mb-0">Gagal memuat form.<br>' + (xhr.responseText || '') + '</div>');
            }
        });
    });

    $(document).on('click', '.delete-service', function () {
        if (!confirm('Hapus layanan / poli ini?')) return;

        $.ajax({
            url: $(this).data('url'),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function () {
                if (window.showAdminToast) {
                    window.showAdminToast('Layanan / poli berhasil dihapus.', 'Sukses', 'success');
                }
                refreshServiceTable();
            },
            error: function (xhr) {
                alert(xhr.responseJSON?.message || 'Gagal menghapus layanan / poli.');
            }
        });
    });

    $(document).on('hidden.bs.modal', '#serviceModal', function () {
        $('#serviceModalBody').html('Memuat form...');
    });

    $(function () {
        initServiceTable();
    });
</script>
@endpush
