<?php
session_start();

if(isset($_POST['login'])){
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if($user == "rahadian" && $pass == "123"){
        $_SESSION['login'] = $user;
        header("Location: P14.Dashboard.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Session</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg,#4facfe,#00f2fe);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:15px;
            width:350px;
            box-shadow:0 5px 20px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
        }

        input{
            width:90%;
            padding:10px;
            margin:8px 0;
        }

        button{
            width:90%;
            padding:10px;
            background:#4facfe;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }

        .error{
            color:red;
            text-align:center;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>🔐 Login Session</h2>

    <?php
    if(isset($error)){
        echo "<p class='error'>$error</p>";
    }
    ?>

    <form method="post">
        <input type="text" name="user" placeholder="Username" required>
        <input type="password" name="pass" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>