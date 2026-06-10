<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - {{ config('clinic.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary:#0f766e; --accent:#0ea5e9; --bg:#f4f8fb; --text:#0f172a; --muted:#64748b; --border:#dbe4ef; }
        * { box-sizing:border-box; }
        body {
            margin:0; min-height:100vh; display:grid; place-items:center; font-family:Inter,system-ui,sans-serif;
            background: radial-gradient(circle at top, rgba(14,165,233,.12), transparent 30%), linear-gradient(180deg, #f7fbfe, var(--bg));
            color:var(--text);
        }
        .card {
            width:min(460px, calc(100% - 32px));
            background:#fff; border:1px solid var(--border); border-radius:24px; padding:28px; box-shadow:0 20px 48px rgba(15,23,42,.10);
        }
        h1 { margin:0 0 8px; letter-spacing:-.03em; }
        p { margin:0 0 20px; color:var(--muted); }
        .field { display:grid; gap:6px; margin-bottom:14px; }
        label { font-size:13px; font-weight:700; }
        input {
            width:100%; padding:13px 14px; border:1px solid var(--border); border-radius:14px; font:inherit; outline:none;
        }
        input:focus { border-color: rgba(14,165,233,.6); box-shadow:0 0 0 4px rgba(14,165,233,.10); }
        .btn {
            width:100%; border:0; border-radius:999px; padding:14px 18px; font:inherit; font-weight:800; color:#fff;
            background: linear-gradient(135deg, var(--primary), var(--accent)); cursor:pointer;
        }
        .error { color:#b91c1c; font-size:13px; margin-top:6px; }
        .note { margin-top:16px; font-size:13px; color:var(--muted); }
    </style>
</head>
<body>
    <div class="card">
        <h1>Login Admin</h1>
        <p>{{ config('clinic.name') }}</p>

        <form method="POST" action="{{ route('admin.login.store') }}">
            @csrf
            <div class="field">
                <label>Username</label>
                <input type="text" name="username" value="{{ old('username') }}" autocomplete="username" required>
                @error('username') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="field">
                <label>Password</label>
                <input type="password" name="password" autocomplete="current-password" required>
                @error('password') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="field" style="display:flex;align-items:center;gap:10px;">
                <input type="checkbox" name="remember" id="remember" value="1" style="width:auto;">
                <label for="remember" style="margin:0;">Ingat saya</label>
            </div>
            <button type="submit" class="btn">Masuk ke Admin</button>
        </form>

        <div class="note">Gunakan akun superadmin untuk akses penuh.</div>
    </div>
</body>
</html>

