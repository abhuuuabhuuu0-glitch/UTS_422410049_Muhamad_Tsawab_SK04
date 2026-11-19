-- ============================================================
-- SK04 - Restorasi Pita Analog
-- Database MySQL 8.0+ (utf8mb4). Dibuat dari migration Laravel 12.
-- Impor: mysql -u root -p < database/sql/sk04_restorasi_pita.sql
-- ============================================================

CREATE DATABASE IF NOT EXISTS sk04_restorasi_pita CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sk04_restorasi_pita;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `pita_kerusakan`;
DROP TABLE IF EXISTS `restorasi_peralatan`;
DROP TABLE IF EXISTS `restorasi_detail`;
DROP TABLE IF EXISTS `restorasi`;
DROP TABLE IF EXISTS `pita`;
DROP TABLE IF EXISTS `kerusakan`;
DROP TABLE IF EXISTS `teknisi`;
DROP TABLE IF EXISTS `peralatan`;
DROP TABLE IF EXISTS `kategori_pita`;
DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `kategori_pita` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(120) NOT NULL,
  `deskripsi` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategori_pita_nama_unique` (`nama`),
  UNIQUE KEY `kategori_pita_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `kerusakan` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `deskripsi` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kerusakan_nama_unique` (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pita` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_arsip` VARCHAR(30) NOT NULL,
  `judul` VARCHAR(191) NOT NULL,
  `kategori_pita_id` BIGINT UNSIGNED NOT NULL,
  `tahun_rekaman` SMALLINT UNSIGNED NULL,
  `durasi_menit` SMALLINT UNSIGNED NULL,
  `kondisi` ENUM('baik','sedang','rusak_berat') NOT NULL DEFAULT 'sedang',
  `lokasi_simpan` VARCHAR(150) NULL,
  `deskripsi` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pita_kode_arsip_unique` (`kode_arsip`),
  KEY `pita_kategori_pita_id_kondisi_index` (`kategori_pita_id`,`kondisi`),
  KEY `pita_judul_index` (`judul`),
  CONSTRAINT `pita_kategori_pita_id_foreign` FOREIGN KEY (`kategori_pita_id`) REFERENCES `kategori_pita` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pita_kerusakan` (
  `pita_id` BIGINT UNSIGNED NOT NULL,
  `kerusakan_id` BIGINT UNSIGNED NOT NULL,
  PRIMARY KEY (`pita_id`,`kerusakan_id`),
  CONSTRAINT `pita_kerusakan_pita_id_foreign` FOREIGN KEY (`pita_id`) REFERENCES `pita` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pita_kerusakan_kerusakan_id_foreign` FOREIGN KEY (`kerusakan_id`) REFERENCES `kerusakan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `teknisi` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(120) NOT NULL,
  `keahlian` VARCHAR(150) NULL,
  `email` VARCHAR(150) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teknisi_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `peralatan` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(120) NOT NULL,
  `jenis` ENUM('pemutar','pembersih','digitasi','lainnya') NOT NULL DEFAULT 'lainnya',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `peralatan_nama_unique` (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `restorasi` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pita_id` BIGINT UNSIGNED NOT NULL,
  `teknisi_id` BIGINT UNSIGNED NULL,
  `tanggal_mulai` DATE NOT NULL,
  `tanggal_selesai` DATE NULL,
  `status` ENUM('menunggu','proses','selesai','dibatalkan') NOT NULL DEFAULT 'menunggu',
  `biaya` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `catatan` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restorasi_status_tanggal_mulai_index` (`status`,`tanggal_mulai`),
  CONSTRAINT `restorasi_pita_id_foreign` FOREIGN KEY (`pita_id`) REFERENCES `pita` (`id`) ON DELETE CASCADE,
  CONSTRAINT `restorasi_teknisi_id_foreign` FOREIGN KEY (`teknisi_id`) REFERENCES `teknisi` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `restorasi_detail` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `restorasi_id` BIGINT UNSIGNED NOT NULL,
  `tahap` ENUM('pembersihan','pemanggangan','digitasi','editing','verifikasi') NOT NULL,
  `tindakan` VARCHAR(191) NOT NULL,
  `tanggal` DATE NOT NULL,
  `durasi_menit` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `hasil` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `restorasi_detail_restorasi_id_foreign` FOREIGN KEY (`restorasi_id`) REFERENCES `restorasi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `restorasi_peralatan` (
  `restorasi_id` BIGINT UNSIGNED NOT NULL,
  `peralatan_id` BIGINT UNSIGNED NOT NULL,
  PRIMARY KEY (`restorasi_id`,`peralatan_id`),
  CONSTRAINT `restorasi_peralatan_restorasi_id_foreign` FOREIGN KEY (`restorasi_id`) REFERENCES `restorasi` (`id`) ON DELETE CASCADE,
  CONSTRAINT `restorasi_peralatan_peralatan_id_foreign` FOREIGN KEY (`peralatan_id`) REFERENCES `peralatan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------- DATA ----------------
INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES (1,'2026_01_01_000001_create_kategori_pita_table',1);
INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES (2,'2026_01_01_000002_create_kerusakan_table',1);
INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES (3,'2026_01_01_000003_create_pita_table',1);
INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES (4,'2026_01_01_000004_create_pita_kerusakan_table',1);
INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES (5,'2026_01_01_000005_create_teknisi_table',1);
INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES (6,'2026_01_01_000006_create_peralatan_table',1);
INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES (7,'2026_01_01_000007_create_restorasi_table',1);
INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES (8,'2026_01_01_000008_create_restorasi_detail_table',1);
INSERT INTO `migrations` (`id`,`migration`,`batch`) VALUES (9,'2026_01_01_000009_create_restorasi_peralatan_table',1);

INSERT INTO `kategori_pita` (`id`,`nama`,`slug`,`deskripsi`,`created_at`,`updated_at`) VALUES (1,'Open Reel','open-reel','Pita magnetik 1/4 inci pada reel terbuka (reel-to-reel).','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `kategori_pita` (`id`,`nama`,`slug`,`deskripsi`,`created_at`,`updated_at`) VALUES (2,'Kaset Kompakt','kaset-kompakt','Kaset audio kompakt (Compact Cassette) berbagai merek.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `kategori_pita` (`id`,`nama`,`slug`,`deskripsi`,`created_at`,`updated_at`) VALUES (3,'Video Analog','video-analog','Pita video analog format VHS, Betamax, dan U-matic.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `kategori_pita` (`id`,`nama`,`slug`,`deskripsi`,`created_at`,`updated_at`) VALUES (4,'Cartridge 8-Track','cartridge-8-track','Kartrid audio 8-track berloop tertutup.','2026-11-01 08:00:00','2026-11-01 08:00:00');

INSERT INTO `kerusakan` (`id`,`nama`,`deskripsi`,`created_at`,`updated_at`) VALUES (1,'Sticky Shed Syndrome','Lapisan pengikat menjadi lengket akibat hidrolisis.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `kerusakan` (`id`,`nama`,`deskripsi`,`created_at`,`updated_at`) VALUES (2,'Jamur (Fungus)','Pertumbuhan jamur pada permukaan pita karena kelembapan tinggi.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `kerusakan` (`id`,`nama`,`deskripsi`,`created_at`,`updated_at`) VALUES (3,'Pita Putus','Pita terputus di tengah atau pada sambungan.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `kerusakan` (`id`,`nama`,`deskripsi`,`created_at`,`updated_at`) VALUES (4,'Pita Kusut','Lipatan atau kusut yang merusak lapisan magnetik.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `kerusakan` (`id`,`nama`,`deskripsi`,`created_at`,`updated_at`) VALUES (5,'Penyusutan (Shrinkage)','Basis pita menyusut sehingga tegangan tidak merata.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `kerusakan` (`id`,`nama`,`deskripsi`,`created_at`,`updated_at`) VALUES (6,'Oksida Terkelupas','Lapisan magnetik mengelupas dari basis pita.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `kerusakan` (`id`,`nama`,`deskripsi`,`created_at`,`updated_at`) VALUES (7,'Sambungan Rusak (Splice)','Sambungan lama rapuh atau tidak rapi.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `kerusakan` (`id`,`nama`,`deskripsi`,`created_at`,`updated_at`) VALUES (8,'Tepi Pita Rusak','Tepi pita sobek, bergelombang, atau aus.','2026-11-01 08:00:00','2026-11-01 08:00:00');

INSERT INTO `teknisi` (`id`,`nama`,`keahlian`,`email`,`created_at`,`updated_at`) VALUES (1,'Rina Wulandari','Audio Engineer & Restorasi Audio','rina.wulandari@arsip.example','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `teknisi` (`id`,`nama`,`keahlian`,`email`,`created_at`,`updated_at`) VALUES (2,'Dimas Prasetyo','Konservasi Media Magnetik','dimas.prasetyo@arsip.example','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `teknisi` (`id`,`nama`,`keahlian`,`email`,`created_at`,`updated_at`) VALUES (3,'Ayu Lestari','Restorasi Video Analog','ayu.lestari@arsip.example','2026-11-01 08:00:00','2026-11-01 08:00:00');

INSERT INTO `peralatan` (`id`,`nama`,`jenis`,`created_at`,`updated_at`) VALUES (1,'Tape Deck Revox B77','pemutar','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `peralatan` (`id`,`nama`,`jenis`,`created_at`,`updated_at`) VALUES (2,'VCR U-matic Pemutar','pemutar','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `peralatan` (`id`,`nama`,`jenis`,`created_at`,`updated_at`) VALUES (3,'Ultrasonic Cleaner','pembersih','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `peralatan` (`id`,`nama`,`jenis`,`created_at`,`updated_at`) VALUES (4,'Head Cleaner & Demagnetizer','pembersih','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `peralatan` (`id`,`nama`,`jenis`,`created_at`,`updated_at`) VALUES (5,'Inkubator Pemanggangan (Baking Oven)','lainnya','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `peralatan` (`id`,`nama`,`jenis`,`created_at`,`updated_at`) VALUES (6,'ADC Audio RME Digiface','digitasi','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `peralatan` (`id`,`nama`,`jenis`,`created_at`,`updated_at`) VALUES (7,'Workstation Audio Digital (DAW)','digitasi','2026-11-01 08:00:00','2026-11-01 08:00:00');

INSERT INTO `pita` (`id`,`kode_arsip`,`judul`,`kategori_pita_id`,`tahun_rekaman`,`durasi_menit`,`kondisi`,`lokasi_simpan`,`deskripsi`,`created_at`,`updated_at`) VALUES (1,'PA-OR-0001','Rekaman Gamelan Bali Upacara Galungan',1,1978,46,'rusak_berat','Rak A-01','Rekaman lapangan gamelan, pita sudah mengalami sticky shed.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `pita` (`id`,`kode_arsip`,`judul`,`kategori_pita_id`,`tahun_rekaman`,`durasi_menit`,`kondisi`,`lokasi_simpan`,`deskripsi`,`created_at`,`updated_at`) VALUES (2,'PA-OR-0002','Wawancara Sejarah Lisan Pejuang Kemerdekaan',1,1982,72,'sedang','Rak A-02','Wawancara sejarah lisan, beberapa sambungan lama.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `pita` (`id`,`kode_arsip`,`judul`,`kategori_pita_id`,`tahun_rekaman`,`durasi_menit`,`kondisi`,`lokasi_simpan`,`deskripsi`,`created_at`,`updated_at`) VALUES (3,'PA-OR-0003','Siaran Radio Musik Keroncong 1985',1,1985,58,'sedang','Rak A-02','Siaran radio arsip dengan tepi pita aus.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `pita` (`id`,`kode_arsip`,`judul`,`kategori_pita_id`,`tahun_rekaman`,`durasi_menit`,`kondisi`,`lokasi_simpan`,`deskripsi`,`created_at`,`updated_at`) VALUES (4,'PA-KK-0004','Kaset Lagu Daerah Jawa Tengah',2,1990,60,'sedang','Lemari K-03','Kaset produksi lokal, lapisan oksida mulai terkelupas.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `pita` (`id`,`kode_arsip`,`judul`,`kategori_pita_id`,`tahun_rekaman`,`durasi_menit`,`kondisi`,`lokasi_simpan`,`deskripsi`,`created_at`,`updated_at`) VALUES (5,'PA-KK-0005','Pidato Kenegaraan Kaset Compact',2,1994,90,'baik','Lemari K-03','Kondisi relatif baik, hanya perlu digitasi ulang.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `pita` (`id`,`kode_arsip`,`judul`,`kategori_pita_id`,`tahun_rekaman`,`durasi_menit`,`kondisi`,`lokasi_simpan`,`deskripsi`,`created_at`,`updated_at`) VALUES (6,'PA-VA-0006','Dokumentasi Festival Budaya Nusantara',3,1989,120,'rusak_berat','Rak V-01','Format VHS, pita kusut dan jamur di beberapa bagian.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `pita` (`id`,`kode_arsip`,`judul`,`kategori_pita_id`,`tahun_rekaman`,`durasi_menit`,`kondisi`,`lokasi_simpan`,`deskripsi`,`created_at`,`updated_at`) VALUES (7,'PA-VA-0007','Liputan Berita Televisi Lokal 1996',3,1996,45,'sedang','Rak V-02','Format Betamax, sedikit penyusutan basis.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `pita` (`id`,`kode_arsip`,`judul`,`kategori_pita_id`,`tahun_rekaman`,`durasi_menit`,`kondisi`,`lokasi_simpan`,`deskripsi`,`created_at`,`updated_at`) VALUES (8,'PA-8T-0008','Kompilasi Musik Pop Era 70-an',4,1975,40,'sedang','Lemari C-01','Kartrid 8-track dengan loop yang mulai aus.','2026-11-01 08:00:00','2026-11-01 08:00:00');

INSERT INTO `pita_kerusakan` (`pita_id`,`kerusakan_id`) VALUES (1,1);
INSERT INTO `pita_kerusakan` (`pita_id`,`kerusakan_id`) VALUES (1,2);
INSERT INTO `pita_kerusakan` (`pita_id`,`kerusakan_id`) VALUES (2,7);
INSERT INTO `pita_kerusakan` (`pita_id`,`kerusakan_id`) VALUES (3,8);
INSERT INTO `pita_kerusakan` (`pita_id`,`kerusakan_id`) VALUES (3,5);
INSERT INTO `pita_kerusakan` (`pita_id`,`kerusakan_id`) VALUES (4,6);
INSERT INTO `pita_kerusakan` (`pita_id`,`kerusakan_id`) VALUES (6,4);
INSERT INTO `pita_kerusakan` (`pita_id`,`kerusakan_id`) VALUES (6,2);
INSERT INTO `pita_kerusakan` (`pita_id`,`kerusakan_id`) VALUES (6,3);
INSERT INTO `pita_kerusakan` (`pita_id`,`kerusakan_id`) VALUES (7,5);
INSERT INTO `pita_kerusakan` (`pita_id`,`kerusakan_id`) VALUES (8,7);
INSERT INTO `pita_kerusakan` (`pita_id`,`kerusakan_id`) VALUES (8,6);

INSERT INTO `restorasi` (`id`,`pita_id`,`teknisi_id`,`tanggal_mulai`,`tanggal_selesai`,`status`,`biaya`,`catatan`,`created_at`,`updated_at`) VALUES (1,1,2,'2026-09-01',NULL,'proses',1850000.00,'Prioritas tinggi, lakukan baking dengan suhu terkontrol.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi_detail` (`id`,`restorasi_id`,`tahap`,`tindakan`,`tanggal`,`durasi_menit`,`hasil`,`created_at`,`updated_at`) VALUES (1,1,'pemanggangan','Baking 52 derajat selama 8 jam','2026-09-02',480,'Lapisan lengket berkurang, pita bisa berputar.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi_detail` (`id`,`restorasi_id`,`tahap`,`tindakan`,`tanggal`,`durasi_menit`,`hasil`,`created_at`,`updated_at`) VALUES (2,1,'pembersihan','Pembersihan permukaan dengan alkohol isopropil','2026-09-04',120,'Jamur berhasil diangkat dari sebagian besar pita.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi_detail` (`id`,`restorasi_id`,`tahap`,`tindakan`,`tanggal`,`durasi_menit`,`hasil`,`created_at`,`updated_at`) VALUES (3,1,'digitasi','Digitasi 24-bit/96kHz','2026-09-08',210,'Berkas WAV master tersimpan.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi` (`id`,`pita_id`,`teknisi_id`,`tanggal_mulai`,`tanggal_selesai`,`status`,`biaya`,`catatan`,`created_at`,`updated_at`) VALUES (2,2,1,'2026-08-10','2026-08-25','selesai',950000.00,'Penyambungan ulang sambungan lama.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi_detail` (`id`,`restorasi_id`,`tahap`,`tindakan`,`tanggal`,`durasi_menit`,`hasil`,`created_at`,`updated_at`) VALUES (4,2,'pembersihan','Pembersihan kepala baca dan pita','2026-08-11',60,'Kepala baca bersih.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi_detail` (`id`,`restorasi_id`,`tahap`,`tindakan`,`tanggal`,`durasi_menit`,`hasil`,`created_at`,`updated_at`) VALUES (5,2,'digitasi','Digitasi dan penyambungan ulang tiga sambungan','2026-08-14',180,'Sambungan rapi, tidak ada drop-out.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi_detail` (`id`,`restorasi_id`,`tahap`,`tindakan`,`tanggal`,`durasi_menit`,`hasil`,`created_at`,`updated_at`) VALUES (6,2,'editing','Normalisasi dan reduksi noise ringan','2026-08-20',150,'Noise latar turun tanpa merusak suara wawancara.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi_detail` (`id`,`restorasi_id`,`tahap`,`tindakan`,`tanggal`,`durasi_menit`,`hasil`,`created_at`,`updated_at`) VALUES (7,2,'verifikasi','Verifikasi checksum dan pendengaran ulang','2026-08-25',45,'Lolos verifikasi.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi` (`id`,`pita_id`,`teknisi_id`,`tanggal_mulai`,`tanggal_selesai`,`status`,`biaya`,`catatan`,`created_at`,`updated_at`) VALUES (3,6,3,'2026-10-05',NULL,'menunggu',3200000.00,'Menunggu jadwal alat U-matic.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi` (`id`,`pita_id`,`teknisi_id`,`tanggal_mulai`,`tanggal_selesai`,`status`,`biaya`,`catatan`,`created_at`,`updated_at`) VALUES (4,4,1,'2026-07-01','2026-07-09','selesai',275000.00,'Pembersihan dan digitasi standar.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi_detail` (`id`,`restorasi_id`,`tahap`,`tindakan`,`tanggal`,`durasi_menit`,`hasil`,`created_at`,`updated_at`) VALUES (8,4,'pembersihan','Pembersihan kepala dan demagnetisasi','2026-07-02',40,'Noise dengung berkurang.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi_detail` (`id`,`restorasi_id`,`tahap`,`tindakan`,`tanggal`,`durasi_menit`,`hasil`,`created_at`,`updated_at`) VALUES (9,4,'digitasi','Digitasi 24-bit/48kHz','2026-07-07',75,'Berkas master tersimpan.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi` (`id`,`pita_id`,`teknisi_id`,`tanggal_mulai`,`tanggal_selesai`,`status`,`biaya`,`catatan`,`created_at`,`updated_at`) VALUES (5,8,2,'2026-11-03',NULL,'proses',540000.00,'Loop harus disambung ulang secara manual.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi_detail` (`id`,`restorasi_id`,`tahap`,`tindakan`,`tanggal`,`durasi_menit`,`hasil`,`created_at`,`updated_at`) VALUES (10,5,'pembersihan','Ultrasonic cleaning kartrid','2026-11-04',90,'Permukaan bersih, tidak ada debu tersisa.','2026-11-01 08:00:00','2026-11-01 08:00:00');
INSERT INTO `restorasi` (`id`,`pita_id`,`teknisi_id`,`tanggal_mulai`,`tanggal_selesai`,`status`,`biaya`,`catatan`,`created_at`,`updated_at`) VALUES (6,3,NULL,'2026-11-10',NULL,'dibatalkan',0.00,'Dibatalkan atas permintaan peminjam.','2026-11-01 08:00:00','2026-11-01 08:00:00');

INSERT INTO `restorasi_peralatan` (`restorasi_id`,`peralatan_id`) VALUES (1,5);
INSERT INTO `restorasi_peralatan` (`restorasi_id`,`peralatan_id`) VALUES (1,3);
INSERT INTO `restorasi_peralatan` (`restorasi_id`,`peralatan_id`) VALUES (1,6);
INSERT INTO `restorasi_peralatan` (`restorasi_id`,`peralatan_id`) VALUES (2,1);
INSERT INTO `restorasi_peralatan` (`restorasi_id`,`peralatan_id`) VALUES (2,6);
INSERT INTO `restorasi_peralatan` (`restorasi_id`,`peralatan_id`) VALUES (2,7);
INSERT INTO `restorasi_peralatan` (`restorasi_id`,`peralatan_id`) VALUES (3,2);
INSERT INTO `restorasi_peralatan` (`restorasi_id`,`peralatan_id`) VALUES (3,4);
INSERT INTO `restorasi_peralatan` (`restorasi_id`,`peralatan_id`) VALUES (4,4);
INSERT INTO `restorasi_peralatan` (`restorasi_id`,`peralatan_id`) VALUES (4,6);
INSERT INTO `restorasi_peralatan` (`restorasi_id`,`peralatan_id`) VALUES (5,1);
INSERT INTO `restorasi_peralatan` (`restorasi_id`,`peralatan_id`) VALUES (5,3);

SET FOREIGN_KEY_CHECKS = 1;
