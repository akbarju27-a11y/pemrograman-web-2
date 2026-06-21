<?php

include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM users
     WHERE username = ?
     AND password = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "ss",
    $username,
    $password
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) > 0){
    echo "<h2>Login Berhasil</h2>";
}else{
    echo "<h2>Login Gagal</h2>";
}

mysqli_stmt_close($stmt);

?>