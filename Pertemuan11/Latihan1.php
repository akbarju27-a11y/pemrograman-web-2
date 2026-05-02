<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";

$link = mysqli_connect($servername, $dbusername, $dbpassword);

if ($link) {
    echo "OK.... Koneksi Berhasil";
} else {
    echo "Koneksi Gagal";
}
?>