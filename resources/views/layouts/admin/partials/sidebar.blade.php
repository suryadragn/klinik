<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.dashboard') }}" class="brand-link d-flex align-items-center">
        <span class="brand-text font-weight-bold">{{ config('clinic.short_name') }}</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-start">
            <div class="image">
                <div style="width:36px;height:36px;border-radius:12px;background:linear-gradient(135deg,#0f766e,#0ea5e9);display:grid;place-items:center;color:#fff;font-weight:800;">
                    {{ strtoupper(substr(config('clinic.short_name'), 0, 1)) }}
                </div>
            </div>
            <div class="info" style="white-space: normal; line-height: 1.25; max-width: 155px;">
                <a href="#" class="d-block" style="font-weight:700; font-size: 14px; word-break: break-word;">
                    {{ auth()->user()->name ?? 'Admin' }}
                </a>
                <small class="text-muted d-block" style="font-size: 12px;">
                    {{ auth()->user()->role ?? 'admin' }}
                </small>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-header text-uppercase small text-muted" style="letter-spacing:.12em;">Utama</li>
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a></li>

                <li class="nav-header text-uppercase small text-muted mt-3" style="letter-spacing:.12em;">Konten Klinik</li>
                <li class="nav-item"><a href="{{ route('admin.clinic-profile.index') }}" class="nav-link {{ request()->routeIs('admin.clinic-profile.*') ? 'active' : '' }}"><i class="nav-icon fas fa-clinic-medical"></i><p>Profil Klinik</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.layanan.index') }}" class="nav-link {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}"><i class="nav-icon fas fa-hand-holding-medical"></i><p>Layanan / Poli</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.dokter.index') }}" class="nav-link {{ request()->routeIs('admin.dokter.*') ? 'active' : '' }}"><i class="nav-icon fas fa-user-md"></i><p>Dokter</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.jadwal-dokter.index') }}" class="nav-link {{ request()->routeIs('admin.jadwal-dokter.*') ? 'active' : '' }}"><i class="nav-icon fas fa-calendar-days"></i><p>Jadwal Dokter</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}"><i class="nav-icon fas fa-newspaper"></i><p>Berita</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.galeri.index') }}" class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}"><i class="nav-icon fas fa-images"></i><p>Galeri</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.pesan-kontak.index') }}" class="nav-link {{ request()->routeIs('admin.pesan-kontak.*') ? 'active' : '' }}"><i class="nav-icon fas fa-envelope"></i><p>Pesan Kontak</p></a></li>
                <li class="nav-item"><a href="{{ route('admin.setting.index') }}" class="nav-link {{ request()->routeIs('admin.setting.*') ? 'active' : '' }}"><i class="nav-icon fas fa-cog"></i><p>Setting</p></a></li>
            </ul>
        </nav>
    </div>
</aside>
