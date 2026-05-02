<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];

    $query = "INSERT INTO buku_tamu (nama, email, pesan)
              VALUES ('$nama', '$email', '$pesan')";

    if(mysqli_query($conn, $query)){
        echo "Data berhasil disimpan!<br>";
        echo "<a href='tampil_bukutamu.php'>Lihat Buku Tamu</a>";
    } else {
        echo "Gagal menyimpan data";
    }

} else {
    echo "Akses tidak valid. Silakan isi form terlebih dahulu.";
}
?>