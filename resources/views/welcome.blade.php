<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('clinic.name', config('app.name')) }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 40px; background: #f6f7fb; color: #1f2937; }
        .card { max-width: 760px; margin: 0 auto; background: #fff; border-radius: 16px; padding: 32px; box-shadow: 0 10px 30px rgba(0,0,0,.08); }
        h1 { margin-top: 0; }
        .muted { color: #6b7280; }
    </style>
</head>
<body>
    <div class="card">
        <h1>{{ config('clinic.name', config('app.name')) }}</h1>
        <p class="muted">{{ config('clinic.tagline') }}</p>
        <p>{{ config('clinic.description') }}</p>
        <p><strong>Alamat:</strong> {{ config('clinic.address') }}</p>
    </div>
</body>
</html>

