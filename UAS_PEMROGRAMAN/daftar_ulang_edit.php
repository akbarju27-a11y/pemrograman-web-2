<?php
include 'config.php';
include 'functions.php';

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM daftar_ulang WHERE id = $id");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    header("Location: daftar_ulang.php");
    exit;
}

function sel($a, $b) { return $a === $b ? 'selected' : ''; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Daftar Ulang</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
    <h1>Pengajuan Paspor</h1>
    <p>Kantor Imigrasi Cabang</p>
</div>
<div class="navbar">
    <a href="index.php">Beranda</a>
    <a href="daftar.php">Daftar</a>
    <a href="daftar_ulang.php" class="active">Daftar Ulang</a>
    <a href="pengurusan.php">Pengurusan</a>
</div>
<div class="container">
    <div class="card">
        <h2>Edit Data Daftar Ulang #<?= $row['id'] ?></h2>
        <form action="daftar_ulang_update.php" method="POST">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="hidden" name="no_daftar" value="<?= $row['no_daftar'] ?>">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Pemohon</label>
                    <input type="text" value="<?= htmlspecialchars($row['nama_pemohon']) ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Keperluan</label>
                    <select name="keperluan">
                        <option <?= sel($row['keperluan'],'Paspor Baru') ?>>Paspor Baru</option>
                        <option <?= sel($row['keperluan'],'Perpanjangan') ?>>Perpanjangan</option>
                        <option <?= sel($row['keperluan'],'Penggantian Hilang/Rusak') ?>>Penggantian Hilang/Rusak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal Datang</label>
                    <input type="date" name="tgl_datang" value="<?= $row['tgl_datang'] ?>" required>
                </div>
                <div class="form-group">
                    <label>KTP</label>
                    <select name="ktp">
                        <option <?= sel($row['ktp'],'Ada') ?>>Ada</option>
                        <option <?= sel($row['ktp'],'Tidak') ?>>Tidak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>KK</label>
                    <select name="kk">
                        <option <?= sel($row['kk'],'Ada') ?>>Ada</option>
                        <option <?= sel($row['kk'],'Tidak') ?>>Tidak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ijazah/Akte</label>
                    <select name="ijazah_akte">
                        <option <?= sel($row['ijazah_akte'],'Ada') ?>>Ada</option>
                        <option <?= sel($row['ijazah_akte'],'Tidak') ?>>Tidak</option>
                    </select>
                </div>
            </div>
            <p style="font-size:12.5px;color:#64748b;">
                Keterangan dan nomor antrian akan dihitung ulang otomatis berdasarkan tanggal datang yang baru.
            </p>
            <button type="submit" class="btn">Update</button>
            <a href="daftar_ulang.php" class="btn" style="background:#64748b;">Batal</a>
        </form>
    </div>
</div>
</body>
</html>
