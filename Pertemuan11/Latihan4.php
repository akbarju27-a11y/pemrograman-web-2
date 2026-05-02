<?php
$conn = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

mysqli_query($conn,
    "INSERT INTO tbl_mhs (FirstName, LastName, Age)
     VALUES ('Karina', 'Suwandi', 29)"
);

mysqli_query($conn,
    "INSERT INTO tbl_mhs (FirstName, LastName, Age)
     VALUES ('Glenn', 'Gandari', 32)"
);

echo "Data berhasil ditambahkan";

mysqli_close($conn);
?>