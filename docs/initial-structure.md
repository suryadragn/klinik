# Initial Laravel Structure

Struktur awal project dibagi menjadi area publik dan area admin.

## Folder Inti

- `app/Http/Controllers/Site`
- `app/Http/Controllers/Admin`
- `app/Http/Requests/Public`
- `app/Http/Requests/Admin`
- `resources/views/public`
- `resources/views/admin`
- `resources/views/layouts/public`
- `resources/views/layouts/admin`
- `resources/views/public/partials`
- `resources/views/admin/partials`
- `config/clinic.php`
- `database/migrations`

## Tujuan Struktur

- memisahkan tampilan publik dan admin dengan jelas
- memudahkan pengembangan fitur per modul
- membuat CRUD lebih rapi untuk backend
- menjaga pola kerja tetap sederhana dan familiar

## Pola Organisasi

### Public

- halaman beranda
- profil klinik
- layanan
- dokter dan jadwal
- berita
- galeri
- kontak

### Admin

- dashboard
- pengelolaan profil
- layanan
- dokter
- jadwal
- berita
- galeri
- pesan kontak
- setting website

## Catatan

- data statis klinik disimpan di `.env` lalu dibaca lewat `config/clinic.php`
- database dipakai untuk data dinamis dan konten yang diatur melalui admin
