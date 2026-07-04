<?php
include 'config.php';

$id = intval($_GET['id']);
mysqli_query($conn, "DELETE FROM daftar_ulang WHERE id = $id");

header("Location: daftar_ulang.php?msg=hapus");
exit;
?>
