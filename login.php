<?php

    session_start();
    $username="persona";
    $password="1234";

    $username_1="jhelan";
    $password_1="1234";

    if(isset($_POST['username']) && isset($_POST['password'])){
        if ($_POST['username'] == $username && $_POST['password']==$password) {
            echo "O username submetido foi:".$_POST['username']."<br>";
            echo "A password submetida foi:".$_POST['password']."<br>";

            $_SESSION["username"]=$_POST['username'];
            //header("refresh:0;url=dashboard.php"
            header('Location:dashboard.php');

        } elseif ($_POST['username'] == $username_1 && $_POST['password']==$password_1) {
            echo "O username submetido foi:".$_POST['username']."<br>";
            echo "A password submetida foi:".$_POST['password']."<br>";

            $_SESSION["username"]=$_POST['username'];
            //header("refresh:0;url=dashboard.php"
            header('Location:dashboard.php');
        } else {
            //echo "Credenciais erradas!!!" . "<br>";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/icon.png">
    <link rel="icon" type="image/png" href="assets/img/icon.png">
    <title>Login | Warehouse - IT technologies</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body class="login-page">
    <div class="container-fluid">
        <div class="row h-100 align-items-center">
            <div class="col-8 login-left-side p-0">
                <div class="login-image">
                </div>
            </div>
            <div class="col-4 login-form h-100">
                <form method="post" class="p-4 text-center">
                    <img class="mb-4 mx-auto" src="assets/img/logo-orange.png" alt="">

                    <div class="form-floating">
                        <input type="text" class="form-control mb-3" name="username" placeholder="Username">
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control mb-3" name="password" placeholder="Password">
                    </div>
                    <input class="w-100 btn btn-lg btn-light btn-submit" type="submit" value="Entrar"></input>
                </form>
            </div>
        </div>
    </div>
</body>
</html>