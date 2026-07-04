<?php
include 'config.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pemohon = mysqli_real_escape_string($conn, trim($_POST['nama_pemohon']));
    $tgl_daftar   = date('Y-m-d');

    if ($nama_pemohon === '') {
        header("Location: daftar.php?msg=error");
        exit;
    }

    $jadwal = assign_jadwal($conn, $tgl_daftar);

    $stmt = mysqli_prepare($conn,
        "INSERT INTO pendaftar (nama_pemohon, tgl_daftar, hari, tanggal, jam) VALUES (?, ?, ?, ?, ?)"
    );
    mysqli_stmt_bind_param($stmt, "sssss",
        $nama_pemohon, $tgl_daftar, $jadwal['hari'], $jadwal['tanggal'], $jadwal['jam']
    );
    mysqli_stmt_execute($stmt);

    header("Location: daftar.php?msg=sukses");
    exit;
}

header("Location: daftar.php");
exit;
?>
