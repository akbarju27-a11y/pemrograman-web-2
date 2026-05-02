<?php
$conn = mysqli_connect("localhost", "root", "", "lat_dbase");

$hasil = mysqli_query($conn, "SELECT * FROM tbl_mhs");

$hit = mysqli_num_rows($hasil);

echo "Jumlah record = " . $hit;

mysqli_close($conn);
?>