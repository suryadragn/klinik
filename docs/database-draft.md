# Draft Database Klinik Griya Husada 1

Dokumen ini berisi draft modul database awal dan relasi tabel yang akan dipakai sebagai dasar implementasi Laravel.

## Prinsip Desain

- gunakan struktur yang sederhana dan mudah dipahami
- utamakan relasi yang jelas antar tabel
- hindari tabel yang terlalu lebar tanpa kebutuhan
- data dinamis disimpan terpisah dari data master
- siapkan struktur yang aman untuk server-side CRUD

## Modul Database Awal

1. Auth dan Admin
2. Profil Klinik
3. Layanan
4. Dokter dan Jadwal
5. Konten Informasi / Berita
6. Galeri
7. Kontak dan Lokasi
8. Referensi Umum

## Draft Tabel Inti

### 1. `users`

Tabel autentikasi admin.

Field utama:

- `id`
- `name`
- `email`
- `password`
- `role`
- `is_active`
- `last_login_at`
- timestamps

Relasi:

- satu user bisa menjadi admin pengelola konten

### 2. `roles`

Jika nanti dibutuhkan kontrol akses yang lebih rapih, role bisa dipisah ke tabel sendiri.

Field utama:

- `id`
- `name`
- `slug`
- `description`
- timestamps

Relasi:

- satu role memiliki banyak user

Catatan:

- kalau kebutuhan masih sederhana, role bisa tetap di `users.role`
- kalau nanti perlu granular permission, tabel ini bisa dikembangkan ke sistem permission

### 3. `clinic_profiles`

Profil utama klinik.

Field utama:

- `id`
- `name`
- `short_name`
- `description`
- `vision`
- `mission`
- `history`
- `address`
- `phone`
- `whatsapp`
- `email`
- `maps_url`
- `logo`
- `cover_image`
- timestamps

Relasi:

- satu klinik punya satu profil utama

Catatan:

- untuk tahap awal cukup satu baris data
- tabel ini bisa dipakai sebagai sumber profil di frontend publik

### 4. `services`

Daftar layanan klinik.

Field utama:

- `id`
- `name`
- `slug`
- `description`
- `icon`
- `image`
- `sort_order`
- `is_active`
- timestamps

Relasi:

- satu klinik memiliki banyak layanan

### 5. `doctors`

Data dokter atau tenaga medis yang ditampilkan ke publik.

Field utama:

- `id`
- `name`
- `slug`
- `specialization`
- `education`
- `sip_number`
- `photo`
- `bio`
- `is_active`
- timestamps

Relasi:

- satu dokter bisa punya banyak jadwal praktik
- satu dokter bisa terkait ke banyak layanan jika nanti dibutuhkan

### 6. `doctor_schedules`

Jadwal praktik dokter.

Field utama:

- `id`
- `doctor_id`
- `day_name`
- `start_time`
- `end_time`
- `room_name`
- `notes`
- `is_active`
- timestamps

Relasi:

- many to one ke `doctors`

Keterangan:

- satu dokter bisa punya banyak jadwal
- tabel ini cocok untuk server-side CRUD karena jadwal bisa sering berubah

### 7. `news_categories`

Kategori berita atau informasi kesehatan.

Field utama:

- `id`
- `name`
- `slug`
- `description`
- `is_active`
- timestamps

Relasi:

- satu kategori punya banyak berita

### 8. `news_posts`

Artikel, berita, atau informasi kesehatan.

Field utama:

- `id`
- `news_category_id`
- `user_id`
- `title`
- `slug`
- `excerpt`
- `content`
- `thumbnail`
- `published_at`
- `status`
- `is_featured`
- timestamps

Relasi:

- many to one ke `news_categories`
- many to one ke `users`

Catatan:

- `status` bisa berupa `draft`, `published`, `archived`

### 9. `galleries`

Galeri foto dan video.

Field utama:

- `id`
- `title`
- `slug`
- `description`
- `media_type`
- `media_path`
- `thumbnail`
- `sort_order`
- `is_active`
- timestamps

Relasi:

- satu klinik memiliki banyak item galeri

Catatan:

- `media_type` bisa berisi `image` atau `video`

### 10. `contact_messages`

Pesan dari pengunjung website.

Field utama:

- `id`
- `name`
- `phone`
- `email`
- `subject`
- `message`
- `source`
- `status`
- `read_at`
- timestamps

Relasi:

- berdiri sendiri

Catatan:

- cocok untuk form kontak atau form pertanyaan
- aman diproses server-side

### 11. `social_links`

Daftar media sosial klinik.

Field utama:

- `id`
- `platform`
- `label`
- `url`
- `icon`
- `sort_order`
- `is_active`
- timestamps

Relasi:

- berdiri sendiri

### 12. `settings`

Konfigurasi umum website.

Field utama:

- `id`
- `key`
- `value`
- `type`
- `group_name`
- timestamps

Relasi:

- berdiri sendiri

Contoh isi:

- nama klinik
- jam operasional
- nomor WA utama
- favicon
- SEO default

## Relasi Utama

### Relasi Inti

- `users` -> `news_posts`
  - satu user dapat membuat banyak artikel
- `news_categories` -> `news_posts`
  - satu kategori memiliki banyak posting
- `doctors` -> `doctor_schedules`
  - satu dokter memiliki banyak jadwal

### Relasi Pendukung

- `users` -> `contact_messages`
  - jika nanti pesan dibaca atau diproses oleh admin tertentu
- `users` -> `galleries`
  - jika ingin tracking siapa yang upload

## Prioritas Pembuatan Migration

Urutan yang disarankan:

1. `users`
2. `roles` jika dipakai
3. `clinic_profiles`
4. `services`
5. `doctors`
6. `doctor_schedules`
7. `news_categories`
8. `news_posts`
9. `galleries`
10. `contact_messages`
11. `social_links`
12. `settings`

## Catatan Implementasi Laravel

- gunakan `soft deletes` hanya pada tabel yang memang butuh riwayat
- gunakan `timestamps` pada semua tabel utama
- buat `slug` pada data yang akan ditampilkan ke publik
- buat indeks pada field yang sering dicari, seperti:
  - `slug`
  - `status`
  - `is_active`
  - `published_at`
  - foreign key columns
- jika nanti data dokter, layanan, atau berita berkembang, tabel tambahan bisa dipecah tanpa merombak struktur inti

## Versi Awal yang Disarankan

Untuk tahap awal, struktur paling aman adalah:

- `users`
- `clinic_profiles`
- `services`
- `doctors`
- `doctor_schedules`
- `news_categories`
- `news_posts`
- `galleries`
- `contact_messages`
- `social_links`
- `settings`

Jika sistem role belum dibutuhkan, `roles` bisa ditunda dulu.

## Tambahan Relasi

- `doctor_service` sebagai pivot many-to-many antara `doctors` dan `services`
- tabel ini dipakai saat satu dokter menangani lebih dari satu layanan, atau satu layanan ditangani lebih dari satu dokter

## Catatan RBAC

- `users.username` dipakai untuk login admin
- `users.role` dipetakan ke `roles.slug`
- `roles` terhubung ke `permissions` lewat pivot `role_permission`
- `superadmin` mendapatkan semua permission
