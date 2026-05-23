<!DOCTYPE html>
<html>
<head>
<title>Form Input Data Mahasiswa</title>

<style>

body{
    font-family:Arial;
}

table{
    margin:auto;
}

input,select{
    padding:5px;
}

.judul{
    color:orange;
    font-weight:bold;
}

</style>

</head>

<body>

<div style="padding:10px;width:760px;margin:auto;">

<form action="action-input-data.php" method="POST">

<table width="760">

<tr>
    <td></td>
    <td></td>
    <td class="judul">Form Input Data Mahasiswa</td>
</tr>

<tr height="50">
    <td></td>
    <td>ID Mahasiswa / NIM</td>
    <td>
        <input type="text" name="id_mahasiswa" size="35">
    </td>
</tr>

<tr height="50">
    <td></td>
    <td>Nama</td>
    <td>
        <input type="text" name="nama" size="50">
    </td>
</tr>

<tr height="50">
    <td></td>
    <td>Jurusan</td>
    <td>

        <select name="jurusan">
            <option value="">- Pilih Jurusan -</option>
            <option>Teknik Informatika</option>
            <option>Sistem Informasi</option>
            <option>Teknik Komputer</option>
            <option>Teknik Elektro</option>
            <option>Teknik Mesin</option>
        </select>

    </td>
</tr>

<tr height="50">
    <td></td>
    <td>Alamat</td>
    <td>
        <input type="text" name="alamat" size="50">
    </td>
</tr>

<tr height="50">
    <td></td>
    <td>No. Telp</td>
    <td>
        <input type="text" name="telepon" size="20">
    </td>
</tr>

<tr height="50">
    <td></td>
    <td></td>
    <td>
        <input type="submit" name="Submit" value="Submit">
        <input type="reset" value="Cancel">
    </td>
</tr>

</table>

</form>

</div>

</body>
</html>