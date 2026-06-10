@extends('layouts.public.app')

@section('title', 'Layanan')

@section('content')
    <section class="surface" style="padding: 36px;">
        <div class="badge">Layanan / Poli</div>
        <h1 style="margin: 12px 0 10px; font-size: clamp(28px, 4vw, 44px);">Layanan klinik yang rapi, jelas, dan mudah diakses</h1>
        <p class="muted" style="max-width: 760px; line-height: 1.7;">
            Berikut daftar layanan aktif yang tersedia di {{ config('clinic.name') }}. Semua data ini mengikuti pengelolaan admin agar mudah diperbarui kapan saja.
        </p>
    </section>

    <section class="section">
        @if ($services->isEmpty())
            <div class="surface" style="padding: 28px;">Belum ada layanan yang aktif.</div>
        @else
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
                @foreach ($services as $service)
                    <a href="{{ route('public.services.show', $service->slug) }}" class="surface" style="padding: 24px; display:block; text-decoration:none; color:inherit; border:1px solid rgba(148,163,184,.2);">
                        <div style="width:58px;height:58px;border-radius:18px;background:linear-gradient(135deg, rgba(15,118,110,.12), rgba(14,165,233,.12));display:grid;place-items:center;color:var(--primary);font-size:24px;">
                            @if ($service->icon)
                                <i class="{{ $service->icon }}"></i>
                            @else
                                <i class="fas fa-hospital-user"></i>
                            @endif
                        </div>
                        <h3 style="margin: 16px 0 8px;">{{ $service->name }}</h3>
                        <p class="muted" style="line-height:1.7; margin:0;">
                            {{ \Illuminate\Support\Str::limit($service->description, 120) ?: 'Lihat detail layanan ini.' }}
                        </p>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
@endsection
