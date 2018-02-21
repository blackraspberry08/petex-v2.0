<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?= $title ?></title>

        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="<?= $this->config->base_url() ?>images/logo/icon.png">
        <!-- Bootstrap core CSS-->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <!-- Custom fonts for this template-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- Page level plugin CSS-->
        <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <!-- Timeline CSS Files-->
        <link rel ="stylesheet" href = "<?= base_url() ?>assets/timeline/timeline.css">
        <!-- Bootstrap Switch -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="<?= base_url() ?>assets/admin/css/sb-admin.css" rel="stylesheet">
        <!-- AnimateCss -->
        <link href="<?= base_url() ?>assets/animate/animate.min.css" rel="stylesheet">
        <!-- DatePicker CSS -->
        <link href="<?= base_url() ?>assets/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <!-- Bootstrap Lightbox-->
        <link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
        <!-- Bootstrap File Upload with preview -->
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview/dist/file-upload-with-preview.min.css">

        <style>
            button{cursor:pointer !important;}
            /* Small devices (landscape phones, 576px and up) */
            @media (min-width: 576px) {
                #user_info{
                    border-left: 0px solid #ccc;   
                }
            }

            /* Medium devices (tablets, 768px and up) */
            @media (min-width: 768px) {
                #user_info{
                    border-left: 1px solid #ccc;   
                }
            }

            /* Large devices (desktops, 992px and up) */
            @media (min-width: 992px) {
                #user_info{
                    border-left: 1px solid #ccc;   
                }
            }

            /* Extra large devices (large desktops, 1200px and up)*/
            @media (min-width: 1200px) {
                #user_info{
                    border-left: 1px solid #ccc;   
                }

            }
        </style>
        
        <script type="text/javascript">
            $(document).ready(function () {
                var dogs = "<?php echo $dogs ?>";
                var cats = "<?php echo $cats ?>";
                // Chart.js scripts
                // -- Set new default font family and font color to mimic Bootstrap's default styling
                Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                Chart.defaults.global.defaultFontColor = '#292b2c';
                // -- Pie Chart Example
                var ctx = document.getElementById("mypets");
                var myPieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["Dogs", "Cats"],
                        datasets: [{
                                data: [dogs, cats],
                                backgroundColor: ['#2196F3', '#e53935']
                            }],
                    },
                });
            });

        </script>
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