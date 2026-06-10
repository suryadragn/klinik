@extends('layouts.admin.app')

@section('page-title', 'Jadwal Dokter')
@section('page-subtitle', 'Kelola jadwal praktik dokter dalam tampilan daftar yang mudah dibaca')

@push('styles')
<style>
    .schedule-summary {
        background: linear-gradient(135deg, rgba(15,118,110,.08), rgba(14,165,233,.08));
        border: 1px solid var(--admin-border);
        border-radius: 18px;
        padding: 16px;
    }
    .schedule-summary strong { display:block; font-size: 22px; letter-spacing:-.03em; }
    .schedule-summary span { color: var(--admin-muted); font-size: 13px; }
</style>
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="schedule-summary">
                <strong>{{ $schedules->count() }}</strong>
                <span>Total jadwal aktif / terdaftar</span>
            </div>
        </div>
        <div class="col-md-4 text-md-right mt-3 mt-md-0">
            <button type="button" class="btn btn-primary px-4 py-2 open-schedule-modal" data-url="{{ route('admin.jadwal-dokter.create') }}">
                <i class="fas fa-plus mr-1"></i> Tambah Jadwal
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Daftar Jadwal Dokter</h3>
        </div>
        <div class="card-body p-0">
            @if ($schedules->isEmpty())
                <div class="px-4 py-4 text-center text-muted border-bottom">
                    Belum ada jadwal dokter.
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="scheduleTable">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Dokter</th>
                            <th>Layanan / Poli</th>
                            <th>Status</th>
                            <th style="width:180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $schedule->day_name }}</strong></td>
                                <td>
                                    {{ $schedule->start_time ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i') : '--:--' }}
                                    -
                                    {{ $schedule->end_time ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i') : '--:--' }}
                                </td>
                                <td>{{ $schedule->doctor->nm_dokter ?? '-' }}</td>
                                <td>{{ $schedule->service->name ?? ($schedule->room_name ?: '-') }}</td>
                                <td>
                                    @if ($schedule->is_active)
                                        <span class="badge badge-success px-3 py-2">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary px-3 py-2">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary open-schedule-modal" data-url="{{ route('admin.jadwal-dokter.edit', $schedule->id) }}">Edit</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger delete-schedule" data-url="{{ route('admin.jadwal-dokter.destroy', $schedule->id) }}">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Form Jadwal Dokter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="scheduleModalBody">Memuat form...</div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function scheduleTableOptions() {
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

    function initScheduleTable() {
        if ($.fn.dataTable.isDataTable('#scheduleTable')) {
            $('#scheduleTable').DataTable().destroy();
        }

        $('#scheduleTable').DataTable(scheduleTableOptions());
    }

    function refreshScheduleTable(callback) {
        $.ajax({
            url: window.location.href,
            type: 'GET',
            dataType: 'html',
            success: function (html) {
                var $html = $('<div>').html(html);
                var newBody = $html.find('#scheduleTable tbody').html();

                if ($.fn.dataTable.isDataTable('#scheduleTable')) {
                    $('#scheduleTable').DataTable().destroy();
                }

                $('#scheduleTable tbody').html(newBody);
                initScheduleTable();

                if (typeof callback === 'function') {
                    callback();
                }
            }
        });
    }

    function bindScheduleForm() {
        $(document).off('submit', '#scheduleForm').on('submit', '#scheduleForm', function (e) {
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
                        window.showAdminToast('Jadwal dokter berhasil disimpan.', 'Sukses', 'success');
                    }
                    $('#scheduleModal').modal('hide');
                    refreshScheduleTable();
                },
                error: function (xhr) {
                    let message = 'Terjadi kesalahan.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        message = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                    } else if (xhr.responseText) {
                        message = xhr.responseText;
                    }
                    $('#scheduleModalBody').html('<div class="alert alert-danger mb-0">' + message + '</div>');
                },
                complete: function () {
                    submitBtn.prop('disabled', false).text(originalText);
                }
            });
        });
    }

    $(document).on('click', '.open-schedule-modal', function () {
        const url = $(this).data('url');
        $('#scheduleModalBody').html('Memuat form...');
        $('#scheduleModal').modal('show');

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            success: function (html) {
                $('#scheduleModalBody').html(html);
                $('#scheduleModalBody .select2').select2({
                    width: '100%',
                    dropdownParent: $('#scheduleModal')
                });
                bindScheduleForm();
            },
            error: function (xhr) {
                $('#scheduleModalBody').html('<div class="alert alert-danger mb-0">Gagal memuat form.<br>' + (xhr.responseText || '') + '</div>');
            }
        });
    });

    $(document).on('click', '.delete-schedule', function () {
        if (!confirm('Hapus jadwal dokter ini?')) return;

        $.ajax({
            url: $(this).data('url'),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function () {
                if (window.showAdminToast) {
                    window.showAdminToast('Jadwal dokter berhasil dihapus.', 'Sukses', 'success');
                }
                refreshScheduleTable();
            },
            error: function (xhr) {
                alert(xhr.responseJSON?.message || 'Gagal menghapus jadwal dokter.');
            }
        });
    });

    $(document).on('hidden.bs.modal', '#scheduleModal', function () {
        $('#scheduleModalBody').html('Memuat form...');
    });

    $(function () {
        initScheduleTable();
    });
</script>
@endpush
