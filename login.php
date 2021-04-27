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
            echo "Credenciais erradas!!!" . "<br>";
        }
    }

?>