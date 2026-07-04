<?php
include 'config.php';
include 'functions.php';

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM pendaftar WHERE no_daftar = $id");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    header("Location: daftar.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Pendaftar</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
    <h1>Pengajuan Paspor</h1>
    <p>Kantor Imigrasi Cabang</p>
</div>
<div class="navbar">
    <a href="index.php">Beranda</a>
    <a href="daftar.php" class="active">Daftar</a>
    <a href="daftar_ulang.php">Daftar Ulang</a>
    <a href="pengurusan.php">Pengurusan</a>
</div>
<div class="container">
    <div class="card">
        <h2>Edit Data Pendaftar #<?= $row['no_daftar'] ?></h2>
        <form action="daftar_update.php" method="POST">
            <input type="hidden" name="no_daftar" value="<?= $row['no_daftar'] ?>">
            <div class="form-grid">
                <div class="form-group full">
                    <label>Nama Pemohon</label>
                    <input type="text" name="nama_pemohon" value="<?= htmlspecialchars($row['nama_pemohon']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Daftar</label>
                    <input type="date" name="tgl_daftar" value="<?= $row['tgl_daftar'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Kedatangan</label>
                    <input type="date" name="tanggal" id="tanggal" value="<?= $row['tanggal'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Hari (otomatis mengikuti tanggal)</label>
                    <input type="text" name="hari" value="<?= $row['hari'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Jam Kedatangan</label>
                    <input type="time" name="jam" value="<?= $row['jam'] ?>" required>
                </div>
            </div>
            <p style="font-size:12.5px;color:#64748b;">
                Catatan: kolom "Hari" bersifat readonly, mengikuti hasil kalkulasi dari Tanggal Kedatangan.
            </p>
            <button type="submit" class="btn">Update</button>
            <a href="daftar.php" class="btn" style="background:#64748b;">Batal</a>
        </form>
    </div>
</div>

<script>
// Update field Hari otomatis saat Tanggal Kedatangan diubah manual
const hariMap = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
document.getElementById('tanggal').addEventListener('change', function() {
    const d = new Date(this.value + 'T00:00:00');
    document.querySelector('input[name="hari"]').value = hariMap[d.getDay()];
});
</script>
</body>
</html>
