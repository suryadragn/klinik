@extends('layouts.admin.app')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan klinik, layanan, dokter, dan jadwal praktik')

@push('styles')
<style>
    .stat-card {
        position: relative;
        overflow: hidden;
        border: 0;
        color: #fff;
        min-height: 140px;
    }
    .stat-card::after {
        content: "";
        position: absolute;
        inset: auto -18px -24px auto;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255,255,255,.14);
    }
    .stat-label { font-size: 13px; opacity: .9; }
    .stat-value { font-size: 36px; font-weight: 800; letter-spacing: -0.04em; line-height: 1; }
    .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 18px;
        display: grid;
        place-items: center;
        background: rgba(255,255,255,.18);
        font-size: 22px;
    }
    .stat-surface {
        background: linear-gradient(135deg, #0f766e, #0ea5e9);
        box-shadow: 0 18px 42px rgba(15,118,110,.22);
    }
    .stat-secondary {
        background: linear-gradient(135deg, #334155, #475569);
        box-shadow: 0 18px 42px rgba(51,65,85,.18);
    }
    .stat-warning {
        background: linear-gradient(135deg, #f59e0b, #f97316);
        box-shadow: 0 18px 42px rgba(249,115,22,.18);
    }
    .calendar-shell {
        display: grid;
        grid-template-columns: repeat(7, minmax(0, 1fr));
        gap: 12px;
    }
    .day-column {
        background: rgba(255,255,255,.78);
        border: 1px solid var(--admin-border);
        border-radius: 18px;
        overflow: hidden;
    }
    .day-head {
        padding: 14px;
        font-weight: 800;
        letter-spacing: -0.02em;
        background: linear-gradient(180deg, rgba(15,118,110,.08), rgba(14,165,233,.04));
        border-bottom: 1px solid var(--admin-border);
    }
    .schedule-item {
        padding: 12px 14px;
        border-bottom: 1px solid #edf2f7;
        font-size: 13px;
    }
    .schedule-item:last-child { border-bottom: 0; }
    .schedule-time {
        display: inline-flex;
        padding: 5px 10px;
        border-radius: 999px;
        background: rgba(15,118,110,.08);
        color: var(--admin-primary);
        font-weight: 700;
        font-size: 12px;
        margin-bottom: 8px;
    }
    .doctor-name {
        font-weight: 700;
        display: block;
        margin-bottom: 2px;
    }
    .doctor-meta {
        color: var(--admin-muted);
        font-size: 12px;
    }
    @media (max-width: 1200px) {
        .calendar-shell { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 768px) {
        .calendar-shell { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card stat-card stat-surface">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Jumlah Layanan / Poli</div>
                        <div class="stat-value">{{ $serviceCount }}</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-hand-holding-medical"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card stat-card stat-secondary">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Jumlah Dokter Aktif</div>
                        <div class="stat-value">{{ $doctorCount }}</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-user-md"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card stat-card stat-warning">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total Jadwal Aktif</div>
                        <div class="stat-value">{{ $scheduleCount }}</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-calendar-days"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap">
                    <div>
                        <h3 class="card-title mb-0 font-weight-bold">Kalender Jadwal Dokter</h3>
                        <div class="text-muted small">Tampilan mingguan berdasarkan hari praktik</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="calendar-shell">
                        @foreach ($days as $day)
                            <div class="day-column">
                                <div class="day-head">{{ $day }}</div>
                                @forelse ($schedules->get($day, collect()) as $schedule)
                                    <div class="schedule-item">
                                        <span class="schedule-time">
                                            {{ $schedule->start_time ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i') : '--:--' }}
                                            -
                                            {{ $schedule->end_time ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i') : '--:--' }}
                                        </span>
                                        <span class="doctor-name">{{ $schedule->doctor->name ?? '-' }}</span>
                                        <span class="doctor-meta">
                                            {{ $schedule->service->name ?? ($schedule->room_name ?: 'Layanan belum diisi') }}
                                        </span>
                                    </div>
                                @empty
                                    <div class="schedule-item text-muted">Belum ada jadwal</div>
                                @endforelse
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
