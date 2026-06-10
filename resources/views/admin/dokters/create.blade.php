@extends('layouts.admin.app')

@section('page-title', 'Tambah Dokter')
@section('page-subtitle', 'Input data dokter terbaru ke sistem')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Form Dokter</h3>
        </div>
        <div class="card-body">
            @include('admin.dokters._form', ['doctor' => $doctor])
        </div>
    </div>
@endsection

