<?php
$conn = mysqli_connect("localhost", "root", "", "lat_dbase");

$hasil = mysqli_query($conn, "SELECT * FROM tbl_mhs");

while ($data = mysqli_fetch_row($hasil)) {
    echo $data[0] . " ";
    echo $data[1] . " ";
    echo $data[2] . " ";
    echo $data[3] . "<br>";
}

mysqli_close($conn);
?>