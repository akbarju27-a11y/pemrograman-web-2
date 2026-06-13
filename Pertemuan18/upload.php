<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">

    Pilih File :
    <input type="file" name="file">

    <br><br>

    <input type="submit" name="upload" value="Upload">

</form>

<?php

if(isset($_POST['upload']))
{
    $namaFile = $_FILES['file']['name'];

    if(move_uploaded_file(
        $_FILES['file']['tmp_name'],
        "uploads/".$namaFile
    ))
    {
        echo "Upload berhasil";
    }
    else
    {
        echo "Upload gagal";
    }
}

?>

</body>
</html>