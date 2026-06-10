# Run Lokal

Panduan menjalankan project di Laragon / Windows.

## Prasyarat

- PHP 8.2 atau lebih baru
- Composer
- MySQL jalan di port `3307`
- database kosong sudah dibuat manual

## Langkah

1. Pastikan database sudah ada

   Contoh nama database:

   - `klinik_griya_husada_1`

2. Install dependency

   ```bash
   composer install
   ```

3. Siapkan environment file

   Jika `.env` belum ada, copy dari `.env.example`.

   ```bash
   copy .env.example .env
   ```

4. Generate application key

   ```bash
   php artisan key:generate
   ```

5. Jalankan migration

   ```bash
   php artisan migrate
   ```

   Jika ingin langsung isi data awal klinik:

   ```bash
   php artisan migrate --seed
   ```

6. Jalankan web server lokal

   ```bash
   php artisan serve
   ```

   Jika nanti ada upload file publik, jalankan juga:

   ```bash
   php artisan storage:link
   ```

7. Buka browser

   - `http://127.0.0.1:8000`

## Login Admin

Jika sudah menjalankan seeder, gunakan akun ini:

- Username: `admingriy4`
- Password: `griya4husada1`

## Seed Dokter TSV

Jika source dokter sudah siap, taruh file TSV di:

- `database/seeders/data/dokters.tsv`

Lalu jalankan:

```bash
php artisan db:seed --class=DokterSeeder
```

## Catatan

- Jika memakai Laragon, kamu juga bisa arahkan virtual host ke folder `public`
- `.env` dipakai untuk nama aplikasi dan data statis klinik supaya mudah diubah
