<?php include 'config.php'; include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar Ulang - Pengajuan Paspor</title>
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

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert-success">
            <?php if ($_GET['msg']=='sukses'): ?>
                ✅ Data daftar ulang berhasil disimpan.
            <?php elseif ($_GET['msg']=='update'): ?>
                ✅ Data daftar ulang berhasil diperbarui.
            <?php elseif ($_GET['msg']=='hapus'): ?>
                🗑️ Data daftar ulang berhasil dihapus.
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <h2>Input Daftar Ulang</h2>
        <form action="daftar_ulang_simpan.php" method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>No. Daftar</label>
                    <select name="no_daftar" required>
                        <option value="">-- Pilih No. Daftar --</option>
                        <?php
                        $pendaftars = mysqli_query($conn, "SELECT * FROM pendaftar ORDER BY no_daftar");
                        while ($p = mysqli_fetch_assoc($pendaftars)):
                        ?>
                        <option value="<?= $p['no_daftar'] ?>">
                            #<?= $p['no_daftar'] ?> - <?= htmlspecialchars($p['nama_pemohon']) ?>
                            (Jadwal: <?= $p['hari'] ?>, <?= format_tanggal($p['tanggal']) ?>)
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keperluan</label>
                    <select name="keperluan" required>
                        <option value="Paspor Baru">Paspor Baru</option>
                        <option value="Perpanjangan">Perpanjangan</option>
                        <option value="Penggantian Hilang/Rusak">Penggantian Hilang/Rusak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal Datang (aktual)</label>
                    <input type="date" name="tgl_datang" required>
                </div>
                <div class="form-group">
                    <label>KTP</label>
                    <select name="ktp"><option value="Ada">Ada</option><option value="Tidak">Tidak</option></select>
                </div>
                <div class="form-group">
                    <label>KK</label>
                    <select name="kk"><option value="Ada">Ada</option><option value="Tidak">Tidak</option></select>
                </div>
                <div class="form-group">
                    <label>Ijazah/Akte</label>
                    <select name="ijazah_akte"><option value="Ada">Ada</option><option value="Tidak">Tidak</option></select>
                </div>
            </div>
            <p style="font-size:12.5px;color:#64748b;">
                Keterangan "OK" otomatis diberikan jika hari &amp; tanggal datang sesuai dengan jadwal
                pada saat pendaftaran. Jika sesuai, nomor antrian akan diberikan otomatis.
            </p>
            <button type="submit" class="btn">Simpan</button>
        </form>
    </div>

    <div class="card">
        <h2>Data Pendaftar Ulang</h2>
        <table>
            <thead>
            <tr>
                <th>No. Daftar</th>
                <th>Nama Pemohon</th>
                <th>Keperluan</th>
                <th>KTP</th>
                <th>KK</th>
                <th>Ijazah/Akte</th>
                <th>Hari Datang</th>
                <th>Tgl Datang</th>
                <th>Keterangan</th>
                <th>No. Antrian</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM daftar_ulang ORDER BY id DESC");
            if (mysqli_num_rows($result) > 0):
                while ($row = mysqli_fetch_assoc($result)):
            ?>
                <tr>
                    <td><?= $row['no_daftar'] ?></td>
                    <td><?= htmlspecialchars($row['nama_pemohon']) ?></td>
                    <td><?= htmlspecialchars($row['keperluan']) ?></td>
                    <td><?= $row['ktp'] ?></td>
                    <td><?= $row['kk'] ?></td>
                    <td><?= $row['ijazah_akte'] ?></td>
                    <td><?= $row['hari_datang'] ?></td>
                    <td><?= format_tanggal($row['tgl_datang']) ?></td>
                    <td>
                        <?php if ($row['keterangan']=='OK'): ?>
                            <span class="badge badge-ok">OK</span>
                        <?php else: ?>
                            <span class="badge badge-tidak">Tidak</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $row['no_antrian'] ?? '-' ?></td>
                    <td>
                        <a class="btn btn-sm btn-edit" href="daftar_ulang_edit.php?id=<?= $row['id'] ?>">Edit</a>
                        <a class="btn btn-sm btn-hapus" href="daftar_ulang_hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; else: ?>
                <tr><td colspan="11" class="empty">Belum ada data daftar ulang.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
