<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('clinic.name'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f4f8fb;
            --surface: #ffffff;
            --surface-2: #f8fbff;
            --text: #0f172a;
            --muted: #64748b;
            --primary: #0f766e;
            --primary-dark: #115e59;
            --accent: #0ea5e9;
            --border: #e2e8f0;
            --shadow: 0 18px 48px rgba(15, 23, 42, .08);
            --radius-xl: 28px;
            --radius-lg: 22px;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: Inter, system-ui, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(14, 165, 233, .08), transparent 34%),
                radial-gradient(circle at top right, rgba(15, 118, 110, .09), transparent 28%),
                linear-gradient(180deg, #f7fbfe 0%, var(--bg) 38%, #edf4f9 100%);
            color: var(--text);
            line-height: 1.6;
        }
        a { color: inherit; text-decoration: none; }
        .page-shell { min-height: 100vh; display: flex; flex-direction: column; }
        .container { width: min(1180px, calc(100% - 32px)); margin: 0 auto; }
        .surface { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-xl); box-shadow: var(--shadow); }
        .card-soft { background: linear-gradient(180deg, var(--surface) 0%, var(--surface-2) 100%); border: 1px solid var(--border); border-radius: var(--radius-lg); box-shadow: var(--shadow); }
        .content { flex: 1; padding: 18px 0 60px; }
        .section { margin-top: 26px; }
        .section-title {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 16px;
        }
        .section-title h2,
        .section-title h3 {
            margin: 0;
            letter-spacing: -0.03em;
        }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(15, 118, 110, .08);
            color: var(--primary-dark);
            font-size: 13px;
            font-weight: 700;
        }
        .btn-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 20px;
            border-radius: 999px;
            border: 1px solid transparent;
            font-weight: 700;
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
        }
        .btn-pill:hover { transform: translateY(-1px); }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            color: #fff;
            box-shadow: 0 14px 24px rgba(15, 118, 110, .24);
        }
        .btn-ghost {
            background: rgba(255,255,255,.8);
            border-color: var(--border);
            color: var(--text);
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="page-shell">
        @include('layouts.public.partials.navbar')

        <main class="content">
            <div class="container">
                @yield('content')
            </div>
        </main>

        @include('layouts.public.partials.footer')
    </div>
    @include('layouts.public.partials.scripts')
    @stack('scripts')
</body>
</html>
