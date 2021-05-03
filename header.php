<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:login.php");
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
    <!-- <meta http-equiv="refresh" content="5"> -->
    <title><?= $pageTitle ?> | Warehouse - IT technologies</title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/81a361d601.js" crossorigin="anonymous"></script>

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body>
<div class="wrapper">
    <div class="sidebar" data-image="assets/img/sidebar.jpg" data-color="orange">
        <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="dashboard.php" class="simple-text">
                        <img src="assets/img/logo.png" class="img-fluid" alt="">
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item <?= $activePage=="dashboard"?"active":""?>">
                        <a class="nav-link" href="dashboard.php">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $activePage=="historico"?"active":""?>">
                        <a class="nav-link" href="historico.php">
                            <i class="nc-icon nc-bullet-list-67"></i>
                            <p>Histórico</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $activePage=="definicoes"?"active":""?>">
                        <a class="nav-link" href="definicoes.php">
                            <i class="nc-icon nc-settings-gear-64"></i>
                            <p>Definições</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?php $current_url = explode("?", $_SERVER['REQUEST_URI']); echo $current_url[0] ;?>"> <?php if(isset($pageTitle)) echo $pageTitle; ?> </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="<?php $current_url = explode("?", $_SERVER['REQUEST_URI']); echo $current_url[0] ;?>" class="nav-link" data-toggle="dropdown">
                                    <span class="d-lg-none"><?php if(isset($pageTitle)) echo $pageTitle; ?></span>
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="logout.php">Terminar Sessão
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    
                    