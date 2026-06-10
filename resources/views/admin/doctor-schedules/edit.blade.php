@extends('layouts.admin.app')

@section('page-title', 'Edit Jadwal Dokter')
@section('page-subtitle', 'Perbarui jadwal praktik dokter')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Form Jadwal Dokter</h3>
        </div>
        <div class="card-body">
            @include('admin.doctor-schedules._form', ['schedule' => $schedule, 'dokters' => $dokters, 'services' => $services])
        </div>
    </div>
@endsection
