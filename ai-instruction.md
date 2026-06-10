# AI Instruction

Dokumen ini adalah sumber kebenaran untuk arah pengembangan project.

## Tujuan Project

Membangun website resmi klinik yang:

- modern, efisien, dan estetik di sisi publik
- mudah dikelola oleh admin klinik
- stabil untuk deployment di server Linux Mint
- tetap nyaman dikembangkan di Laragon Windows saat lokal development

## Target Environment

- Local development: Laragon di Windows
- Production server: Linux Mint
- Backend stack: Laravel
- Database: MySQL atau MariaDB

## Arah Desain

### Frontend Publik

- gunakan UI/UX modern yang bersih, jelas, dan profesional
- utamakan kecepatan akses informasi
- desain harus responsif untuk desktop dan mobile
- fokus pada halaman:
  - beranda
  - profil klinik
  - layanan
  - dokter dan jadwal
  - berita / informasi kesehatan
  - galeri
  - kontak dan lokasi

### Backend Admin

- gunakan AdminLTE sebagai standar tampilan admin
- gunakan Select2 untuk dropdown
- gunakan DataTables untuk tabel
- tampilan admin harus familiar, cepat dipahami, dan tidak berlebihan

## Standar Implementasi

### Prinsip Umum

- pilih solusi yang stabil dan mudah dirawat
- hindari pola yang terlalu rumit jika ada cara yang lebih sederhana
- utamakan struktur yang mudah dipahami developer lain
- jangan bergantung pada perilaku yang hanya aman di Windows

### Pola CRUD

#### Server-side wajib dipakai untuk:

- tabel data yang besar
- pencarian, filter, sorting, pagination
- data operasional yang sering berubah
- dropdown dengan data yang banyak atau dinamis

#### Select2 dipakai untuk:

- dropdown yang butuh pencarian
- dropdown dengan data real time / sering berganti
- relasi data yang tidak efisien jika di-load semua sekaligus

#### DataTables dipakai untuk:

- daftar data utama di admin
- master data
- laporan
- tabel operasional yang butuh pencarian dan filter

#### Modal AJAX wajib dipakai untuk:

- form create dan edit di admin bila prosesnya sederhana
- interaksi CRUD yang harus terasa cepat tanpa pindah halaman
- refresh data setelah simpan/hapus tanpa `location.reload()`

#### Standar layanan / poli:

- gunakan slug otomatis dari nama layanan
- gunakan satu sumber data untuk layanan publik dan admin
- jika admin mengubah layanan, tampilan publik harus bisa mengikuti data terbaru dari database

## Gaya Coding

- gunakan gaya yang mudah dikenali dan mudah dibaca
- di area admin, gunakan jQuery style untuk interaksi UI
- pakai `$.ajax`, event binding jQuery, dan DOM manipulation yang sederhana
- jangan memaksa JavaScript modern jika jQuery sudah cukup
- tulis kode dengan pola yang konsisten antar modul

## Referensi Internal

Untuk pola jQuery, struktur interface admin, dan gaya implementasi yang familiar, gunakan acuan dari:

- `C:\laragon\www\pddikti`

Walaupun project ini memakai Laravel, referensi tersebut boleh dipakai selama tetap disesuaikan dengan pola Laravel yang rapi dan stabil.

## Aturan Praktis

- pisahkan area publik dan admin dengan jelas
- gunakan `.env` untuk konfigurasi yang berubah antar environment
- hindari hardcode jika bisa dikonfigurasi
- semua fitur harus aman dan nyaman dipakai di Linux Mint
- komponen yang sering berubah sebaiknya dibuat fleksibel

## Prioritas Keputusan

Saat ada beberapa pilihan, urutannya adalah:

1. benar secara fungsi
2. stabil di server Linux Mint
3. mudah dirawat
4. konsisten
5. estetik

## Kesimpulan

Project ini harus terasa profesional di mata pengunjung, sederhana untuk admin, dan aman untuk deployment Linux Mint tanpa meninggalkan kenyamanan development di Windows.
