<?php
$conn = mysqli_connect("localhost", "root", "", "lat_dbase");

$hasil = mysqli_query($conn, "SELECT * FROM tbl_mhs");

while ($data = mysqli_fetch_array($hasil)) {
    echo $data['FirstName'] . " ";
    echo $data['LastName'] . " ";
    echo $data['Age'] . "<br>";
}

mysqli_close($conn);
?>