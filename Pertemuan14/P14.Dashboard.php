<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: P14.Logout.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body{
            font-family:Arial;
            text-align:center;
            background:#f4f4f4;
            margin-top:100px;
        }

        .box{
            background:white;
            width:500px;
            margin:auto;
            padding:30px;
            border-radius:15px;
            box-shadow:0 0 10px gray;
        }

        a{
            text-decoration:none;
            background:red;
            color:white;
            padding:10px 20px;
            border-radius:5px;
        }
    </style>
</head>
<body>

<div class="box">
    <h1>🎉 Selamat Datang, <?php echo $_SESSION['login']; ?></h1>
    <p>Anda berhasil login menggunakan Session PHP.</p>

    <br>
    <a href="P14.Logout.php">Logout</a>
</div>

</body>
</html>