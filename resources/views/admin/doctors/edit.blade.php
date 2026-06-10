@extends('layouts.admin.app')

@section('page-title', 'Edit Dokter')
@section('page-subtitle', 'Perbarui data dokter secara rapi dan konsisten')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Form Dokter</h3>
        </div>
        <div class="card-body">
            <div class="alert alert-info mb-0">
                Form edit dokter untuk: <strong>{{ $doctor->name }}</strong>
            </div>
        </div>
    </div>
@endsection

