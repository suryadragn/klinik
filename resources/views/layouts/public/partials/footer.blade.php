<footer style="padding: 0 0 24px;">
    <div class="container">
        <div class="surface" style="overflow:hidden;">
            <div style="display:grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 24px; padding: 28px 24px;">
                <div>
                    <div style="font-weight:800; font-size:18px; margin-bottom:10px;">{{ config('clinic.name') }}</div>
                    <div style="color: var(--muted); font-size: 14px;">{{ config('clinic.description') }}</div>
                </div>
                <div>
                    <div style="font-weight:700; margin-bottom:10px;">Kontak</div>
                    <div style="color: var(--muted); font-size: 14px; display:grid; gap: 6px;">
                        <span>{{ config('clinic.phone') ?: '-' }}</span>
                        <span>{{ config('clinic.whatsapp') ?: '-' }}</span>
                        <span>{{ config('clinic.email') ?: '-' }}</span>
                    </div>
                </div>
                <div>
                    <div style="font-weight:700; margin-bottom:10px;">Alamat</div>
                    <div style="color: var(--muted); font-size: 14px;">{{ config('clinic.address') }}</div>
                </div>
                <div>
                    <div style="font-weight:700; margin-bottom:10px;">Media Sosial</div>
                    <div style="color: var(--muted); font-size: 14px;">
                        <a href="{{ config('clinic.instagram') }}" target="_blank" rel="noreferrer">Instagram</a>
                    </div>
                </div>
            </div>
            <div style="border-top:1px solid var(--border); padding: 16px 24px; color: var(--muted); font-size: 14px; display:flex; justify-content:space-between; gap:12px; flex-wrap: wrap;">
                <span>&copy; {{ date('Y') }} {{ config('clinic.name') }}. Semua hak dilindungi.</span>
                <span>Buka {{ config('clinic.opening_hours') ?: 'setiap hari' }}</span>
            </div>
        </div>
    </div>
</footer>
