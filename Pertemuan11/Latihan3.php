<?php
$conn = mysqli_connect("localhost", "root", "", "lat_dbase");

$sql = "CREATE TABLE tbl_mhs (
    mhsID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(15),
    LastName VARCHAR(15),
    Age INT
)";

if (mysqli_query($conn, $sql)) {
    echo "Tabel berhasil dibuat<br>";
} else {
    echo "Tabel gagal dibuat / sudah ada<br>";
}

$input = mysqli_query($conn,
    "INSERT INTO tbl_mhs (FirstName, LastName, Age)
     VALUES ('Anjar', 'Prabowo', 25)"
);

if ($input) {
    echo "Data awal berhasil ditambahkan";
} else {
    echo "Data gagal ditambahkan";
}
?>