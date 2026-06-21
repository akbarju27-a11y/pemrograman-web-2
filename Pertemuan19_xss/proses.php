<?php

$nama = htmlspecialchars($_POST['nama']);
$komentar = htmlspecialchars($_POST['komentar']);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Komentar Aman</title>
</head>
<body>

    <h2>Data Komentar</h2>

    <p><strong>Nama:</strong> <?php echo $nama; ?></p>

    <p><strong>Komentar:</strong></p>
    <?php echo nl2br($komentar); ?>

    <br><br>
    <a href="index.php">Kembali</a>

</body>
</html>