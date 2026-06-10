# Deploy Linux Mint

Panduan deploy project ke server Linux Mint.

## Prasyarat Server

- Linux Mint
- Nginx atau Apache
- PHP 8.2+ dengan extension umum Laravel
- MySQL / MariaDB
- Composer

## Langkah Deploy

1. Upload atau clone project ke server

2. Pastikan folder berikut ada dan writable:

   - `storage`
   - `bootstrap/cache`

3. Install dependency

   ```bash
   composer install --no-dev --optimize-autoloader
   ```

4. Siapkan `.env`

   - isi `APP_NAME`
   - isi data klinik di section `APP_CLINIC_*`
   - isi koneksi database server

5. Generate key jika belum ada

   ```bash
   php artisan key:generate
   ```

6. Jalankan migration

   ```bash
   php artisan migrate --force
   ```

   Jika ingin langsung isi data awal:

   ```bash
   php artisan db:seed --force
   ```

7. Set permission

   Pastikan web server bisa menulis ke:

   - `storage`
   - `bootstrap/cache`

8. Buat symlink storage

   ```bash
   php artisan storage:link
   ```

9. Arahkan document root ke folder `public`

## Contoh Nginx

```nginx
server {
    listen 80;
    server_name domainkamu.com;
    root /var/www/gh1/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## Setelah Deploy

- jalankan `php artisan config:cache`
- jalankan `php artisan route:cache` jika sudah stabil
- jalankan `php artisan view:cache`

## Login Admin Awal

Jika seeder dijalankan, akun awal superadmin adalah:

- Username: `admingriy4`
- Password: `griya4husada1`
