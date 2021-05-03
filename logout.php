<?php
    //Destoi a sessão
    session_start();
    session_unset();
    session_destroy();
    header("location:login.php");
    die("Sessão encerrada!");
?>