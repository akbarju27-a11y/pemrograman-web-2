<?php
include 'koneksi.php';

$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$data = mysqli_query($conn, "SELECT * FROM buku_tamu ORDER BY id DESC LIMIT $start, $limit");

echo "<h2>Data Buku Tamu</h2>";

echo "<table border='1' cellpadding='10'>
<tr>
<th>No</th>
<th>Nama</th>
<th>Email</th>
<th>Pesan</th>
<th>Tanggal</th>
</tr>";

$no = $start + 1;

while($row = mysqli_fetch_assoc($data)){
    echo "<tr>
            <td>$no</td>
            <td>$row[nama]</td>
            <td>$row[email]</td>
            <td>$row[pesan]</td>
            <td>$row[tanggal]</td>
          </tr>";
    $no++;
}

echo "</table><br>";

$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM buku_tamu"));
$pages = ceil($total / $limit);

for($i=1; $i<=$pages; $i++){
    echo "<a href='tampil_bukutamu.php?page=$i'>$i</a> ";
}
?>