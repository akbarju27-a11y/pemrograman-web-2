<!DOCTYPE html>
<html>
<head>
    <title>Form Buku Tamu</title>
</head>
<body>

<h2>Form Buku Tamu</h2>

<form action="simpan_bukutamu.php" method="POST">
    Nama:<br>
    <input type="text" name="nama" required><br><br>

    Email:<br>
    <input type="email" name="email" required><br><br>

    Pesan:<br>
    <textarea name="pesan" required></textarea><br><br>

    <button type="submit">Simpan</button>
</form>

</body>
</html>