@extends('layouts.public.app')

@section('title', $service->name)

@section('content')
    <section class="surface" style="padding: 36px;">
        <div class="badge">Detail Layanan</div>
        <h1 style="margin: 12px 0 10px; font-size: clamp(28px, 4vw, 44px);">{{ $service->name }}</h1>
        <p class="muted" style="max-width: 760px; line-height: 1.7;">
            {{ $service->description ?: 'Informasi layanan ini belum diisi detailnya.' }}
        </p>
    </section>

    <section class="section">
        <div class="surface" style="padding: 28px;">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="muted small">Slug</div>
                    <div style="font-weight:700;">{{ $service->slug }}</div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="muted small">Urutan Tampil</div>
                    <div style="font-weight:700;">{{ $service->sort_order }}</div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="muted small">Status</div>
                    <div style="font-weight:700;">{{ $service->is_active ? 'Aktif' : 'Nonaktif' }}</div>
                </div>
            </div>
        </div>
    </section>
@endsection
