<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?= $title ?></title>
        <link rel="shortcut icon" href="<?= $this->config->base_url() ?>images/logo/icon.png">
        <!-- JQUERY -->
        <script src="<?= base_url() ?>assets/jquery/jquery.min.js"></script>
        <!-- Bootstrap core CSS-->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <!-- Custom fonts for this template-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- Bootstrap Datepicker -->
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/smalot-bootstrap-datetimepicker/2.4.4/css/bootstrap-datetimepicker.min.css">
        <!-- Page level plugin CSS-->
        <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <!-- Timeline CSS Files-->
        <link rel ="stylesheet" href = "<?= base_url() ?>assets/timeline/timeline.css">
        <!-- Bootstrap Switch -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="<?= base_url() ?>assets/admin/css/sb-admin.css" rel="stylesheet">
        <!-- Bootstrap Lightbox-->
        <link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
        <style>button{cursor:pointer !important;}</style>
    </head>
    <style>
        .vertical-divider {
            position: absolute;
            z-index: 10;
            top: 60%;
            left: 40%;
            margin: 0;
            padding: 0;
            width: auto;
            height: 50%;
            line-height: 0;
            text-align:center;
            text-transform: uppercase;
            transform: translateX(-50%);
        }

        .vertical-divider:before, 
        .vertical-divider:after {
            position: absolute;
            left: 20%;
            content: '';
            z-index: 9;
            border-left: 2px solid rgba(34,36,38,.20);
            border-right: 2px solid rgba(255,255,255,.5);
            width: 0;
            height: calc(100% - 1rem);
        }

        .row-divided > .vertical-divider {
            height: calc(50% - 1rem);    
        }

        .vertical-divider:before {
            top: -93%;
        }

        .btn-default {
            background-color: #2BBBAD; }
        .btn-default:hover {
            background-color: #30cfc0 !important; }
        .btn-default:focus, .btn-default:active, .btn-default.active {
            background-color: #28a745 !important; }
        .btn-default.dropdown-toggle {
            background-color: #2BBBAD !important; }
        .btn-default.dropdown-toggle:hover, .btn-default.dropdown-toggle:focus {
            background-color: #30cfc0 !important; }

        .indigo {
            background-color: #3f51b5 !important; }

        .btn-indigo {
            background-color: #3f51b5; }
        .btn-indigo:hover {
            background-color: #4d5ec1 !important; }
        .btn-indigo:focus, .btn-indigo:active, .btn-indigo.active {
            background-color: #1e7e34 !important; }
        .btn-indigo.dropdown-toggle {
            background-color: #3f51b5 !important; }
        .btn-indigo.dropdown-toggle:hover, .btn-indigo.dropdown-toggle:focus {
            background-color: #4d5ec1 !important; }

        .steps-form {
            display: table;
            width: 100%;
            position: relative; }
        .steps-form .steps-row {
            display: table-row; }
        .steps-form .steps-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc; }

        .steps-form .steps-row .steps-step {
            display: table-cell;
            text-align: center;
            position: relative; }
        .steps-form .steps-row .steps-step p {
            margin-top: 0.5rem; }
        .steps-form .steps-row .steps-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important; }
        .steps-form .steps-row .steps-step .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
            margin-top: 0; }
        /*============COMMENTS SECTION=============*/

    </style>
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