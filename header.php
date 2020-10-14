<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0000ee">
    <meta name="msapplication-navbutton-color" content="#00003a">
    <meta name="apple-mobile-web-app-status-color" content="#00003a">
    <!-- <meta http-equiv="refresh" content="90"> -->
    <meta name="apple-mobile-web-app-scatus-bar-style" content="black-translucent">
    <title>NSSCCEM</title>
</head>

<body>
    <link rel="shortcut icon" href="images/NSS.png" />

    <div id="loading"></div>
    <!--for preloader-->
    <?php
    ob_start();
    function e_hand($eno, $emsg)
    {
    }
    set_error_handler("e_hand");
    session_start();
    date_default_timezone_set("asia/kolkata");
    $today = date("Y-m-d");
    ?>
    <?php require_once 'include/const.php'; ?>
    <?php require_once 'include/db.php'; ?>
    <?php require_once 'include/my_mail.php'; ?>
    <?php require_once 'include/myfun.php'; ?>
    <link rel="stylesheet" href="vender/bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="vender/datatable/css/dataTables.bootstrap4.min.css">
    <script src="vender/jquery-3.3.1.min.js"></script>
    <script src="vender/popper.min.js"></script>
    <script src="vender/bs/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="vender/jqui/jquery-ui.min.css">
    <script src="vender/jqui/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="vender/fa/css/font-awesome.min.css">
    <link href="vender/lightbox/src/css/lightbox.css" rel="stylesheet">
    <script src="vender/lightbox/src/js/lightbox.js"></script>
    <script src="vender/datatable/js/jquery.dataTables.min.js"></script>
    <script src="vender/datatable/js/dataTables.bootstrap4.min.js"></script>
    <!-- jQuery-confirm -->
    <link rel="stylesheet" href="vender/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css">
    <script src="vender/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="style.css">

    <!-- ================================================== -->
    <div id="mainbox">
        <div id="navbar">
            <nav class="navbar navbar-expand-md head1">
                <a class="navbar-brand text-white logoo" href="index.php"><img class="logo" src="images/NSS.png" /></a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#n1">
                    <i class="fa fa-bars mytxt"></i>
                </button>
                <div class="collapse navbar-collapse" id="n1">
                    <ul class="navbar-nav ml-auto">
                        <a class="nav-link <?php if ($currentPage == 'index') {
                                                echo 'active';
                                            } ?>" href="index.php">
                            <li class="nav-item">Home</li>
                        </a>
                        <a class="nav-link  if($currentPage =='events'){echo 'active';}?>" href="events.php">
                            <li class="nav-item">Events</li>
                        </a>
                        <a class="nav-link <?php if ($currentPage == 'about') {
                                                echo 'active';
                                            } ?>" href="about.php">
                            <li class="nav-item">About Us</li>
                        </a>
                        <?php
                        if (is_admin()) { ?>
                        <a class="nav-link <?php if ($currentPage == 'search') {
                                                    echo 'active';
                                                } ?>" href="search.php">
                            <li class="nav-item">Members</li>
                        </a>
                        <?php
                        }
                        ?>
                        <a class="nav-link dropdown" data-toggle="dropdown">
                            <li class="nav-item dropdown-toggle">More</li>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if (is_login()) {
                            ?>
                            <!-- <a class="nav-link <?php if ($currentPage == 'profile') {
                                                            echo 'active';
                                                        } ?>" href="profile.php">
                                <li class="nav-item">Profile</li>
                            </a> -->
                            <a class='nav-link' href='logout.php'>
                                <li class="nav-item">Logout</li>
                            </a>
                            <?php
                            } else {
                            ?>
                            <a class="nav-link <?php if ($currentPage == 'reg') {
                                                        echo 'active';
                                                    } ?>" href="reg.php">
                                <li class="nav-item">Join Us</li>
                            </a>
                            <a class="nav-link <?php if ($currentPage == 'login') {
                                                        echo 'active';
                                                    } ?>" href="login.php">
                                <li class="nav-item">Login</li>
                            </a>
                            <?php
                            }
                            ?>
                        </ul>
                    </ul>
                </div>
            </nav>
        </div>
        <!--for pre-loader animation-->
        <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(() => {
                document.getElementById('loading').style.display = 'none';
            }, 2000);
        });
        // FOR Tooltip
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        </script>

        <div class="content" id="contain">