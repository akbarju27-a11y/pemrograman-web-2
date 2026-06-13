<?php
// Memicu error karena mengirimkan teks ke browser sebelum fungsi header()
echo "<p>Hallo Apa kabar?</p>";
header("Location: test.php");
?>