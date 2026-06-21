<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "demo_keamanan"
);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>