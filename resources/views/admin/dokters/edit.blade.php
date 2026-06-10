@extends('layouts.admin.app')

@section('page-title', 'Edit Dokter')
@section('page-subtitle', 'Perbarui data dokter dari source TSV')

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

