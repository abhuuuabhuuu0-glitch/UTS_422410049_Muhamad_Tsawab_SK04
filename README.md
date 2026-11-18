# SK04 · Restorasi Pita Analog — Aplikasi Administrasi (Laravel 12 + MySQL)

Aplikasi administrasi untuk mengelola arsip pita analog (open reel, kaset, video analog, 8-track) beserta proses restorasinya.

## Fitur Utama
| Modul | CRUD | Pencarian & Filter | Pilihan jamak |
|---|---|---|---|
| Koleksi Pita (data utama) | ✅ | Judul/kode/lokasi, kategori, kondisi, urutan, **kerusakan** (live search, tanpa reload) | Kerusakan fisik (many-to-many) |
| Proyek Restorasi (data utama) | ✅ | Judul/kode, status, teknisi, rentang tanggal, **peralatan** | Peralatan (many-to-many) |
| Tahapan Restorasi (detail) | ✅ (bersarang, via modal) | — | — |
| Kategori Pita | ✅ | Nama | — |

Interaktif: pencarian langsung (AJAX), filter otomatis, chip pilihan jamak dengan penghitung, modal edit tahap, konfirmasi hapus, grafik Chart.js di dashboard, timeline tahapan, progress bar status, tema terang/gelap, jam langsung, toast notifikasi.

## Persyaratan
- PHP 8.2+ (ekstensi: pdo_mysql, mbstring, openssl, tokenizer, xml, ctype, json)
- Composer 2
- MySQL 8.0+ (atau MariaDB 10.6+)

## Instalasi
```bash
composer install
cp .env.example .env          # sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD
php artisan key:generate

# Pilihan A — impor SQL langsung (sudah berisi skema + data contoh)
mysql -u root -p < database/sql/sk04_restorasi_pita.sql

# Pilihan B — migrasi + seeder Laravel
php artisan migrate:fresh --seed

php artisan serve             # buka http://localhost:8000
```

## Struktur Utama
```
app/
  Models/            KategoriPita, Pita, Kerusakan, Teknisi, Peralatan, Restorasi, RestorasiDetail
  Services/          PitaService, RestorasiService, KategoriPitaService   (logika + transaksi DB)
  Http/Controllers/  Dashboard, KategoriPita, Pita, Restorasi, RestorasiDetail
  Http/Requests/     PitaRequest, RestorasiRequest, RestorasiDetailRequest, KategoriPitaRequest
database/
  migrations/        9 migration (skema & foreign key)
  seeders/           DatabaseSeeder + MasterData/Pita/Restorasi seeder (sumber: data/sk04_data.json)
  sql/               sk04_restorasi_pita.sql  (dump siap impor)
resources/views/     layouts, partials, components (x-stat-card, x-chip, x-status-badge, ...), modul per halaman
public/              css/app.css, js/app.js
docs/                class-diagram.png/.pdf, erd.png/.pdf, sumber .dot
routes/web.php       resource routes + route bersarang untuk detail restorasi
```

## Alur Kerja (untuk penjelasan)
1. **Request** masuk ke `routes/web.php` → diteruskan ke Controller resource.
2. **Validasi** dilakukan oleh Form Request (aturan `unique` dengan pengecualian saat ubah, `after_or_equal` untuk tanggal, `Rule::in` untuk enum). Controller hanya menerima data yang sudah tervalidasi.
3. **Logika bisnis** berada di Service dan dibungkus `DB::transaction`:
   - `PitaService::create/update` menyimpan pita dan men-`sync` kerusakan (pilihan jamak) secara atomik.
   - `RestorasiService::ubahStatus` menjadikan status *selesai* sekaligus mengubah kondisi pita menjadi *baik*; jika gagal di tengah, keduanya dibatalkan.
   - `RestorasiService::tambahDetail` otomatis mengubah status *menunggu* → *proses*.
   - Penghapusan pita ditolak jika masih ada restorasi aktif (validasi + `restrictOnDelete` di level DB).
4. **Pencarian & filter** memakai query scope Eloquent (`cari`, `filterKategori`, `filterKerusakan`, ...). Pilihan jamak difilter dengan `whereHas` + `whereIn`.
5. **Tampilan** dirender Blade dengan layout, partial, dan komponen anonim. Permintaan AJAX (`X-Requested-With`) hanya mengembalikan partial tabel dalam JSON, sehingga pencarian terasa instan.
6. **Relasi Eloquent**: KategoriPita 1–N Pita; Pita N–N Kerusakan; Pita 1–N Restorasi; Teknisi 0..1–N Restorasi; Restorasi 1–N RestorasiDetail; Restorasi N–N Peralatan.

## Catatan Akun Contoh
Data contoh pada `sk04_data.json` dan file SQL berasal dari sumber yang sama, sehingga keduanya konsisten.
