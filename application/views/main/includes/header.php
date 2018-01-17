<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= $title ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicons -->
        <link rel="shortcut icon" href="<?= $this->config->base_url() ?>images/logo/icon.png">
        <link href="<?= base_url() ?>assets/main/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

        <!-- Bootstrap CSS File -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

        <!-- Libraries CSS Files -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">

        <!-- Main Stylesheet File -->
        <link href="<?= base_url() ?>assets/main/css/style.css" rel="stylesheet">

        <!-- =======================================================
          Theme Name: Regna
          Theme URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
          Author: BootstrapMade.com
          License: https://bootstrapmade.com/license/
        ======================================================= -->
    </head>

    <body>
        <?php

        function get_age($birth_date) {
            if (date("Y", $birth_date) == "2018") {
//Month
                return floor((time() - $birth_date) / 2678400) . " months old";
            } else {
//Year
                return floor((time() - $birth_date) / 31556926) . " years old";
            }
        }
        ?>
       <!--==========================
         Header
        ============================-->
        <header id="header">
            <div class="container">

                <div id="logo" class="pull-left">
                    <a href="#hero"><img src="<?= base_url() ?>images/logo/logo.png" height ="38" alt="" title="" /></img></a>
                    <!-- Uncomment below if you prefer to use a text logo -->
                    <!--<h1><a href="#hero">Regna</a></h1>-->
                </div>

                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="#hero">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#portfolio">Adoptables</a></li>
                        <li><a href="#team">Team</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </header><!-- #header -->
