<?php
include 'config.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id         = intval($_POST['id']);
    $no_daftar  = intval($_POST['no_daftar']);
    $keperluan  = mysqli_real_escape_string($conn, $_POST['keperluan']);
    $tgl_datang = $_POST['tgl_datang'];
    $ktp        = $_POST['ktp'];
    $kk         = $_POST['kk'];
    $ijazah     = $_POST['ijazah_akte'];
    $hari_datang = nama_hari($tgl_datang);

    $q = mysqli_query($conn, "SELECT * FROM pendaftar WHERE no_daftar = $no_daftar");
    $pendaftar = mysqli_fetch_assoc($q);

    if ($hari_datang === $pendaftar['hari'] && $tgl_datang === $pendaftar['tanggal']) {
        $keterangan = 'OK';
        // pertahankan no_antrian lama jika sudah ada, jika belum baru dihitung
        $qc = mysqli_query($conn, "SELECT no_antrian FROM daftar_ulang WHERE id = $id");
        $current = mysqli_fetch_assoc($qc);
        if ($current['no_antrian']) {
            $no_antrian = $current['no_antrian'];
        } else {
            $qa = mysqli_query($conn, "SELECT MAX(no_antrian) AS maxa FROM daftar_ulang WHERE tgl_datang = '$tgl_datang'");
            $ra = mysqli_fetch_assoc($qa);
            $no_antrian = ($ra['maxa'] !== null ? (int)$ra['maxa'] : 0) + 1;
        }
    } else {
        $keterangan = 'Tidak';
        $no_antrian = null;
    }

    $stmt = mysqli_prepare($conn,
        "UPDATE daftar_ulang SET keperluan=?, hari_datang=?, tgl_datang=?, ktp=?, kk=?, ijazah_akte=?, keterangan=?, no_antrian=? WHERE id=?"
    );
    mysqli_stmt_bind_param($stmt, "sssssssii",
        $keperluan, $hari_datang, $tgl_datang, $ktp, $kk, $ijazah, $keterangan, $no_antrian, $id
    );
    mysqli_stmt_execute($stmt);

    header("Location: daftar_ulang.php?msg=update");
    exit;
}

header("Location: daftar_ulang.php");
exit;
?>
