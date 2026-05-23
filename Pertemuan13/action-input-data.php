<?php

include 'koneksi.php';

if(isset($_POST['Submit'])){

$id_mahasiswa = $_POST['id_mahasiswa'];
$nama         = $_POST['nama'];
$jurusan      = $_POST['jurusan'];
$alamat       = $_POST['alamat'];
$telepon      = $_POST['telepon'];

if(empty($id_mahasiswa) || empty($nama) || empty($alamat) || empty($telepon)){

echo "<script>
alert('Data Harus Lengkap!');
window.location='input-data.php';
</script>";

}else{

$cek = mysqli_num_rows(mysqli_query($koneksi,
"SELECT * FROM mahasiswa WHERE id_mahasiswa='$id_mahasiswa'"));

if($cek > 0){

echo "<script>
alert('NIM Sudah Ada!');
window.location='input-data.php';
</script>";

}else{

$query = "INSERT INTO mahasiswa
VALUES('$id_mahasiswa','$nama','$jurusan','$alamat','$telepon')";

$simpan = mysqli_query($koneksi,$query);

if($simpan){

echo "<script>
alert('Data Berhasil Disimpan');
window.location='input-data.php';
</script>";

}else{

echo "Data Gagal Disimpan";

}

}

}

}

?>