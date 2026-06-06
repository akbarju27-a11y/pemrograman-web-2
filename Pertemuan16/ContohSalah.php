<?php
$conn = mysqli_connect("localhost", "root", "", "db_mahasiswa");

$query = "SELECT * FROM mahasiswas"; // nama tabel salah
$result = mysqli_query($conn, $query);

while($data = mysqli_fetch_array($result)){
    echo $data['nama'];
}
?>