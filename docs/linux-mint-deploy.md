# Deploy Linux Mint

Panduan deploy project ke server Linux Mint dengan Docker.

## Kenapa Docker

- LAMPP kamu bisa tetap pakai PHP 7.4 untuk aplikasi lain
- project klinik jalan di PHP 8.2 di container sendiri
- environment lebih konsisten antara Windows dan Linux Mint

## Prasyarat Server

- Linux Mint
- Docker Engine
- Docker Compose v2
- Git

## Struktur Docker

File yang dipakai:

- `docker-compose.yml`
- `docker/php/Dockerfile`
- `docker/php/php.ini`
- `docker/nginx/default.conf`
- `docker/.env.docker.example`

## Langkah Deploy

1. Clone project

   ```bash
   git clone https://github.com/suryadragn/klinik.git
   cd klinik
   ```

2. Siapkan environment Docker

   ```bash
   cp docker/.env.docker.example .env
   ```

   Lalu sesuaikan jika perlu:

   - `APP_URL=http://localhost:8080`
   - `DB_HOST=host.docker.internal`
   - `DB_PORT=3306` atau port MySQL yang dipakai host
   - `DB_DATABASE=klinik_griya_husada_1`
   - `DB_USERNAME=root`
   - `DB_PASSWORD=` sesuai server host

3. Build dan jalankan container

   ```bash
   docker compose up -d --build
   ```

4. Install dependency di container

   ```bash
   docker compose exec app composer install --no-dev --optimize-autoloader
   ```

5. Generate app key jika belum ada

   ```bash
   docker compose exec app php artisan key:generate
   ```

6. Jalankan migration dan seed

   ```bash
   docker compose exec app php artisan migrate --force
   docker compose exec app php artisan db:seed --force
   ```

   Jika ingin khusus dokter TSV:

   ```bash
   docker compose exec app php artisan db:seed --class=DokterSeeder
   ```

7. Buat storage symlink

   ```bash
   docker compose exec app php artisan storage:link
   ```

8. Cache konfigurasi jika sudah stabil

   ```bash
   docker compose exec app php artisan config:cache
   docker compose exec app php artisan route:cache
   docker compose exec app php artisan view:cache
   ```

9. Buka web

   - `http://localhost:5077`

## Permission Folder

Jika perlu, pastikan folder berikut bisa ditulis container:

- `storage`
- `bootstrap/cache`

Kalau file permission bermasalah, jalankan:

```bash
sudo chown -R $USER:$USER .
chmod -R 775 storage bootstrap/cache
```

## Update Setelah Pull

Kalau ada perubahan dari Git:

```bash
git pull
docker compose exec app composer install --no-dev --optimize-autoloader
docker compose exec app php artisan migrate --force
```

## Login Admin Awal

Jika seeder dijalankan, akun awal superadmin adalah:

- Username: `admingriy4`
- Password: `griya4husada1`

## Catatan

- LAMPP tetap bisa dipakai untuk aplikasi lain
- project klinik ini berjalan terisolasi di container PHP 8.2
- database tetap memakai MySQL yang sudah ada di host
- kalau nanti mau pindah ke domain, tinggal ubah `APP_URL` dan mapping port di reverse proxy
