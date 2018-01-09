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
        <!-- Bootstrap File Upload with preview -->
        <link rel ="stylesheet" href ="<?= base_url() ?>assets/bootstrap-fileupload/css/file-upload-with-preview.css">
        <style>
            button{cursor:pointer !important;}
            /* Small devices (landscape phones, 576px and up) */
            @media (min-width: 576px) {
                #animal_info{
                    border-left: 0px solid #ccc;   
                }
            }

            /* Medium devices (tablets, 768px and up) */
            @media (min-width: 768px) {
                #animal_info{
                    border-left: 1px solid #ccc;   
                }
            }

            /* Large devices (desktops, 992px and up) */
            @media (min-width: 992px) {
                #animal_info{
                    border-left: 1px solid #ccc;   
                }
            }

            /* Extra large devices (large desktops, 1200px and up)*/
            @media (min-width: 1200px) {
                #animal_info{
                    border-left: 1px solid #ccc;   
                }

            }
        </style>
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