<?php
$conn = mysqli_connect("localhost", "root", "", "buku_tamu_db");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>