@extends('layouts.public.app')

@section('title', config('clinic.name'))

@push('styles')
<style>
    .hero {
        display: grid;
        grid-template-columns: 1.15fr .85fr;
        gap: 22px;
        align-items: stretch;
        margin-top: 20px;
    }
    .hero-panel {
        position: relative;
        overflow: hidden;
        padding: 34px;
        min-height: 480px;
    }
    .hero-panel::before {
        content: "";
        position: absolute;
        inset: auto -12% -18% auto;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(14,165,233,.24) 0%, rgba(14,165,233,0) 68%);
        pointer-events: none;
    }
    .hero-eyebrow {
        display: inline-flex;
        padding: 9px 14px;
        border-radius: 999px;
        background: rgba(15,118,110,.08);
        color: var(--primary-dark);
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 16px;
    }
    .hero-title {
        margin: 0;
        font-size: clamp(36px, 5vw, 58px);
        line-height: 1.02;
        letter-spacing: -0.05em;
        max-width: 10ch;
    }
    .hero-copy {
        font-size: 16px;
        color: var(--muted);
        max-width: 62ch;
        margin: 18px 0 28px;
    }
    .hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .hero-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin-top: 26px;
    }
    .stat {
        padding: 18px;
        border-radius: 20px;
        background: rgba(255,255,255,.76);
        border: 1px solid var(--border);
    }
    .stat strong {
        display:block;
        font-size: 24px;
        letter-spacing: -0.03em;
    }
    .stat span {
        display:block;
        color: var(--muted);
        font-size: 13px;
    }
    .hero-side {
        display: grid;
        gap: 14px;
    }
    .hero-card {
        padding: 22px;
        overflow: hidden;
        position: relative;
    }
    .hero-card .mini {
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:12px;
        margin-bottom: 14px;
    }
    .badge {
        display:inline-flex;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        background: rgba(15,118,110,.08);
        color: var(--primary-dark);
    }
    .feature-grid {
        display:grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
    }
    .feature-card {
        padding: 20px;
        min-height: 150px;
    }
    .feature-card h3 { margin: 12px 0 8px; font-size: 17px; }
    .feature-card p { margin: 0; color: var(--muted); font-size: 14px; }
    .grid-2 {
        display:grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }
    .service-card, .promo-card, .article-card, .facility-card, .activity-card {
        overflow:hidden;
    }
    .service-card img,
    .promo-card img,
    .facility-card img,
    .activity-card img,
    .article-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display:block;
    }
    .card-body {
        padding: 18px;
    }
    .appointment {
        display:grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
        align-items:start;
    }
    .form-grid {
        display:grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }
    .field {
        display:grid;
        gap: 6px;
    }
    .field label {
        font-size: 13px;
        font-weight: 700;
        color: var(--text);
    }
    .field input,
    .field select {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 13px 14px;
        font: inherit;
        background: #fff;
        outline: none;
    }
    .field input:focus,
    .field select:focus {
        border-color: rgba(14,165,233,.55);
        box-shadow: 0 0 0 4px rgba(14,165,233,.10);
    }
    .full { grid-column: 1 / -1; }
    .clients {
        display:grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
    }
    .client-box {
        min-height: 84px;
        display:grid;
        place-items:center;
        padding: 16px;
        border-radius: 18px;
        color: var(--muted);
        background: rgba(255,255,255,.75);
        border: 1px dashed var(--border);
        font-weight: 700;
    }
    @media (max-width: 1100px) {
        .hero, .appointment, .grid-2 { grid-template-columns: 1fr; }
        .feature-grid, .clients { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 720px) {
        .hero-panel { padding: 24px; min-height: auto; }
        .hero-stats, .feature-grid, .clients, .form-grid { grid-template-columns: 1fr; }
        .service-card img, .promo-card img, .facility-card img, .activity-card img, .article-card img { height: 200px; }
    }
</style>
@endpush

@section('content')
@php
    $services = [
        ['title' => 'Medical Check Up', 'desc' => 'Pemeriksaan kesehatan untuk individu atau perusahaan.', 'img' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1200&q=80'],
        ['title' => 'Mom and Baby Spa', 'desc' => 'Ruang nyaman untuk perawatan ibu dan bayi.', 'img' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?auto=format&fit=crop&w=1200&q=80'],
        ['title' => 'Persalinan Alami', 'desc' => 'Layanan persalinan dengan pendekatan yang humanis.', 'img' => 'https://images.unsplash.com/photo-1516826957135-700dedea698c?auto=format&fit=crop&w=1200&q=80'],
        ['title' => 'USG 2D/4D', 'desc' => 'Pemeriksaan kehamilan dengan peralatan modern.', 'img' => 'https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=1200&q=80'],
    ];
    $facilities = [
        ['title' => 'Ruang Senam Hamil', 'desc' => 'Area khusus untuk persiapan persalinan.', 'img' => 'https://images.unsplash.com/photo-1580281657527-47a1c3b6cce0?auto=format&fit=crop&w=1200&q=80'],
        ['title' => 'Ruang Day Care', 'desc' => 'Layanan observasi dan perawatan singkat.', 'img' => 'https://images.unsplash.com/photo-1512678080530-7760d81faba6?auto=format&fit=crop&w=1200&q=80'],
        ['title' => 'Ruang Laktasi', 'desc' => 'Ruang nyaman dan privat untuk ibu menyusui.', 'img' => 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=1200&q=80'],
        ['title' => 'UGD 24 Jam', 'desc' => 'Siaga untuk penanganan cepat kapan pun dibutuhkan.', 'img' => 'https://images.unsplash.com/photo-1516574187841-cb9cc2ca948b?auto=format&fit=crop&w=1200&q=80'],
    ];
    $activities = [
        ['title' => 'Screening & Swab Kegiatan Instansi', 'desc' => 'Aktivitas layanan kesehatan di lokasi mitra.', 'img' => 'https://images.unsplash.com/photo-1584982751601-97dcc096659c?auto=format&fit=crop&w=1200&q=80'],
        ['title' => 'Medical Check Up Perusahaan', 'desc' => 'Pemeriksaan kesehatan untuk kebutuhan korporat.', 'img' => 'https://images.unsplash.com/photo-1584438784894-089d6a62b8fa?auto=format&fit=crop&w=1200&q=80'],
        ['title' => 'Layanan Vaksin dan Preventif', 'desc' => 'Mendukung pencegahan dan deteksi dini.', 'img' => 'https://images.unsplash.com/photo-1579684453423-4a2c5b9f4f6d?auto=format&fit=crop&w=1200&q=80'],
    ];
    $promos = [
        ['title' => 'Workshop Calon Mom & Dad', 'desc' => 'Persiapan keluarga baru dengan pembekalan praktis.', 'img' => 'https://images.unsplash.com/photo-1527799820374-dcf8d9d4a3c7?auto=format&fit=crop&w=1200&q=80'],
        ['title' => 'Promo Vaksin Internasional', 'desc' => 'Untuk perjalanan haji, umrah, dan luar negeri.', 'img' => 'https://images.unsplash.com/photo-1625461451468-6ffac1dfc9b2?auto=format&fit=crop&w=1200&q=80'],
        ['title' => 'Promo Swab PCR', 'desc' => 'Layanan pemeriksaan dengan proses cepat dan terukur.', 'img' => 'https://images.unsplash.com/photo-1584036561566-baf8f5f1b144?auto=format&fit=crop&w=1200&q=80'],
    ];
    $articles = [
        ['title' => 'Tips menjaga kesehatan keluarga di rumah', 'date' => '12 Jun 2026'],
        ['title' => 'Kapan perlu kontrol ke dokter kandungan?', 'date' => '09 Jun 2026'],
        ['title' => 'Manfaat medical check up berkala', 'date' => '03 Jun 2026'],
    ];
@endphp

<section class="hero">
    <div class="surface hero-panel">
        <div class="hero-eyebrow">Emergency Case 24 Hour</div>
        <h1 class="hero-title">{{ config('clinic.name') }}</h1>
        <p class="hero-copy">
            {{ config('clinic.description') }}.
            Kami menggabungkan pelayanan klinik yang ramah dengan pengalaman digital yang modern, cepat, dan mudah dipakai.
        </p>
        <div class="hero-actions">
            <a href="{{ route('public.contact') }}" class="btn-pill btn-primary">Daftar Sekarang</a>
            <a href="{{ route('public.services.index') }}" class="btn-pill btn-ghost">Lihat Layanan</a>
        </div>

        <div class="hero-stats">
            <div class="stat">
                <strong>24 Jam</strong>
                <span>UGD dan layanan darurat</span>
            </div>
            <div class="stat">
                <strong>10+</strong>
                <span>Jenis layanan unggulan</span>
            </div>
            <div class="stat">
                <strong>100%</strong>
                <span>Fokus pada kenyamanan pasien</span>
            </div>
        </div>
    </div>

    <div class="hero-side">
        <div class="surface hero-card">
            <div class="mini">
                <div>
                    <div class="badge">Jadwal Pelayanan Klinik</div>
                    <h3 style="margin:10px 0 6px; letter-spacing:-0.03em;">Siap melayani setiap hari</h3>
                </div>
                <div style="font-size:42px; color: var(--primary);">+</div>
            </div>
            <div style="display:grid; gap:12px; color: var(--muted);">
                <div class="card-soft" style="padding:16px;">
                    <strong style="display:block; color:var(--text);">UGD, Persalinan & Rawat Inap</strong>
                    Setiap hari 24 jam
                </div>
                <div class="card-soft" style="padding:16px;">
                    <strong style="display:block; color:var(--text);">Poli Umum </strong>
                    Setiap hari 24 jam
                </div>
                <div class="card-soft" style="padding:16px;">
                    <strong style="display:block; color:var(--text);">Poli Gigi & Mulut</strong>
                    Senin - Sabtu
                </div>
            </div>
        </div>
        <div class="surface hero-card" style="background: linear-gradient(135deg, rgba(15,118,110,.08), rgba(14,165,233,.08));">
            <div class="badge">Hubungi Kami</div>
            <div style="font-size: 18px; font-weight: 800; margin: 12px 0 8px;">Butuh bantuan cepat?</div>
            <div style="color: var(--muted); margin-bottom: 16px;">Gunakan kontak klinik untuk pendaftaran, informasi layanan, atau konsultasi awal.</div>
            <div style="display:grid; gap:8px; font-size: 14px;">
                <div><strong>Alamat:</strong> {{ config('clinic.address') }}</div>
                <div><strong>Telepon:</strong> {{ config('clinic.phone') ?: '-' }}</div>
                <div><strong>WhatsApp:</strong> {{ config('clinic.whatsapp') ?: '-' }}</div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="feature-grid">
        <div class="surface feature-card">
            <div class="badge">Layanan Unggulan</div>
            <h3>Medical Check Up</h3>
            <p>Pemeriksaan individu dan korporat dengan alur yang efisien.</p>
        </div>
        <div class="surface feature-card">
            <div class="badge">Layanan Unggulan</div>
            <h3>Mom & Baby Spa</h3>
            <p>Perawatan yang nyaman untuk ibu dan bayi dengan suasana tenang.</p>
        </div>
        <div class="surface feature-card">
            <div class="badge">Layanan Unggulan</div>
            <h3>Persalinan Alami</h3>
            <p>Pendampingan persalinan yang hangat, aman, dan profesional.</p>
        </div>
        <div class="surface feature-card">
            <div class="badge">Layanan Unggulan</div>
            <h3>USG 2D dan 4D</h3>
            <p>Peralatan modern untuk membantu pemantauan kehamilan.</p>
        </div>
    </div>
</section>

<section class="section" id="tentang">
    <div class="section-title">
        <div>
            <div class="eyebrow">Tentang Kami</div>
            <h2 style="margin-top:10px; font-size: clamp(24px, 3vw, 36px);">Klinik dengan layanan lengkap dan pendekatan yang humanis</h2>
        </div>
    </div>
    <div class="appointment">
        <div class="surface" style="padding: 28px;">
            <p style="margin-top:0; color: var(--muted);">
                {{ config('clinic.name') }} hadir sebagai fasilitas kesehatan yang menggabungkan pelayanan rawat jalan, rawat inap, dan penunjang lain dengan pengalaman yang lebih rapi, cepat, dan nyaman di sisi digital.
            </p>
            <div class="grid-2">
                <div class="card-soft" style="padding:18px;">
                    <strong>Pelayanan Utama</strong>
                    <div style="color: var(--muted); font-size:14px; margin-top:6px;">
                        Poli umum, poli gigi, kebidanan, KB, imunisasi, UGD, lab, farmasi.
                    </div>
                </div>
                <div class="card-soft" style="padding:18px;">
                    <strong>Fokus Kami</strong>
                    <div style="color: var(--muted); font-size:14px; margin-top:6px;">
                        Pelayanan yang aman, ramah, profesional, dan mudah diakses.
                    </div>
                </div>
            </div>
        </div>

        <div class="surface" style="padding: 28px;">
            <div class="badge">Form Pendaftaran</div>
            <form style="margin-top: 16px;">
                <div class="form-grid">
                    <div class="field">
                        <label>Tanggal Datang</label>
                        <input type="date">
                    </div>
                    <div class="field">
                        <label>Jam Datang</label>
                        <input type="time">
                    </div>
                    <div class="field full">
                        <label>Layanan</label>
                        <select>
                            <option>Medical Check Up</option>
                            <option>Mom and Baby Spa</option>
                            <option>Persalinan Alami</option>
                            <option>USG 2D/4D</option>
                            <option>Poli Umum</option>
                            <option>Poli Gigi</option>
                        </select>
                    </div>
                    <div class="field full">
                        <label>Nama Pasien</label>
                        <input type="text" placeholder="Nama lengkap">
                    </div>
                </div>
                <div style="margin-top: 16px;">
                    <a href="#" class="btn-pill btn-primary" style="width:100%;">Daftar Sekarang</a>
                </div>
            </form>
        </div>
    </div>
</section>
<!--
<section class="section" id="layanan">
    <div class="section-title">
        <div>
            <div class="eyebrow">Layanan Kami</div>
            <h2 style="margin-top:10px; font-size: clamp(24px, 3vw, 36px);">Layanan unggulan yang ditata lebih modern</h2>
        </div>
    </div>
    <div class="grid-2">
        @foreach ($services as $service)
            <article class="surface service-card">
                <img src="{{ $service['img'] }}" alt="{{ $service['title'] }}">
                <div class="card-body">
                    <h3 style="margin:0 0 8px; letter-spacing:-0.02em;">{{ $service['title'] }}</h3>
                    <p style="margin:0; color: var(--muted);">{{ $service['desc'] }}</p>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section class="section" id="fasilitas">
    <div class="section-title">
        <div>
            <div class="eyebrow">Fasilitas</div>
            <h2 style="margin-top:10px; font-size: clamp(24px, 3vw, 36px);">Fasilitas dibuat nyaman dan meyakinkan</h2>
        </div>
    </div>
    <div class="grid-2">
        @foreach ($facilities as $facility)
            <article class="surface facility-card">
                <img src="{{ $facility['img'] }}" alt="{{ $facility['title'] }}">
                <div class="card-body">
                    <h3 style="margin:0 0 8px;">{{ $facility['title'] }}</h3>
                    <p style="margin:0; color: var(--muted);">{{ $facility['desc'] }}</p>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section class="section" id="aktivitas">
    <div class="section-title">
        <div>
            <div class="eyebrow">Aktivitas Kami</div>
            <h2 style="margin-top:10px; font-size: clamp(24px, 3vw, 36px);">Aktivitas klinik yang aktif dan terpercaya</h2>
        </div>
    </div>
    <div class="grid-2">
        @foreach ($activities as $activity)
            <article class="surface activity-card">
                <img src="{{ $activity['img'] }}" alt="{{ $activity['title'] }}">
                <div class="card-body">
                    <h3 style="margin:0 0 8px;">{{ $activity['title'] }}</h3>
                    <p style="margin:0; color: var(--muted);">{{ $activity['desc'] }}</p>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section class="section" id="promo">
    <div class="section-title">
        <div>
            <div class="eyebrow">Promo Kami</div>
            <h2 style="margin-top:10px; font-size: clamp(24px, 3vw, 36px);">Promo yang ditampilkan dengan gaya editorial</h2>
        </div>
    </div>
    <div class="grid-2">
        @foreach ($promos as $promo)
            <article class="surface promo-card">
                <img src="{{ $promo['img'] }}" alt="{{ $promo['title'] }}">
                <div class="card-body">
                    <h3 style="margin:0 0 8px;">{{ $promo['title'] }}</h3>
                    <p style="margin:0; color: var(--muted);">{{ $promo['desc'] }}</p>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section class="section" id="artikel">
    <div class="section-title">
        <div>
            <div class="eyebrow">Artikel Kami</div>
            <h2 style="margin-top:10px; font-size: clamp(24px, 3vw, 36px);">Informasi kesehatan yang ringan dibaca</h2>
        </div>
    </div>
    <div class="grid-2">
        @foreach ($articles as $article)
            <article class="surface article-card">
                <div style="height: 220px; background: linear-gradient(135deg, rgba(15,118,110,.12), rgba(14,165,233,.14)); display:flex; align-items:end; padding: 20px;">
                    <div class="badge">Artikel</div>
                </div>
                <div class="card-body">
                    <div style="font-size:13px; color: var(--muted); margin-bottom: 8px;">{{ $article['date'] }}</div>
                    <h3 style="margin:0 0 8px;">{{ $article['title'] }}</h3>
                    <p style="margin:0; color: var(--muted);">Bacaan singkat untuk membantu pasien dan keluarga memahami kesehatan sehari-hari.</p>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section class="section">
    <div class="section-title">
        <div>
            <div class="eyebrow">Client Kami</div>
            <h2 style="margin-top:10px; font-size: clamp(24px, 3vw, 36px);">Mitra dan client yang pernah kami layani</h2>
        </div>
    </div>
    <div class="clients">
        <div class="client-box">Client 1</div>
        <div class="client-box">Client 2</div>
        <div class="client-box">Client 3</div>
        <div class="client-box">Client 4</div>
        <div class="client-box">Client 5</div>
        <div class="client-box">Client 6</div>
    </div>
</section>
        -->
@endsection
