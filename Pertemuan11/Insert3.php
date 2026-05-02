<?php
$conn = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $age       = $_POST['age'];

    $sql = "INSERT INTO tbl_mhs (FirstName, LastName, Age)
            VALUES ('$firstname', '$lastname', '$age')";

    if (mysqli_query($conn, $sql)) {
        echo "1 Record Added Successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} else {
    echo "Akses halaman ini melalui form.php";
}

mysqli_close($conn);
?>