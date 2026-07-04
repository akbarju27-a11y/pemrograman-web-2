-- ============================================
-- DATABASE: paspor_db
-- Aplikasi Pengajuan Paspor - Kantor Imigrasi Cabang
-- ============================================

CREATE DATABASE IF NOT EXISTS paspor_db;
USE paspor_db;

-- ============================================
-- TABEL 1: pendaftar (Input Daftar)
-- ============================================
CREATE TABLE pendaftar (
    no_daftar INT AUTO_INCREMENT PRIMARY KEY,
    nama_pemohon VARCHAR(100) NOT NULL,
    tgl_daftar DATE NOT NULL,      -- tanggal saat mendaftar
    hari VARCHAR(20) NOT NULL,     -- hari harus datang (hasil kalkulasi otomatis)
    tanggal DATE NOT NULL,         -- tanggal harus datang (hasil kalkulasi otomatis)
    jam TIME NOT NULL,             -- jam harus datang (hasil kalkulasi otomatis)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- TABEL 2: daftar_ulang (Input Data Daftar Ulang)
-- ============================================
CREATE TABLE daftar_ulang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_daftar INT NOT NULL,
    nama_pemohon VARCHAR(100) NOT NULL,
    keperluan VARCHAR(100) NOT NULL,
    hari_datang VARCHAR(20) NOT NULL,
    tgl_datang DATE NOT NULL,
    ktp ENUM('Ada','Tidak') NOT NULL DEFAULT 'Tidak',
    kk ENUM('Ada','Tidak') NOT NULL DEFAULT 'Tidak',
    ijazah_akte ENUM('Ada','Tidak') NOT NULL DEFAULT 'Tidak',
    keterangan ENUM('OK','Tidak') NOT NULL,
    no_antrian INT NULL,           -- otomatis terisi jika keterangan = OK
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (no_daftar) REFERENCES pendaftar(no_daftar) ON DELETE CASCADE
);

-- ============================================
-- TABEL 3: pengurusan (Pengurusan Berkas)
-- ============================================
CREATE TABLE pengurusan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    daftar_ulang_id INT NOT NULL,
    no_antrian INT NOT NULL,
    no_daftar INT NOT NULL,
    nama_pemohon VARCHAR(100) NOT NULL,
    berkas VARCHAR(20) NOT NULL,      -- Lengkap / Tidak Lengkap
    status VARCHAR(20) NOT NULL,      -- Diterima / Ditolak
    keterangan VARCHAR(10) NOT NULL,  -- OK / Tidak
    pembayaran INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (daftar_ulang_id) REFERENCES daftar_ulang(id) ON DELETE CASCADE
);

-- ============================================
-- DUMMY DATA
-- ============================================

-- Pendaftar (5 orang di hari yang sama -> kapasitas penuh, 1 orang lempar ke hari berikutnya)
INSERT INTO pendaftar (nama_pemohon, tgl_daftar, hari, tanggal, jam) VALUES
('Ahmad Fauzi', '2026-07-01', 'Senin', '2026-07-06', '08:00:00'),
('Siti Nurhaliza', '2026-07-01', 'Senin', '2026-07-06', '09:30:00'),
('Budi Santoso', '2026-07-01', 'Senin', '2026-07-06', '11:00:00'),
('Dewi Lestari', '2026-07-01', 'Senin', '2026-07-06', '13:00:00'),
('Rian Hidayat', '2026-07-01', 'Senin', '2026-07-06', '14:30:00'),
('Putri Ayu', '2026-07-01', 'Selasa', '2026-07-07', '08:00:00'),
('Joko Prasetyo', '2026-07-02', 'Selasa', '2026-07-07', '09:30:00');

-- Daftar Ulang (beberapa OK -> dapat no antrian, sebagian tidak sesuai jadwal)
INSERT INTO daftar_ulang (no_daftar, nama_pemohon, keperluan, hari_datang, tgl_datang, ktp, kk, ijazah_akte, keterangan, no_antrian) VALUES
(1, 'Ahmad Fauzi', 'Paspor Baru', 'Senin', '2026-07-06', 'Ada', 'Ada', 'Ada', 'OK', 1),
(2, 'Siti Nurhaliza', 'Paspor Baru', 'Senin', '2026-07-06', 'Ada', 'Ada', 'Tidak', 'OK', 2),
(3, 'Budi Santoso', 'Perpanjangan', 'Selasa', '2026-07-07', 'Ada', 'Ada', 'Ada', 'Tidak', NULL),
(4, 'Dewi Lestari', 'Paspor Baru', 'Senin', '2026-07-06', 'Tidak', 'Ada', 'Ada', 'OK', 3);

-- Pengurusan Berkas (hasil proses dari daftar_ulang yang keterangan-nya OK)
INSERT INTO pengurusan (daftar_ulang_id, no_antrian, no_daftar, nama_pemohon, berkas, status, keterangan, pembayaran) VALUES
(1, 1, 1, 'Ahmad Fauzi', 'Lengkap', 'Diterima', 'OK', 355000),
(2, 2, 2, 'Siti Nurhaliza', 'Tidak Lengkap', 'Ditolak', 'Tidak', 0);
