<!DOCTYPE html>
<html>
<head>
    <title>Demo XSS</title>
</head>
<body>

    <h2>Form Komentar</h2>

    <form action="proses.php" method="POST">
        Nama:
        <input type="text" name="nama" required>
        <br><br>

        Komentar:
        <textarea name="komentar" rows="5" cols="40" required></textarea>
        <br><br>

        <button type="submit">Kirim</button>
    </form>

</body>
</html>