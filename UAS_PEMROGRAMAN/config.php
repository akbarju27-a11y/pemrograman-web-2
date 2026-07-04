<?php
// ============================================
// KONFIGURASI KONEKSI DATABASE
// Sesuaikan jika username/password MySQL Anda berbeda
// ============================================
$host = "localhost";
$user = "root";
$pass = "";
$db   = "paspor_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error() .
        "<br>Pastikan MySQL sudah aktif dan database 'paspor_db' sudah di-import dari file database.sql");
}

mysqli_set_charset($conn, "utf8mb4");
?>
