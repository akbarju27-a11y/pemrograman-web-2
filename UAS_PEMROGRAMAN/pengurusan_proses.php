<?php
include 'config.php';

$id = intval($_GET['id']);
$q = mysqli_query($conn, "SELECT * FROM daftar_ulang WHERE id = $id");
$row = mysqli_fetch_assoc($q);

if (!$row) {
    header("Location: pengurusan.php");
    exit;
}

// Cegah proses ganda
$cek = mysqli_query($conn, "SELECT id FROM pengurusan WHERE daftar_ulang_id = $id");
if (mysqli_num_rows($cek) > 0) {
    header("Location: pengurusan.php");
    exit;
}

if ($row['ktp'] === 'Ada' && $row['kk'] === 'Ada' && $row['ijazah_akte'] === 'Ada') {
    $berkas     = 'Lengkap';
    $status     = 'Diterima';
    $keterangan = 'OK';
    $pembayaran = 355000;
} else {
    $berkas     = 'Tidak Lengkap';
    $status     = 'Ditolak';
    $keterangan = 'Tidak';
    $pembayaran = 0;
}

$stmt = mysqli_prepare($conn,
    "INSERT INTO pengurusan (daftar_ulang_id, no_antrian, no_daftar, nama_pemohon, berkas, status, keterangan, pembayaran)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
);
mysqli_stmt_bind_param($stmt, "iiissssi",
    $id, $row['no_antrian'], $row['no_daftar'], $row['nama_pemohon'], $berkas, $status, $keterangan, $pembayaran
);
mysqli_stmt_execute($stmt);

header("Location: pengurusan.php?msg=sukses");
exit;
?>
