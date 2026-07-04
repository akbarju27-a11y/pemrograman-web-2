<?php
include 'config.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_daftar    = intval($_POST['no_daftar']);
    $nama_pemohon = mysqli_real_escape_string($conn, trim($_POST['nama_pemohon']));
    $tgl_daftar   = $_POST['tgl_daftar'];
    $tanggal      = $_POST['tanggal'];
    $hari         = nama_hari($tanggal); // pastikan konsisten dengan tanggal
    $jam          = $_POST['jam'] . ':00';

    $stmt = mysqli_prepare($conn,
        "UPDATE pendaftar SET nama_pemohon=?, tgl_daftar=?, hari=?, tanggal=?, jam=? WHERE no_daftar=?"
    );
    mysqli_stmt_bind_param($stmt, "sssssi",
        $nama_pemohon, $tgl_daftar, $hari, $tanggal, $jam, $no_daftar
    );
    mysqli_stmt_execute($stmt);

    header("Location: daftar.php?msg=update");
    exit;
}

header("Location: daftar.php");
exit;
?>
