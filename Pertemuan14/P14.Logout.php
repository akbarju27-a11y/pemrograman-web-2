<?php
session_start();

session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
</head>
<body style="font-family:Arial;text-align:center;margin-top:100px;">
    <h1>✅ Logout Berhasil</h1>
    <p>Session telah dihapus.</p>

    <a href="P14.Login.php">Login Kembali</a>
</body>
</html>