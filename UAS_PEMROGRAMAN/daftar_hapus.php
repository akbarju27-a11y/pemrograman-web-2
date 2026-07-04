<?php
include 'config.php';

$id = intval($_GET['id']);
mysqli_query($conn, "DELETE FROM pendaftar WHERE no_daftar = $id");

header("Location: daftar.php?msg=hapus");
exit;
?>
