<?php include 'config.php'; include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pengurusan Berkas - Pengajuan Paspor</title>
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
    <a href="daftar_ulang.php">Daftar Ulang</a>
    <a href="pengurusan.php" class="active">Pengurusan</a>
</div>
<div class="container">

    <?php if (isset($_GET['msg']) && $_GET['msg']=='sukses'): ?>
        <div class="alert-success">✅ Berkas berhasil diproses.</div>
    <?php endif; ?>

    <div class="card">
        <h2>Antrian Menunggu Diproses</h2>
        <p style="font-size:12.5px;color:#64748b;">
            Berikut pemohon yang lolos verifikasi daftar ulang (keterangan OK) dan siap diproses berkasnya.
            Jika KTP, KK, dan Ijazah/Akte semua "Ada" &rarr; status <b>Diterima</b>, pembayaran Rp 355.000.
        </p>
        <table>
            <thead>
            <tr>
                <th>No. Antrian</th>
                <th>No. Daftar</th>
                <th>Nama Pemohon</th>
                <th>KTP</th>
                <th>KK</th>
                <th>Ijazah/Akte</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "
                SELECT du.* FROM daftar_ulang du
                WHERE du.keterangan = 'OK'
                AND du.id NOT IN (SELECT daftar_ulang_id FROM pengurusan)
                ORDER BY du.no_antrian
            ");
            if (mysqli_num_rows($q) > 0):
                while ($row = mysqli_fetch_assoc($q)):
            ?>
                <tr>
                    <td><b><?= $row['no_antrian'] ?></b></td>
                    <td><?= $row['no_daftar'] ?></td>
                    <td><?= htmlspecialchars($row['nama_pemohon']) ?></td>
                    <td><?= $row['ktp'] ?></td>
                    <td><?= $row['kk'] ?></td>
                    <td><?= $row['ijazah_akte'] ?></td>
                    <td>
                        <a class="btn btn-sm btn-proses" href="pengurusan_proses.php?id=<?= $row['id'] ?>">Proses Berkas</a>
                    </td>
                </tr>
            <?php endwhile; else: ?>
                <tr><td colspan="7" class="empty">Tidak ada antrian yang menunggu diproses.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <h2>Data Pengurusan Paspor</h2>
        <table>
            <thead>
            <tr>
                <th>No. Antrian</th>
                <th>No. Daftar</th>
                <th>Nama Pemohon</th>
                <th>Berkas</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Pembayaran</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM pengurusan ORDER BY id DESC");
            if (mysqli_num_rows($result) > 0):
                while ($row = mysqli_fetch_assoc($result)):
                    $berkasClass = $row['berkas']=='Lengkap' ? 'badge-lengkap' : 'badge-tidaklengkap';
                    $statusClass = $row['status']=='Diterima' ? 'badge-diterima' : 'badge-ditolak';
                    $ketClass    = $row['keterangan']=='OK' ? 'badge-ok' : 'badge-tidak';
            ?>
                <tr>
                    <td><?= $row['no_antrian'] ?></td>
                    <td><?= $row['no_daftar'] ?></td>
                    <td><?= htmlspecialchars($row['nama_pemohon']) ?></td>
                    <td><span class="badge <?= $berkasClass ?>"><?= $row['berkas'] ?></span></td>
                    <td><span class="badge <?= $statusClass ?>"><?= $row['status'] ?></span></td>
                    <td><span class="badge <?= $ketClass ?>"><?= $row['keterangan'] ?></span></td>
                    <td><?= format_rupiah($row['pembayaran']) ?></td>
                </tr>
            <?php endwhile; else: ?>
                <tr><td colspan="7" class="empty">Belum ada data pengurusan.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>

        <?php
        $rp = mysqli_query($conn, "SELECT IFNULL(SUM(pembayaran),0) t FROM pengurusan WHERE status='Diterima'");
        $pendapatan = mysqli_fetch_assoc($rp)['t'];
        ?>
        <div style="margin-top:16px; text-align:right;">
            <b style="font-size:15px;">Pendapatan: <?= format_rupiah($pendapatan) ?></b>
        </div>
    </div>

</div>
</body>
</html>
