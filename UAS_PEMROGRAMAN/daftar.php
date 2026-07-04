<?php include 'config.php'; include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Input Daftar - Pengajuan Paspor</title>
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

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert-success">
            <?php if ($_GET['msg']=='sukses'): ?>
                ✅ Data pendaftar berhasil disimpan. Jadwal kedatangan otomatis telah ditentukan.
            <?php elseif ($_GET['msg']=='update'): ?>
                ✅ Data pendaftar berhasil diperbarui.
            <?php elseif ($_GET['msg']=='hapus'): ?>
                🗑️ Data pendaftar berhasil dihapus.
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <h2>Input Pendaftaran</h2>
        <form action="daftar_simpan.php" method="POST">
            <div class="form-grid">
                <div class="form-group full">
                    <label>Nama Pemohon</label>
                    <input type="text" name="nama_pemohon" required placeholder="Masukkan nama lengkap pemohon">
                </div>
            </div>
            <p style="font-size:12.5px;color:#64748b;">
                Hari, tanggal, dan jam kedatangan akan ditentukan otomatis oleh sistem
                (kapasitas maksimal 5 orang per hari; jika penuh, jadwal akan maju ke hari berikutnya).
            </p>
            <button type="submit" class="btn">Simpan</button>
        </form>
    </div>

    <div class="card">
        <h2>Data Pendaftar</h2>
        <table>
            <thead>
            <tr>
                <th>No. Daftar</th>
                <th>Nama Pemohon</th>
                <th>Tgl Daftar</th>
                <th>Hari</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM pendaftar ORDER BY tanggal, jam");
            if (mysqli_num_rows($result) > 0):
                while ($row = mysqli_fetch_assoc($result)):
            ?>
                <tr>
                    <td><?= $row['no_daftar'] ?></td>
                    <td><?= htmlspecialchars($row['nama_pemohon']) ?></td>
                    <td><?= format_tanggal($row['tgl_daftar']) ?></td>
                    <td><?= $row['hari'] ?></td>
                    <td><?= format_tanggal($row['tanggal']) ?></td>
                    <td><?= substr($row['jam'],0,5) ?></td>
                    <td>
                        <a class="btn btn-sm btn-edit" href="daftar_edit.php?id=<?= $row['no_daftar'] ?>">Edit</a>
                        <a class="btn btn-sm btn-hapus" href="daftar_hapus.php?id=<?= $row['no_daftar'] ?>" onclick="return confirm('Hapus data pendaftar ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; else: ?>
                <tr><td colspan="7" class="empty">Belum ada data pendaftar.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
