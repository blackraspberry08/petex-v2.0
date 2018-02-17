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
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

        <!-- Bootstrap CSS File -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <link href="<?= base_url() ?>assets/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <!-- SweetAlert -->
        <link rel = "stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
   
        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

        
        <!-- Libraries CSS Files -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>

    <style>
        body{
            background-color:#f0c514;
        }
    </style>
    <body>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                $('.preloader-background').delay(800).fadeOut('slow');
                $('.preloader-wrapper').delay(800).fadeOut();
                $('[data-toggle="tooltip"]').tooltip({
                    container: 'body'
                 });
            });
        </script>
        <?php include 'preloader.php' ?>