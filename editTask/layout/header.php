<?php

if (session_status() != PHP_SESSION_ACTIVE) session_start();
$current_page = 'home';

if (str_contains($_SERVER['REQUEST_URI'], '/posts.php')) $current_page = 'posts';
if (str_contains($_SERVER['REQUEST_URI'], '/myposts')) $current_page = 'myposts';
if (str_contains($_SERVER['REQUEST_URI'], '/users')) $current_page = 'users';
if (str_contains($_SERVER['REQUEST_URI'], '/admin')) $current_page = 'adminAllposts';
if (str_contains($_SERVER['REQUEST_URI'], '/login.php')) $current_page = 'login';
if (str_contains($_SERVER['REQUEST_URI'], '/allusers.php')) $current_page = 'allusers';
if (str_contains($_SERVER['REQUEST_URI'], '/register.php')) $current_page = 'register';
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="TemplateMo">
        <link
            href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
            rel="stylesheet">

        <title>Stand CSS Blog by TemplateMo</title>

        <!-- Bootstrap core CSS -->
        <link href="<?= BASE_URL ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/fontawesome.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/templatemo-stand-blog.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/owl.css">
        <!--

TemplateMo 551 Stand Blog

https://templatemo.com/tm-551-stand-blog

-->
    </head>

    <body>

        <!-- ***** Preloader Start ***** -->
        
        <!-- ***** Preloader End ***** -->

        <!-- Header -->
        <!-- Header -->
        <header class="">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="index.php">
                        <h2>Sprints Blog<em>.</em></h2>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item <?= ($current_page == 'home' ? "active" : "") ?>">
                                <a class="nav-link" href="<?= BASE_URL . '/' ?>">Home
                                    <?= ($current_page == 'home' ? "<span class='sr-only'>(current)</span>" : "") ?>
                                </a>
                            </li>
                            <li class="nav-item <?= ($current_page == 'posts' ? "active" : "") ?>">
                                <a class="nav-link" href="<?= BASE_URL . '/posts.php' ?>">Posts</a>
                                <?= ($current_page == 'posts' ? "<span class='sr-only'>(current)</span>" : "") ?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact Us</a>
                            </li>
                            <?php
                        if (isset($_SESSION['user'])) {
                        ?>
                            <?php
                            if (isset($_SESSION['user']['type']) && $_SESSION['user']['type'] == 1) {
                            ?>
                            <li class="nav-item">
                            <?= ($current_page == 'adminAllposts' ? "<span class='sr-only'>(current)</span>" : "") ?>
                                <a class="nav-link" href="<?= BASE_URL . 'admin/index.php'?>">All Posts </a>
                                
                            </li>
                            <li class="nav-item <?= ($current_page == 'users' ? "active" : "") ?>">
                            <?= ($current_page == 'users' ? "<span class='sr-only'>(current)</span>" : "") ?> 
                            <a class="nav-link" href="<?= BASE_URL . '/users/index.php' ?>">ALL Users</a>
                             
                            </li>
                            <?php
                            }
                            ?>
                            <li class="nav-item <?= ($current_page == 'myposts' ? "active" : "") ?>">
                                <a class="nav-link" href="<?= BASE_URL . '/myposts' ?>">My Posts</a>
                            </li>
                            <li class="nav-item <?= ($current_page == 'allusers' ? "active" : "") ?>">
                                <a class="nav-link" href="<?= BASE_URL . 'allusers.php' ?>">follow users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL .'/logout.php'?>">Logout</a>
                            </li>
                            <?php
                        } else {
                        ?>
                            <li class="nav-item <?= ($current_page == 'login' ? "active" : "") ?>">
                                
                                <a class="nav-link" href="<?= BASE_URL . '/login.php'?>">Login</a>
                            </li>
                            <li class="nav-item   <?= ($current_page == 'register' ? "active" : "") ?>">
                                <a class="nav-link" href="<?= BASE_URL . '/register.php'?>">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL .'/logout.php'?>">Logout</a>
                            </li>
                            <?php
                        }
                        ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>