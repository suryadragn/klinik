<header style="padding: 14px 0 0;">
    <div class="container">
        <div class="surface" style="overflow:hidden;">
            <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; padding: 12px 20px; background: linear-gradient(90deg, rgba(15,118,110,.09), rgba(14,165,233,.08)); border-bottom: 1px solid var(--border); font-size: 13px; color: var(--muted); flex-wrap: wrap;">
                <div style="display:flex; gap:18px; flex-wrap: wrap;">
                    <span><strong style="color:var(--text);">Telp:</strong> {{ config('clinic.phone') ?: 'Hubungkan dari .env' }}</span>
                    <span><strong style="color:var(--text);">WhatsApp:</strong> {{ config('clinic.whatsapp') ?: 'Hubungkan dari .env' }}</span>
                    <span><strong style="color:var(--text);">Buka:</strong> {{ config('clinic.opening_hours') ?: 'Setiap hari' }}</span>
                </div>
                <div>
                    <a class="btn-pill btn-ghost" href="{{ config('clinic.maps_url') ?: '#' }}" target="_blank" rel="noreferrer">Lihat Lokasi</a>
                </div>
            </div>

            <div style="display:flex; align-items:center; justify-content:space-between; gap:18px; padding: 18px 20px; flex-wrap: wrap;">
                <a href="{{ route('public.home') }}" style="display:flex; align-items:center; gap:14px;">
                    <div style="width:52px; height:52px; border-radius:16px; background: linear-gradient(135deg, var(--primary), var(--accent)); display:grid; place-items:center; color:#fff; font-weight:800; box-shadow: 0 16px 28px rgba(15,118,110,.22);">
                        {{ strtoupper(substr(config('clinic.short_name'), 0, 2)) }}
                    </div>
                    <div>
                        <div style="font-weight:800; letter-spacing:-0.03em; font-size: 18px;">{{ config('clinic.name') }}</div>
                        <div style="color: var(--muted); font-size: 13px;">{{ config('clinic.tagline') }}</div>
                    </div>
                </a>

                <nav style="display:flex; gap:18px; color: var(--muted); font-size: 14px; flex-wrap: wrap; align-items:center;">
                    <a href="{{ route('public.home') }}">Beranda</a>
                    <a href="{{ route('public.profile') }}">Tentang Kami</a>
                    <a href="{{ route('public.services.index') }}">Layanan Kami</a>
                    <a href="#fasilitas">Fasilitas</a>
                    <a href="#aktivitas">Aktivitas Kami</a>
                    <a href="#promo">Promo</a>
                    <a href="#artikel">Artikel</a>
                </nav>

                <!-- <a class="btn-pill btn-primary" href="{{ route('public.contact') }}">Daftar / Kontak</a> -->
            </div>
        </div>
    </div>
</header>
