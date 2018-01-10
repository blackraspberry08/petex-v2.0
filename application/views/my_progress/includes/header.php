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
        <!-- Bootstrap core CSS-->
        <link href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="<?= base_url() ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Page level plugin CSS-->
        <link href="<?= base_url() ?>assets/datatables/dataTables.bootstrap4.css" rel="stylesheet">
        <!-- Timeline CSS Files-->
        <link rel ="stylesheet" href = "<?= base_url() ?>assets/timeline/timeline.css">
        <!-- Bootstrap Switch -->
        <link href="<?= base_url() ?>assets/bootstrap-switch/css/bootstrap-switch.css" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="<?= base_url() ?>assets/admin/css/sb-admin.css" rel="stylesheet">
        <!-- Bootstrap Lightbox-->
        <link rel="stylesheet" href = "<?= base_url() ?>assets/bootstrap-lightbox/ekko-lightbox.css">
        <!-- Stepper -->
        <link rel="stylesheet" href = "<?= base_url() ?>assets/stepper/css/mdb.css">
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