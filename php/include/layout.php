<?php

    require_once './php/config.php';
    $app=new Sql

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Animal names</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

    <div id="header-wrap">

        <div class="top-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="social-links">
                            <ul>
                                <li>
                                    <a href="#"><i class="icon icon-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon icon-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon icon-youtube-play"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon icon-behance-square"></i></a>
                                </li>
                            </ul>
                        </div><!--social-links-->
                    </div>
                    <div class="col-md-6">
                        <div class="right-element">
                            <a href="login.php" class="user-account for-buy"><i class="icon icon-user"></i><span>
                                    Login</span></a>

                            

                        </div><!--top-right-->
                    </div>

                </div>
            </div>
        </div><!--top-content-->

        <header id="header">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-1">
                        <div class="main-logo">
                            <a href="index.html" class="h6 text-dark">Animal names</a>
                        </div>

                    </div>

                    <div class="col-md-11">

                        <nav id="navbar">
                            <div class="main-menu stellarnav">
                                <ul class="menu-list">
                                    <li class="menu-item active"><a href="#home">Home</a></li>

                                    <li class="menu-item"><a href="php/soap/soapServer.php" class="nav-link">SOAP server </a>
                                    </li>
                                    <li class="menu-item"><a href="#popular-books" class="nav-link">SOAP client </a>
                                    </li>
                                    <li class="menu-item"><a href="#featured-books" class="nav-link">SOAP-MNB server
                                        </a></li>
                                    <li class="menu-item"><a href="#featured-books" class="nav-link">Restful server  </a>
                                    </li>
                                    <li class="menu-item"><a href="#popular-books" class="nav-link">Restful client </a>
                                    </li>
                                    <li class="menu-item"><a href="#featured-books" class="nav-link">PDF
                                        </a></li>
                                </ul>

                                <div class="hamburger">
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                </div>

                            </div>
                        </nav>

                    </div>

                </div>
            </div>
        </header>

    </div><!--header-wrap-->