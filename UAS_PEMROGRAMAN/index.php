<?php include 'config.php'; include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pengajuan Paspor - Kantor Imigrasi Cabang</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
    <h1>Pengajuan Paspor</h1>
    <p>Kantor Imigrasi Cabang</p>
</div>
<div class="navbar">
    <a href="index.php" class="active">Beranda</a>
    <a href="daftar.php">Daftar</a>
    <a href="daftar_ulang.php">Daftar Ulang</a>
    <a href="pengurusan.php">Pengurusan</a>
</div>
<div class="container">
    <?php
    $r1 = mysqli_query($conn, "SELECT COUNT(*) c FROM pendaftar");
    $totalDaftar = mysqli_fetch_assoc($r1)['c'];

    $r2 = mysqli_query($conn, "SELECT COUNT(*) c FROM daftar_ulang WHERE keterangan='OK'");
    $totalAntrian = mysqli_fetch_assoc($r2)['c'];

    $r3 = mysqli_query($conn, "SELECT IFNULL(SUM(pembayaran),0) t FROM pengurusan WHERE status='Diterima'");
    $totalPendapatan = mysqli_fetch_assoc($r3)['t'];
    ?>
    <div class="stat-row">
        <div class="stat-box">
            <div class="value"><?= $totalDaftar ?></div>
            <div class="label">Total Pendaftar</div>
        </div>
        <div class="stat-box">
            <div class="value"><?= $totalAntrian ?></div>
            <div class="label">Total Nomor Antrian (OK)</div>
        </div>
        <div class="stat-box">
            <div class="value"><?= format_rupiah($totalPendapatan) ?></div>
            <div class="label">Total Pendapatan</div>
        </div>
    </div>

    <div class="card">
        <h2>Alur Penggunaan Aplikasi</h2>
        <ol style="font-size:14px; line-height:1.9; color:#334155;">
            <li><b>Daftar</b> — pemohon input data diri. Sistem otomatis menghitung hari, tanggal, dan jam kedatangan (kapasitas 5 orang/hari, jika penuh maju ke hari berikutnya).</li>
            <li><b>Daftar Ulang</b> — verifikasi kelengkapan berkas (KTP/KK/Ijazah) dan kesesuaian jadwal kedatangan. Jika sesuai jadwal → keterangan "OK" dan mendapat nomor antrian otomatis.</li>
            <li><b>Pengurusan Berkas</b> — proses akhir. Jika KTP, KK, dan Ijazah/Akte lengkap semua → status "Diterima", pembayaran Rp 355.000.</li>
        </ol>
    </div>
</div>
</body>
</html>
