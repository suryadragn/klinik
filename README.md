# Klinik Griya Husada 1

Website resmi untuk klinik dengan fokus pada tampilan publik yang modern dan panel admin yang mudah dipakai.

## Tujuan

- menampilkan profil klinik secara profesional
- memudahkan pengunjung melihat layanan, dokter, jadwal, berita, galeri, dan kontak
- menyediakan panel admin yang praktis untuk pengelolaan konten dan data
- siap untuk deployment di server Linux Mint

## Stack Utama

- Framework: Laravel
- Frontend publik: Blade + UI/UX modern
- Backend admin: AdminLTE
- Dropdown dinamis: Select2
- Tabel data: DataTables
- Interaksi admin: jQuery style
- Database: MySQL / MariaDB

## Prinsip Pengembangan

- prioritaskan server-side CRUD untuk data yang besar atau dinamis
- gunakan Select2 untuk dropdown dengan data yang sering berubah
- gunakan DataTables untuk tabel yang butuh search, filter, sorting, dan pagination
- jaga agar struktur kode sederhana, konsisten, dan mudah dipelihara
- pastikan semua fitur aman dan nyaman dijalankan di Linux Mint

## Area Aplikasi

### Publik

- Beranda
- Profil klinik
- Layanan
- Dokter dan jadwal
- Berita / informasi kesehatan
- Galeri
- Kontak

### Admin

- Manajemen konten halaman
- Manajemen layanan
- Manajemen dokter
- Manajemen jadwal
- Manajemen berita
- Manajemen galeri
- Data kontak dan informasi klinik

## Referensi Gaya

Untuk pola jQuery dan kebiasaan interaksi admin, gunakan referensi dari:

- `C:\laragon\www\pddikti`

Referensi itu dipakai sebagai acuan gaya kerja, bukan untuk menyalin mentah-mentah.

## File Pedoman

- [AI Instruction](./ai-instruction.md)
- [Database Draft](./docs/database-draft.md)
- [Initial Structure](./docs/initial-structure.md)
- [Run Lokal](./docs/run-local.md)
- [Deploy Linux Mint](./docs/linux-mint-deploy.md)

## Catatan

Project ini dikembangkan di Windows melalui Laragon, tetapi target server final adalah Linux Mint.

## Login Admin Awal

Jika seeder sudah dijalankan, gunakan:

- Username: `admingriy4`
- Password: `griya4husada1`
