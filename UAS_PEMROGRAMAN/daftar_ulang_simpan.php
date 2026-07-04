<?php
include 'config.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_daftar  = intval($_POST['no_daftar']);
    $keperluan  = mysqli_real_escape_string($conn, $_POST['keperluan']);
    $tgl_datang = $_POST['tgl_datang'];
    $ktp        = $_POST['ktp'];
    $kk         = $_POST['kk'];
    $ijazah     = $_POST['ijazah_akte'];
    $hari_datang = nama_hari($tgl_datang);

    // Ambil data jadwal asli dari pendaftar
    $q = mysqli_query($conn, "SELECT * FROM pendaftar WHERE no_daftar = $no_daftar");
    $pendaftar = mysqli_fetch_assoc($q);

    if (!$pendaftar) {
        header("Location: daftar_ulang.php?msg=error");
        exit;
    }
    $nama_pemohon = $pendaftar['nama_pemohon'];

    // Cek kesesuaian hari & tanggal datang dengan jadwal pendaftaran
    if ($hari_datang === $pendaftar['hari'] && $tgl_datang === $pendaftar['tanggal']) {
        $keterangan = 'OK';

        // Hitung nomor antrian otomatis (per tanggal kedatangan)
        $qa = mysqli_query($conn, "SELECT MAX(no_antrian) AS maxa FROM daftar_ulang WHERE tgl_datang = '$tgl_datang'");
        $ra = mysqli_fetch_assoc($qa);
        $no_antrian = ($ra['maxa'] !== null ? (int)$ra['maxa'] : 0) + 1;
    } else {
        $keterangan = 'Tidak';
        $no_antrian = null;
    }

    $stmt = mysqli_prepare($conn,
        "INSERT INTO daftar_ulang (no_daftar, nama_pemohon, keperluan, hari_datang, tgl_datang, ktp, kk, ijazah_akte, keterangan, no_antrian)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );
    mysqli_stmt_bind_param($stmt, "issssssssi",
        $no_daftar, $nama_pemohon, $keperluan, $hari_datang, $tgl_datang, $ktp, $kk, $ijazah, $keterangan, $no_antrian
    );
    mysqli_stmt_execute($stmt);

    header("Location: daftar_ulang.php?msg=sukses");
    exit;
}

header("Location: daftar_ulang.php");
exit;
?>
