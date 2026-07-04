=====================================================
APLIKASI PENGAJUAN PASPOR - KANTOR IMIGRASI CABANG
PHP Native + MySQL
=====================================================

CARA MENJALANKAN (menggunakan XAMPP/Laragon):
1. Pastikan sudah terinstall XAMPP/Laragon (Apache + MySQL/MariaDB + PHP).
2. Copy folder "paspor_app" ke dalam folder htdocs (XAMPP) atau www (Laragon).
3. Jalankan Apache dan MySQL dari control panel XAMPP/Laragon.
4. Buka phpMyAdmin (http://localhost/phpmyadmin), lalu import file "database.sql".
   (File ini otomatis membuat database "paspor_db" beserta data dummy)
5. Buka browser, akses: http://localhost/paspor_app/index.php
6. Selesai! Aplikasi siap digunakan.

Jika username/password MySQL Anda berbeda dari default (root, tanpa password),
sesuaikan di file config.php.

=====================================================
STRUKTUR FILE
=====================================================
- config.php              -> koneksi database
- functions.php           -> fungsi bantu (nama hari, kalkulasi jadwal, format)
- style.css               -> tampilan/CSS
- database.sql            -> struktur tabel + data dummy

- index.php                -> dashboard/beranda

MODUL 1 - DAFTAR:
- daftar.php               -> form input + tabel data pendaftar
- daftar_simpan.php        -> proses simpan (hitung jadwal otomatis)
- daftar_edit.php          -> form edit
- daftar_update.php        -> proses update
- daftar_hapus.php         -> proses hapus

MODUL 2 - DAFTAR ULANG:
- daftar_ulang.php         -> form input + tabel data daftar ulang
- daftar_ulang_simpan.php  -> proses simpan (cek kesesuaian jadwal + no antrian)
- daftar_ulang_edit.php    -> form edit
- daftar_ulang_update.php  -> proses update
- daftar_ulang_hapus.php   -> proses hapus

MODUL 3 - PENGURUSAN BERKAS:
- pengurusan.php           -> tabel antrian + hasil pengurusan + total pendapatan
- pengurusan_proses.php    -> proses cek kelengkapan berkas & hitung pembayaran

=====================================================
LOGIKA BISNIS UTAMA
=====================================================

1. INPUT DAFTAR
   - User hanya mengisi Nama Pemohon.
   - Sistem otomatis menentukan Hari, Tanggal, dan Jam kedatangan (mulai H+1 dari
     tanggal daftar).
   - Kapasitas per hari maksimal 5 orang (5 slot jam: 08:00, 09:30, 11:00, 13:00, 14:30).
   - Jika 1 hari sudah terisi 5 orang, sistem otomatis maju mencari hari berikutnya
     yang masih tersedia slot.

2. INPUT DAFTAR ULANG
   - Pilih No. Daftar, isi Keperluan, status KTP/KK/Ijazah-Akte (Ada/Tidak),
     dan Tanggal Datang aktual.
   - Sistem membandingkan Hari & Tanggal Datang dengan jadwal asli di tabel Daftar.
   - Jika SESUAI -> Keterangan = "OK" dan mendapat No. Antrian otomatis (increment
     per tanggal kedatangan).
   - Jika TIDAK SESUAI -> Keterangan = "Tidak", tanpa No. Antrian.

3. PENGURUSAN BERKAS
   - Hanya menampilkan pemohon dengan Keterangan "OK" dari Daftar Ulang yang belum
     diproses.
   - Klik "Proses Berkas":
     * Jika KTP, KK, dan Ijazah/Akte semuanya "Ada" -> Berkas = "Lengkap",
       Status = "Diterima", Keterangan = "OK", Pembayaran = Rp 355.000.
     * Jika salah satu tidak ada -> Berkas = "Tidak Lengkap", Status = "Ditolak",
       Keterangan = "Tidak", Pembayaran = Rp 0.
   - Total "Pendapatan" = jumlah semua pembayaran dengan status "Diterima".

=====================================================
DATA DUMMY YANG SUDAH TERSEDIA
=====================================================
- 7 data pendaftar (5 orang jadwal Senin 6 Juli 2026 -> penuh, 2 orang lempar ke
  Selasa 7 Juli 2026) -> membuktikan logika kapasitas 5 orang/hari berjalan.
- 4 data daftar ulang (3 "OK" dengan no antrian, 1 "Tidak" karena beda jadwal).
- 2 data pengurusan (1 "Diterima" dengan pembayaran, 1 "Ditolak" karena berkas
  tidak lengkap).
