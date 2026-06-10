<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - {{ config('clinic.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <style>
        :root {
            --admin-bg: #f3f7fb;
            --admin-surface: #ffffff;
            --admin-border: #e2e8f0;
            --admin-text: #0f172a;
            --admin-muted: #64748b;
            --admin-primary: #0f766e;
            --admin-accent: #0ea5e9;
            --admin-shadow: 0 18px 42px rgba(15, 23, 42, .08);
        }
        * { box-sizing: border-box; }
        body { font-family: Inter, system-ui, sans-serif; background: var(--admin-bg); color: var(--admin-text); }
        .content-wrapper {
            background:
                radial-gradient(circle at top right, rgba(14,165,233,.08), transparent 28%),
                radial-gradient(circle at top left, rgba(15,118,110,.08), transparent 22%),
                var(--admin-bg);
        }
        .main-header.navbar {
            background: rgba(255,255,255,.88);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(226, 232, 240, .8);
            box-shadow: 0 8px 24px rgba(15, 23, 42, .04);
        }
        .main-sidebar {
            background: linear-gradient(180deg, #0f172a 0%, #111f38 100%);
        }
        .brand-link {
            border-bottom: 1px solid rgba(255,255,255,.08) !important;
            background: rgba(255,255,255,.02);
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
            background: linear-gradient(135deg, rgba(15,118,110,.88), rgba(14,165,233,.88));
            box-shadow: 0 12px 24px rgba(15,118,110,.22);
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link {
            border-radius: 14px;
            margin: 2px 8px;
            padding: 12px 14px;
            transition: transform .2s ease, background .2s ease;
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link:hover {
            transform: translateX(2px);
            background: rgba(255,255,255,.06);
        }
        .content-header {
            padding-top: 18px;
            padding-bottom: 8px;
        }
        .content-header h1 {
            font-weight: 800;
            letter-spacing: -0.03em;
        }
        .card {
            border: 1px solid var(--admin-border);
            border-radius: 20px;
            box-shadow: var(--admin-shadow);
            overflow: hidden;
        }
        .card-header {
            background: rgba(255,255,255,.72);
            border-bottom: 1px solid var(--admin-border);
        }
        .btn { border-radius: 999px; }
        .select2-container--default .select2-selection--single {
            border-radius: 14px;
            border-color: var(--admin-border);
            height: 40px;
            padding-top: 4px;
        }
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border-radius: 12px;
            border: 1px solid var(--admin-border);
            padding: 7px 10px;
            outline: none;
        }
    </style>
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('layouts.admin.partials.navbar')
    @include('layouts.admin.partials.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-muted mb-0">@yield('page-subtitle', config('clinic.tagline'))</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="content pb-4">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    @include('layouts.admin.partials.footer')
</div>

<div aria-live="polite" aria-atomic="true" style="position: fixed; top: 1rem; right: 1rem; z-index: 1085;">
    <div id="adminToast" class="toast" data-delay="2500" style="min-width: 280px;">
        <div class="toast-header">
            <strong class="mr-auto" id="adminToastTitle">Notifikasi</strong>
            <small class="text-muted">baru saja</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="adminToastBody"></div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script>
    $(function () {
        $('.select2').select2({
            width: '100%'
        });

        $('.datatable').DataTable({
            pageLength: 10,
            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                paginate: {
                    previous: 'Sebelumnya',
                    next: 'Berikutnya'
                },
                zeroRecords: 'Data tidak ditemukan'
            }
        });

        window.showAdminToast = function (message, title = 'Notifikasi', variant = 'success') {
            var toast = $('#adminToast');
            var body = $('#adminToastBody');
            var header = $('#adminToastTitle');

            header.text(title);
            body.text(message);

            toast.removeClass('bg-success bg-danger bg-warning text-white');

            if (variant === 'success') {
                toast.addClass('bg-success text-white');
            } else if (variant === 'danger') {
                toast.addClass('bg-danger text-white');
            } else if (variant === 'warning') {
                toast.addClass('bg-warning');
            }

            toast.toast({ autohide: true, delay: 2500 });
            toast.toast('show');
        };
    });
</script>
@stack('scripts')
</body>
</html>
