<?php

session_start();
include("database-config.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['username']) && isset($_POST['password'])){
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $loginUsername = mysqli_real_escape_string($conn,$_POST['username']);
        $loginPassword = mysqli_real_escape_string($conn,$_POST['password']); 
        
        $sql = "SELECT name FROM users WHERE username = '$loginUsername' and password = '".md5($loginPassword)."'";
        $resultLogin = $conn->query($sql);
        $conn->close();
        
        if($resultLogin->num_rows == 1) {
            $data=$resultLogin->fetch_assoc();
            $_SESSION["username"]=$data['name'];
            header('Location:dashboard.php');
        }else {
            $error = "Login inválido!";
        }
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
    <link rel="stylesheet" href="assets/css/custom-login.css"> 
</head>
<body class="login-page">
    <div class="container-fluid">
        <div class="row h-100 align-items-center">
            <div class="col-lg-8 col-sm-6 col-4 login-left-side p-0">
                <div class="login-image">
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-8 login-form h-100">
                <form method="post" class="p-4 text-center">
                    <img class="mb-4 mx-auto" src="assets/img/logo-orange.png" alt="">

                    <div class="form-floating">
                        <input type="text" class="form-control mb-3" value="<?= isset($_POST['username'])?$_POST['username']:""?>" name="username" placeholder="Username">
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control mb-3" name="password" placeholder="Password">
                    </div>
                    <input class="w-100 btn btn-lg btn-light btn-submit" type="submit" value="Entrar"></input>
                    <p style="text-align: left; margin-top:15px; color:red;"><?= $error; ?></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>